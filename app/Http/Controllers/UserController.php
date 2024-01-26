<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();
        return $this->successResponse('Usuários listados com sucesso.', $users);
    }

    public function store(StoreUserRequest $request)
    {

        $user = $this->user->create(
            array_replace(
                $request->all(),
                [
                    'image' => $request->hasFile('image') ?
                        $request->file('image')->store('images/users/', 'public') :
                        null,
                    'password' => bcrypt($request->password)
                ]
            )
        );

        return $this->successResponse('Usuário criado com sucesso.', $user);
    }

    public function show(int $id)
    {
        $user = $this->user->with('houses')->find($id);
        if ($user === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }
        return $this->successResponse('Usuário listado com sucesso.', $user);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $user = $this->user->find($id);

        if ($user === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($user->image);
        }

        $user->update(
            array_replace($user->fill($request->all()), [
                'image' => $request->hasFile('image') ?
                    $request->file('image')->store('images/users', 'public') :
                    $user->image,
                'password' => $request->has('password') ?
                    bcrypt($request->password) :
                    $user->password
            ])
        );

        return $this->successResponse('Usuário atualizado com sucesso.', $user);
    }

    public function destroy(int $id)
    {
        $user = $this->user->find($id);

        if ($user === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        $user->delete();
        return $this->successResponse('Usuário deletado com sucesso.');
    }
}
