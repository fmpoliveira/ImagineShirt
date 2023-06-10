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
        // $this->authorize('administrar');

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
        $this->authorize('administrar');

        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->authorize('administrar');

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
        return view('users.show', compact('user'));
    }


    public function edit(User $user): View
    {
        // $this->authorize('administrar');
        // $this->authorize('update-customer');
        return view('users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user): RedirectResponse
    {
        // $this->authorize('update-customer');
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $user, $request) {
            // $user->customer->address = $formData['address'];
            // $user->customer->nif = $formData['nif'];
            // $user->customer->default_payment_type = $formData['default_payment_type'];
            // $user->customer->default_payment_ref = $formData['default_payment_ref'];
            // $user->customer->save();

            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->user_type = $formData['user_type'];
            $user->save();

            if ($request->hasFile('file_foto')) {
                if ($user->photo_url) {
                    Storage::delete('public/fotos/' . $user->photo_url);
                }
                $path = $request->file_foto->store('public/fotos');
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
        $this->authorize('administrar');

        try {
            // $totalDisciplinas = DB::scalar('select count(*) from alunos_disciplinas where aluno_id = ?', [$aluno->id]);
            // $user = $aluno->user;
            if ($user->user_type == 'A' || $user->user->type == 'E') {
                DB::transaction(function () use ($user) {
                    // $aluno->delete();
                    $user->delete();
                });
            }
            if ($user->photo_url) {
                Storage::delete('public/fotos/' . $user->photo_url);
            }
            $htmlMessage = "User #{$user->id}
                        <strong>\"{$user->name}\"</strong> was deleted with success!";
            return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
            // } else {
            // $url = route('alunos.show', ['aluno' => $aluno]);
            // $alertType = 'warning';
            // $disciplinasStr = $totalDisciplinas > 0 ?
            //     ($totalDisciplinas == 1 ?
            //         "está inscrito a 1 disciplina" :
            //         "está inscrito a $totalDisciplinas disciplinas") :
            //     "";
            // $htmlMessage = "Aluno <a href='$url'>#{$aluno->id}</a>
            //     <strong>\"{$user->name}\"</strong>
            //     não pode ser apagado porque $disciplinasStr!
            //     ";
            // }
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
            Storage::delete('public/fotos/' . $user->photo_url);
            $user->photo_url = null;
            $user->save();
        }
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'User photo "' . $user->name .
                '" was removed!')
            ->with('alert-type', 'success');
    }



    // public function blockUser(User $user)
    // {
    //     $user->blocked = 1;
    //     $user->save();
    // }

    // public function unblockUser(User $user)
    // {
    //     // $user = User::find($id);
    //     if ($user) {
    //         $user->unblock();
    //         // Redirecionar ou retornar uma resposta de sucesso
    //     } else {
    //         // Usuário não encontrado, retornar uma resposta de erro
    //     }
    // }
}
