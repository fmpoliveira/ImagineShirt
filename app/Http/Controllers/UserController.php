<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(Request $request): View
    {
        $this->authorize('viewAny', User::class);

        $filterByUser_type = $request->user_type ?? '';
        $filterByNome = $request->nome ?? '';

        $userQuery = User::query();

        if ($filterByUser_type !== '') {
            $userQuery->where('user_type', $filterByUser_type);
        }

        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $userQuery->whereIntegerInRaw('id', $userIds);
        }

        $users = $userQuery->paginate(10);
        return view('users.index', compact('users', 'filterByNome', 'filterByUser_type'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $request) {
            $newUser = new User();
            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            $newUser->password = Hash::make('123');
            $newUser->user_type = $formData['user_type'];
            $newUser->save();
            if ($request->hasFile('file_foto')) {
                $path = $request->file_foto->store('public/photos');
                $newUser->photo_url = basename($path);
                $newUser->save();
            }
            return $newUser;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> was created with success!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }


    public function show(User $user): View
    {
        $this->authorize('viewAny', User::class);
        return view('users.show', compact('user'));
    }


    public function edit(User $user): View
    {

        $this->authorize('update', User::class);
        return view('users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user): RedirectResponse
    {

        $this->authorize('update', User::class);
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $user, $request) {
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->user_type = $formData['user_type'];
            $user->save();

            if ($request->hasFile('file_foto')) {
                if ($user->photo_url) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $path = $request->file_foto->store('public/photos');
                $user->photo_url = basename($path);
                $user->save();
            }
            return $user;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> was updated with success!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }


    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', User::class);
        try {
            DB::transaction(function () use ($user) {
                $user->delete();
                if ($user->user_type == 'C') {
                    $user->customer->delete();
                }
            });
            if ($user->photo_url) {
                Storage::delete('public/photos/' . $user->photo_url);
            }
            $htmlMessage = "User #{$user->id}
                        <strong>\"{$user->name}\"</strong> was deleted with success!";
            return redirect()->route('users.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('users.show', ['user' => $user]);
            $htmlMessage = "Unable to delete user <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> because an error occurred!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function destroy_foto(User $user): RedirectResponse
    {
        if ($user->photo_url) {
            Storage::delete('public/photos/' . $user->photo_url);
            $user->photo_url = null;
            $user->save();
        }
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'User photo "' . $user->name . '" was removed!')
            ->with('alert-type', 'success');
    }


    public function block(User $user): RedirectResponse
    {
        if ($user->user_type == 'C') {
            $user_type = 'Customer ';
        } else {
            $user_type = 'User ';
        }
        if ($user->blocked == false) {
            $user->blocked = true;
            $user->save();
            return redirect()->route('users.index')
                ->with('alert-msg', $user_type . '"' . $user->name . '" was blocked!')
                ->with('alert-type', 'success');
        } else {
            $user->blocked = false;
            $user->save();
            return redirect()->route('users.index')
                ->with('alert-msg', $user_type . '"' . $user->name . '" was unblocked!')
                ->with('alert-type', 'success');
        }
    }
}
