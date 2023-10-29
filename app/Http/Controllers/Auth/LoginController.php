<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Erro ao autenticar com o Google. Tente novamente.');
        }

        // Verificar se o usuário já existe no banco de dados
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Autenticar usuário existente
            Auth::login($existingUser);
            return redirect()->route('home'); // Redirecionar para a página inicial após o login
        } else {
            // Criar um novo usuário se não existir
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            // Você pode adicionar mais campos se necessário, como 'google_id'
            $newUser->save();

            // Autenticar o novo usuário
            Auth::login($newUser);
            return redirect()->route('home'); // Redirecionar para a página inicial após o login
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validação dos campos do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenta autenticar o usuário com as credenciais fornecidas
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Se a autenticação for bem-sucedida, redireciona para a página desejada
            return redirect()->route('home');
        } else {
            // Se a autenticação falhar, redireciona de volta para o formulário de login com uma mensagem de erro
            return redirect()->route('login')->with('error', 'Credenciais inválidas. Tente novamente.');
        }
    }

    public function logout()
    {
        // Faz o logout do usuário autenticado
        Auth::logout();

        // Redireciona para a página de login após o logout
        return redirect()->route('login');
    }
}
