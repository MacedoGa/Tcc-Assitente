<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Obter as credenciais de login
        $credentials = $request->only('email', 'password');

        // Verificar se o login está correto (isso é apenas um exemplo simples)
        if ($credentials['email'] === 'usuario@exemplo.com' && $credentials['password'] === 'senha123') {
            // Redirecionar para a página de welcome após o login bem-sucedido
            return redirect('/welcome');
        } else {
            // Redirecionar de volta ao login com uma mensagem de erro
            return back()->withErrors(['message' => 'Credenciais inválidas.']);
        }
    }
}
