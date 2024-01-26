<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']);
        $token = auth('api')->attempt($credentials);

        return ($token) ?
            $this->successResponse('Usuário autenticado.', ['token' => $token]) :
            $this->errorResponse("E-mail ou senha não coincidem.", 403);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->successResponse('Informações do usuário.', auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return $this->successResponse('Logout foi realizado com sucesso!');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth('api')->refresh();
        return $this->successResponse('Autenticação renovada.', ['token' => $token]);
    }
}
