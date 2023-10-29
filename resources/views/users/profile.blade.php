<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 text-white font-sans h-screen flex items-center justify-center">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-3xl font-bold mb-4">{{ auth()->user()->name }}</h1>

        <div class="mb-4">
            <strong>Email:</strong> {{ auth()->user()->email }}
        </div>

        <!-- Adicione mais informações do usuário conforme necessário -->
        <div class="mb-6">
            <strong>Date of Birth:</strong> {{ auth()->user()->birthdate ?: 'Not provided' }}
        </div>

        <div class="mb-6">
            <strong>Country:</strong> {{ auth()->user()->country ?: 'Not provided' }}
        </div>

        <a href="{{ route('logout') }}"
            class="text-white bg-red-500 hover:bg-red-600 rounded-md px-4 py-2 transition duration-300 transform focus:outline-none focus:ring focus:ring-gray-200 mb-4">
            Logout
        </a>

        <a href="{{ route('home') }}"
            class="text-white bg-blue-500 hover:bg-blue-600 rounded-md px-4 py-2 transition duration-300 transform focus:outline-none focus:ring focus:ring-gray-200">
            Home
        </a>
    </div>

</body>

</html>
