<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Price;
use App\Models\TshirtImage;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function show(): View
    {
        $cart = session('cart', []);
        $colors = Color::all();
        $sizes = DB::table('order_items')
            ->select('size')
            ->distinct()
            ->get();
        $total = $this->getTotalPrices();

        return view('cart.show', compact('cart'))
            ->with('colors', $colors)
            ->with('sizes', $sizes)
            ->with('total', $total);
    }

    public function refresh(Request $request)
    {
        $cart = session('cart');
        $colors = Color::all();
        $sizes = DB::table('order_items')
            ->select('size')
            ->distinct()
            ->get();

        $tshirtIds = $request->tshirts;
        for ($i = 0; $i < count($tshirtIds); $i++) {
            $tshirt = $cart[$tshirtIds[$i]];
            $tshirt->qty = $request->quantities[$i];

            $prices = Price::find(1);
            if (isset($tshirt->customer_id)) {
                if ($tshirt->qty >= $prices->qty_discount) {
                    $tshirt->price = $prices->unit_price_own_discount;
                } else {
                    $tshirt->price = $prices->unit_price_own;
                }
            } else {
                if ($tshirt->qty >= $prices->qty_discount) {
                    $tshirt->price = $prices->unit_price_catalog_discount;
                } else {
                    $tshirt->price = $prices->unit_price_catalog;
                }
            }

            $tshirt->sub_total = $tshirt->price * $tshirt->qty;
            $tshirt->color = $request->colors[$i];
            $tshirt->size = $request->sizes[$i];
        }
        $total = $this->getTotalPrices();
        $request->session()->put('cart', $cart);

        return redirect('cart');
    }

    private function getTotalPrices()
    {
        $cart = session('cart');
        if (empty($cart)) {
            return 0.0;
        }
        $total = 0.0;
        foreach ($cart as $tshirt) {
            $total += ($tshirt->qty * $tshirt->price);
        }
        return $total;
    }

    public function addToCart(Request $request, TshirtImage $tshirt)
    {
        try {
            $userType = $request->user()->tipo ?? 'O'; // O é para utilizadores anónimos C clientes
            if ($userType != 'C' && $userType != 'O') {
                $alertType = 'warning';
                $htmlMessage = "O utilizador não é cliente, logo não pode adicionar item ao carrinho";
            } else {
                $cart = session('cart', []);
                if (array_key_exists($tshirt->id, $cart)) {
                    $alertType = 'warning';
                    $htmlMessage = "Tshirt <strong>\"{$tshirt->name}\"</strong> não foi adicionada ao carrinho porque já está presente no mesmo!";
                } else {
                    $colors = Color::all();
                    $sizes = DB::table('order_items')
                        ->select('size')
                        ->distinct()
                        ->get();

                    $tshirt->qty = 1; // default value
                    $tshirt->color = $colors[0]->code; // default value
                    $tshirt->size = $sizes[0]->size; // default value
                    $prices = Price::find(1);
                    if (isset($tshirt->customer_id)) {
                        $tshirt->price = $prices->unit_price_own;
                    } else {
                        $tshirt->price = $prices->unit_price_catalog;
                    }
                    $tshirt->sub_total = $tshirt->price;

                    $cart[$tshirt->id] = $tshirt;
                    $request->session()->put('cart', $cart);
                    $request->session()->put('colors', $colors);
                    $request->session()->put('sizes', $sizes);

                    $alertType = 'success';
                    $htmlMessage = "Tshirt <strong>\"{$tshirt->name}\"</strong> foi adicionada ao carrinho!";
                }
            }
        } catch (\Exception $error) {
            $htmlMessage = "Não é possível adicionar a Tshirt <strong>\"{$tshirt->name}\"</strong> ao carrinho, porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function removeFromCart(Request $request, TshirtImage $tshirt): RedirectResponse
    {
        $cart = session('cart', []);

        if (array_key_exists($tshirt->id, $cart)) {
            unset($cart[$tshirt->id]);
        }

        $request->session()->put('cart', $cart);
        $htmlMessage = "Item<strong>\"{$tshirt->name}\"</strong> was removed from the cart!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function confirm(Request $request): View
    {
        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = "The user is not a customer, therefore you can't confirm the order!";
            } else {
                $cart = session('cart', []);
                $total = count($cart);
                if ($total < 1) {
                    $alertType = 'warning';
                    $htmlMessage = "You can't confirm the order because there aren't any items on the cart!";
                } else {
                    $login = Auth::user();
                    $user = Customer::find($login->id);
                    $paymentTypes = array_combine(
                        array_column(PaymentType::cases(), 'name'),
                        array_column(PaymentType::cases(), 'value')
                    );

                    $request->session()->put('userDetails', $user);
                    $request->session()->put('loginInfo', $login);
                    $request->session()->put('paymentTypes', $paymentTypes);

                    return view('cart/confirm', compact('cart'))
                        ->with('userDetails', $user)
                        ->with('login', $login)
                        ->with('paymentTypes', $paymentTypes)
                        ->with('total', $this->getTotalPrices());
                    // return Redirect::to('cart/confirm');
                    // return Redirect::away('cart/confirm');
                }
            }
        } catch (\Exception $error) {
            $htmlMessage = "It wasn't possible to confirm the cart items because there occurred an error!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nif' => ['required', 'numeric', 'digits:9'],
            'address' => ['required'],
            'payment' => [
                'required',
                function () use ($request) {
                    $paymentType = $request->input('payment');
                    return in_array($paymentType, array_column(PaymentType::cases(), 'name'));
                }
            ],
            'reference' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $paymentType = $request->input('payment');

                    if ($paymentType === PaymentType::PAYPAL) {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $fail('The ' . $attribute . ' must be a valid email address.');
                        }
                    } else {
                        if (!is_numeric($value) || strlen($value) !== 16) {
                            $fail('The ' . $attribute . ' must be numeric and have 16 digits.');
                        }

                    }
                }
            ]
        ]);

        try {
            $userType = $request->user()->user_type ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = "The user is not a customer, therefore you can't confirm the order!";
            }
            $cart = session('cart');
            $total = count($cart);
            if ($total < 1) {
                $alertType = 'warning';
                $htmlMessage = "You can't confirm the order because there aren't any items on the cart!";
            }

            // TODO - MAKE THIS YOUR DEFAULT PAYMENT DETAILS

            $user = session('userDetails');

            DB::transaction(function () use ($request, $user, $cart, $validatedData) {
                $total_price = 0.0;
                foreach ($cart as $tshirt) {
                    $total_price += $tshirt->sub_total;
                }
                $newOrder = new Order();
                $newOrder->status = OrderStatus::PENDING;
                $newOrder->customer_id = $user->id;
                $newOrder->date = Carbon::now();
                $newOrder->total_price = $total_price;
                $newOrder->nif = $validatedData['nif'];
                $newOrder->notes = $request->notes;
                $newOrder->address = $validatedData['address'];
                $newOrder->payment_type = $validatedData['payment'];
                $newOrder->payment_ref = $validatedData['reference'];
                $newOrder->save();
                foreach ($cart as $tshirt) {
                    $newOrderItem = new OrderItem();
                    $newOrderItem->order_id = $newOrder->id;
                    $newOrderItem->tshirt_image_id = $tshirt->id;
                    $newOrderItem->color_code = $tshirt->color;
                    $newOrderItem->size = $tshirt->size;
                    $newOrderItem->qty = $tshirt->qty;
                    $newOrderItem->unit_price = $tshirt->price;
                    $newOrderItem->sub_total = $tshirt->sub_total;
                    $newOrderItem->save();
                }
            });

            $htmlMessage = "Foi confirmada a encomenda ao customer #    {$user->id} <strong>\"{$request->user()->name}\"</strong>";
            $alertType = 'success';
            $request->session()->forget('cart');
        } catch (\Exception $error) {
            $htmlMessage = "Não foi possível confirmar os itens do carrinho porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect('tshirts')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);

    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        $request->session()->forget('qty_discount');
        $htmlMessage = "Carrinho está limpo!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }
}