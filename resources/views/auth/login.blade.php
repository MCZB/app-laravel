<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #1a202c, #2d3748);
        }
    </style>
</head>

<body class="h-screen flex flex-col items-center justify-center">
    <div class="bg-gray-800 p-8 rounded shadow-lg flex flex-col items-center w-96 relative">
        <!-- Logo da pasta public (metade dentro, metade fora) -->
        <img src="{{ asset('avatar.png') }}" alt="Logo" class="w-24 h-auto absolute -top-12">
        <!-- Formulário de Login -->
        <div class="mb-4 w-full">
            <h2 class="text-2xl font-semibold mb-4 text-white">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email:</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="Digite seu email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300">Senha:</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="Digite sua senha" required>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Entrar
                </button>
            </form>
            <hr class="my-4 border-gray-700">
            <a href="{{ url('/login/google') }}"
                class="w-full bg-red-500 text-white p-2 rounded-md flex items-center justify-center hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300 mb-2">
                Login com Google
            </a>
            <!-- Botão de Registro -->
            <a href="{{ url('/register') }}"
                class="text-sm text-gray-400 hover:underline focus:outline-none focus:ring focus:border-blue-300">
                Não tem uma conta? Registre-se aqui.
            </a>
        </div>
    </div>
</body>

</html>
