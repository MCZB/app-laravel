<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        // Validação do email
        $this->validateEmail($request);

        // Encontrar o usuário pelo endereço de email
        $user = User::where('email', $request->email)->first();

        // Se o usuário existir
        if ($user) {
            // Crie um token de redefinição de senha e salve-o no banco de dados
            $token = Str::random(60);
            $user->update([
                'reset_token' => $token,
                'password' => Hash::make($token), // Armazenar a senha de redefinição criptografada no banco de dados
            ]);

            // Envie o email com o link para redefinição de senha
            $user->notify(new ResetPasswordNotification($token));
        }

        // Retornar uma resposta (você pode personalizar isso conforme necessário)
        return response()->json(['message' => 'Email de redefinição de senha enviado com sucesso']);
    }

    // Método de validação do email (você pode personalizar isso conforme necessário)
    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    }

    public function showResetForm($token)
    {
        return view('auth/passwords/reset', ['token' => $token]);
    }
    
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
    
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );
    
        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Senha redefinida com sucesso!')
            : back()->withErrors(['email' => [__($response)]]);
    }
    
}
