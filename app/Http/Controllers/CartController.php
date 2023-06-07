<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\TshirtImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function show(): View
    {
        $cart = session('cart', []);
        $qty_discount = session('qty_discount');
        $colors = Color::all();
        $sizes = DB::table('order_items')
            ->select('size')
            ->distinct()
            ->get();
        return view('cart.show', compact('cart'))
            ->with('colors', $colors)
            ->with('sizes', $sizes)
            ->with('qty_discount', $qty_discount);
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
                    $tshirt->qty = 1; // default value
                    $prices = Price::find(1);
                    if (isset($cart[$tshirt->customer_id])) {
                        $tshirt->price_without_discount = $prices->unit_price_own;
                        $tshirt->price_with_discount = $prices->unit_price_own_discount;
                    } else {
                        $tshirt->price_without_discount = $prices->unit_price_catalog;
                        $tshirt->price_with_discount = $prices->unit_price_catalog_discount;
                    }
                    
                    $cart[$tshirt->id] = $tshirt;
                    $request->session()->put('cart', $cart);
                    $request->session()->put('qty_discount', $prices->qty_discount);

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
        $htmlMessage = "Item<strong>\"{$tshirt->name}\"</strong> foi removida do carrinho!";
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $userType = $request->user()->tipo ?? 'O';
            if ($userType != 'C') {
                $alertType = 'warning';
                $htmlMessage = "O utilizador não é cliente, logo não pode confirmar a encomenda";
            } else {
                $cart = session('cart', []);
                $total = count($cart);
                if ($total < 1) {
                    $alertType = 'warning';
                    $htmlMessage = "Não é possível confirmar a encomenda porque não existem itens no carrinho";
                } else {
                    // 'status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url'
                    $order = Order::create([
                        'status' => 'PENDING',
                        'customer_id' => '$customerId',
                        'date' => time(),
                        'total_price' => '$total_price',
                        'notes' => '',
                        'address' => '??',
                        'payment_type' => 'default do user ou o que vier',
                        'payment_ref' => 'depende do payment_type só',
                        'receipt_url' => 'o que o user meter, se não n meter nada'
                    ]);
                    $orderId = $order->id; 

                    OrderItem::create();
                    $customer = $request->user()->customer;
                    DB::transaction(function () use ($customer, $cart) {
                        foreach ($cart as $item) {
                            // para cada item ele junta o customer
                            $customer->orders()->attach($item->id, ['repetente' => 0]);
                        }
                    });
                    $htmlMessage = "Foi confirmada a encomenda ao customer #    {$customer->id} <strong>\"{$request->user()->name}\"</strong>";

                    $request->session()->forget('cart');
                    $request->session()->forget('cart');
                    return redirect()->route('orders.mine')
                        ->with('alert-msg', $htmlMessage)
                        ->with('alert-type', 'success');
                }
            }
        } catch (\Exception $error) {
            $htmlMessage = "Não foi possível confirmar os itens do carrinho porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
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