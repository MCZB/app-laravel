<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    // Mostra o formulário para solicitar a redefinição de senha
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Envia o e-mail com o link para redefinir a senha
    public function sendResetLinkEmail(Request $request)
    {
        // Validação dos dados de entrada (verifica se o campo de e-mail é obrigatório e um e-mail válido)
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tenta enviar o link de redefinição de senha
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Verifica o status da operação de envio do link de redefinição de senha
        // Se for bem-sucedido, redireciona de volta com uma mensagem de sucesso
        // Se não for bem-sucedido, redireciona de volta com uma mensagem de erro
        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
