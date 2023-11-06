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

<body class="flex flex-col h-screen">

    <!-- Cabeçalho -->
    <div class="bg-gray-800 p-4 text-white text-center">
        <h1 class="text-3xl font-semibold">Laravel Movies</h1>
    </div>

    <!-- Barra de Navegação -->
    <nav class="bg-gray-700 p-4 flex justify-center">
        <a href="{{ url('/') }}" class="text-white mr-4 hover:underline">Home</a>
        <a href="{{ url('/movies/popular') }}" class="text-white mr-4 hover:underline">Populares</a>
        <a href="{{ url('/movies/now_playing') }}" class="text-white mr-4 hover:underline">Now Playing</a>
        <a href="{{ url('/movies/top_rated') }}" class="text-white mr-4 hover:underline">Top Rated</a>
        <a href="{{ url('/movies/upcoming') }}" class="text-white hover:underline">Upcoming</a>
    </nav>

    <div class="h-20"></div>

    <!-- Contêiner para centralizar o formulário -->
    <div class="flex justify-center items-center h-screen relative">
        <!-- Formulário de Login -->
        <div class="bg-gray-800 p-8 rounded shadow-lg flex flex-col items-center w-96 relative">
            <!-- Avatar -->
            <img src="{{ asset('avatar.png') }}" alt="Avatar" class="w-24 h-auto absolute -top-12 transform -translate-x-1/2 left-1/2">

            <!-- Título "Login" com um pouco de margem inferior -->
            <h2 class="text-2xl font-semibold mb-2 text-white mt-2">Login</h2>

            @if(session('status'))
                <div class="bg-gray-800 text-white p-2 mb-4 rounded">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">E-mail:</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="E-mail" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300">Password:</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="Password" required>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Enter
                </button>
            </form>

            <!-- Linha fina entre o botão "Login com Google" e a parte superior do formulário -->
            <hr class="my-4 border-t border-gray-700 w-full">

            <!-- Botão "Login com Google" -->
            <a href="{{ url('/login/google') }}"
                class="w-full bg-red-500 text-white p-2 rounded-md flex items-center justify-center hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300 mb-2 mt-2">
                Login with Google
            </a>

            <!-- Botão de Registro -->
            <a href="{{ url('/register') }}"
                class="text-sm text-gray-400 hover:underline focus:outline-none focus:ring focus:border-blue-300">
                Don't have an account? Register here.
            </a>
        </div>
    </div>
</body>

</html>
