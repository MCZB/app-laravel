<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Reset Password') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

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

<body class="bg-gray-900 text-white">
    <div class="container mx-auto h-screen flex justify-center items-center">
        <div class="w-full max-w-md">
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-6">{{ __('Reset Password') }}</h2>

                @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-input mt-1 p-2 w-full rounded-md bg-gray-700 text-white" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition duration-300">{{ __('Send Password Reset Link') }}</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
