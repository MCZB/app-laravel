<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body class="bg-gray-900 text-white font-sans">

    <header class="bg-gray-800 py-4 text-center">
        <h1 class="text-3xl font-bold">Popular</h1>
    </header>

    <nav class="bg-gray-700 p-4 flex justify-center">
        <a href="{{ url('/movies/popular') }}" class="text-white mr-4 hover:underline">Populares</a>
        <a href="{{ url('/movies/now_playing') }}" class="text-white mr-4 hover:underline">Now Playing</a>
        <a href="{{ url('/movies/top_rated') }}" class="text-white mr-4 hover:underline">Top Rated</a>
        <a href="{{ url('/movies/upcoming') }}" class="text-white hover:underline">Upcoming</a>
    </nav>

    <div class="container mx-auto p-4">

    <div class="swiper-container h-96 my-4 mx-auto bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="swiper-wrapper">
                @foreach ($movies as $movie)
                <div class="swiper-slide h-96">
                    <img src="{{ asset('movies' . $movie->backdrop_path) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="search-container my-4">
            <label for="search" class="block text-sm font-semibold text-gray-300">Buscar filmes:</label>
            <input type="text" id="search" class="mt-1 p-2 border border-gray-600 rounded-md w-full bg-gray-800 text-white" placeholder="Digite o nome do filme">
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($movies as $movie)
            <div class="relative rounded overflow-hidden bg-gray-800 shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <a href="{{ url('/movies/popular', $movie->id) }}">
                    <img src="{{ asset('movies' . $movie->poster_path) }}" alt="{{ $movie->title }}" class="w-full h-64 object-cover">
                </a>
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $movie->title }}</h2>
                    <p class="text-sm text-gray-400">{{ $movie->release_date }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        const searchInput = document.getElementById('search');
        const movieCards = document.querySelectorAll('.relative');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            movieCards.forEach(card => {
                const movieTitle = card.textContent.toLowerCase();

                if (movieTitle.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>
