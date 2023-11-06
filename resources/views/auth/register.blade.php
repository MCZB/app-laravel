<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- Conteúdo do Registro -->
    <div class="flex items-center justify-center h-screen">
        <div class="bg-gray-800 p-8 rounded shadow-lg w-96">
            <h2 class="text-2xl font-semibold mb-4 text-white">Register</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name:</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="Enter your name" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email:</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="Enter your email" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-300">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                        class="mt-1 p-2 w-full border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="country" class="block text-sm font-medium text-gray-300">Country:</label>
                    <select id="country" name="country" class="mt-1 p-2 w-full border rounded-md" required>
                        <option value="" disabled selected>Select your country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300">Password:</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md"
                        placeholder="Enter your password" required>
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-300">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="password_confirmation"
                        class="mt-1 p-2 w-full border rounded-md" placeholder="Confirm your password" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Register
                </button>
            </form>
            <hr class="my-4 border-gray-700">
            <a href="{{ url('/login') }}"
                class="w-full bg-gray-500 text-white p-2 rounded-md flex items-center justify-center hover:bg-gray-600 focus:outline-none focus:ring focus:border-gray-300 mb-2">
                Already have an account? Login here.
            </a>
            <a href="{{ url('/login/google') }}"
                class="w-full bg-red-500 text-white p-2 rounded-md flex items-center justify-center hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300">
                Register with Google
            </a>
        </div>
    </div>
</body>

</html>
