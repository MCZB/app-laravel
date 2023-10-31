<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white flex justify-center items-center h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-semibold mb-6">Redefinir Senha</h2>

        <form method="POST" action="{{ route('password.update') }}" class="mb-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email:</label>
                <input type="email" class="form-input w-full bg-gray-700 text-white p-2 rounded-md" name="email" value="{{ $email ?? old('email') }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Nova Senha:</label>
                <input type="password" class="form-input w-full bg-gray-700 text-white p-2 rounded-md" name="password" required>
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirme a Nova Senha:</label>
                <input type="password" class="form-input w-full bg-gray-700 text-white p-2 rounded-md" name="password_confirmation" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition duration-300">Redefinir Senha</button>
        </form>
    </div>

</body>

</html>
