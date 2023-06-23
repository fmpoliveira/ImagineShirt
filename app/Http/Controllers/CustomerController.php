<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{

    // public function index(Request $request): View
    // {
    //     $filterByNome = $request->nome ?? '';

    //     $customerQuery = Customer::query();
    //     if ($filterByNome !== '') {
    //         $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
    //         $customerQuery->whereIntegerInRaw('id', $userIds);
    //     }
    //     $customers = $customerQuery->with('user')->paginate(10);
    //     return view('customers.index', compact('customers', 'filterByNome'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $customer = new Customer();
    //     $user = new User();
    //     $customer->user = $user;
    //     return view('customers.create', compact('customer'));
    // }

    /**
     * Store a newly created resource in storage.
     */
//     public function store(CustomerRequest $request): RedirectResponse
//     {
//         $formData = $request->validated();
//         $customer = DB::transaction(function () use ($formData) {
//             $newUser = new User();
//             $newUser->user_type = 'C';
//             $newUser->name = $formData['name'];
//             $newUser->email = $formData['email'];
//             $newUser->password = Hash::make($formData['password_inicial']);
//             $newUser->save();
//             $newCustomer = new Customer();
//             $newCustomer->id = $newUser->id;
//             $newCustomer->nif = $formData['nif'];
//             $newCustomer->address = $formData['address'];
//             $newCustomer->save();
//             return $newCustomer;
//         });
//         $url = route('customers.show', ['customer' => $customer]);
//         $htmlMessage = "Customer <a href='$url'>#{$customer->id}</a>
// <strong>\"{$customer->user->name}\"</strong>
// was created with success!";
//         return redirect()->route('customers.index')
//             ->with('alert-msg', $htmlMessage)
//             ->with('alert-type', 'success');
//     }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): View
    {
        $this->authorize('viewCustomer', User::class);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {

        $this->authorize('viewCustomer', User::class);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorize('viewCustomer', User::class);

        $formData = $request->validated();
        $customer = DB::transaction(function () use ($formData, $customer, $request) {
            $customer->nif = $formData['nif'];
            $customer->address = $formData['address'];
            if (isset($formData['default_payment_type'])) {
                $customer->default_payment_type = $formData['default_payment_type'];
            }
            if (isset($formData['default_payment_ref'])) {
                $customer->default_payment_ref = $formData['default_payment_ref'];
            }
            $customer->save();
            $user = $customer->user;
            $user->user_type = 'C';
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->save();
            if ($request->hasFile('file_foto')) {
                if ($user->photo_url) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $path = $request->file_foto->store('public/photos');
                $user->photo_url = basename($path);
                $user->save();
            }
            return $customer;
        });
        $url = route('customers.show', ['customer' => $customer]);
        $htmlMessage = "Customer <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> was updated with success!";
        return redirect()->route('customers.show', ['customer' => $customer])
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $this->authorize('viewAny', User::class);

        try {
            // $totalDisciplinas = DB::scalar('select count(*) from docentes_disciplinas where docente_id = ?', [$docente->id]);
            $user = $customer->user;
            // if ($totalDisciplinas == 0) {
            DB::transaction(function () use ($customer, $user) {
                $customer->delete();
                $user->delete();
            });
            if ($user->photo_url) {
                Storage::delete('public/photos/' . $user->photo_url);
            }
            $htmlMessage = "Customer #{$customer->id}
                        <strong>\"{$user->name}\"</strong> was deleted with success!";
            return redirect()->route('customers.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');

        } catch (\Exception $error) {
            $url = route('customers.show', ['customer' => $customer]);
            $htmlMessage = "Was not possible to delete the customer <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$user->name}\"</strong> because an error occurred!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function destroy_foto(Customer $customer): RedirectResponse
    {

        if ($customer->user->photo_url) {
            Storage::delete('public/photos/' . $customer->user->photo_url);
            $customer->user->photo_url = null;
            $customer->user->save();
        }
        return redirect()->route('customers.edit', ['customer' => $customer])
            ->with('alert-msg', 'User photo "' . $customer->user->name . '" was removed!')
            ->with('alert-type', 'success');
    }
}
