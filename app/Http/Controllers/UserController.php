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
        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $request) {
            $newUser = new User();
            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            $newUser->password = Hash::make('123');
            $newUser->user_type = $formData['user_type'];
            $newUser->save();
            if ($request->hasFile('file_foto')) {
                $path = $request->file_foto->store('public/fotos');
                $newUser->url_foto = basename($path);
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
        return view('users.show', compact('user'));
    }


    public function edit(User $user): View
    {

        return view('users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $formData = $request->validated();
        $aluno = DB::transaction(function () use ($formData, $user, $request) {
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->user_type = $formData['user_type'];
            $user->save();
            if ($request->hasFile('file_foto')) {
                if ($user->url_foto) {
                    Storage::delete('public/fotos/' . $user->url_foto);
                }
                $path = $request->file_foto->store('public/fotos');
                $user->url_foto = basename($path);
                $user->save();
            }
            return $user;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$aluno->id}</a>
                        <strong>\"{$user->name}\"</strong> was updated with success!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }
}
