<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">

    <div class="bg-gray-900 h-screen flex flex-row justify-center items-center">
        <div class="bg-gray-800 rounded-lg p-8 max-w-3xl mx-auto flex flex-col md:flex-row items-center md:items-start shadow-lg text-center border-4 border-yellow-500">

            <!-- Poster do Filme à Direita -->
            <div class="md:w-1/2 mb-6 md:mb-0">
                <img src="{{ asset('movies' . $movie->poster_path) }}" alt="{{ $movie->title }}"
                    class="w-full h-auto rounded shadow-md">
            </div>

            <!-- Detalhes do Filme à Esquerda -->
            <div class="md:w-1/2 md:ml-6 text-left">
                <h1 class="text-4xl font-bold mb-6 text-yellow-500">{{ $movie->title }}</h1>

                <div class="mb-6 text-gray-300">
                    <h2 class="text-2xl font-semibold mb-2 text-yellow-500">Overview</h2>
                    <p>{{ $movie->overview }}</p>
                </div>

                <div class="mb-6 text-gray-300">
                    <h2 class="text-2xl font-semibold mb-2 text-yellow-500">Additional Details</h2>
                    <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
                    <p><strong>Popularity:</strong> {{ $movie->popularity }}</p>
                    <p><strong>Average Votes:</strong> {{ $movie->vote_average }}</p>
                    <p><strong>Total Votes:</strong> {{ $movie->vote_count }}</p>
                </div>

                <a href="#"
                    class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-2 px-4 rounded transition duration-300">Watch Now</a>
            </div>
        </div>
    </div>

</body>

</html>
