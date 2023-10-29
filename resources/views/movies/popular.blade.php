<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        /* Adicione seus estilos personalizados aqui, se necessário */
    </style>
</head>

<body class="bg-gray-900 text-white font-sans">

    <!-- Header -->
    <header class="bg-gray-800 py-4 text-center">
        <div class="flex justify-between items-center px-4">
            <h1 class="text-3xl font-bold">Popular</h1>
            @auth
            <div x-data="{ open: false }" class="relative inline-block text-left dropdown border border-gray-600 rounded-md" @click="open = !open">
                <span class="rounded-md shadow-sm cursor-pointer flex items-center">
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-200 focus:ring-opacity-0 active:bg-gray-900"
                        aria-haspopup="true" :aria-expanded="open.toString()">
                        {{ auth()->user()->name }}
                        <svg x-show="!open" class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg x-show="open" class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 15l7-7 7 7"></path>
                        </svg>
                    </button>
                </span>
                <div x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5"
                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <a href="/profile"
                            class="block px-4 py-2 text-sm text-white hover:bg-gray-700 hover:text-gray-300"
                            role="menuitem">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" role="menuitem" id="logoutForm">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-gray-700 hover:text-gray-300"
                                role="menuitem">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div>
                <a href="{{ route('login') }}" class="text-white hover:underline">Login</a>
                <span class="mx-2 text-gray-400">|</span>
                <a href="{{ route('register') }}" class="text-white hover:underline">Register</a>
            </div>
            @endauth
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-gray-700 p-4 flex justify-center">
        <a href="{{ url('/') }}" class="text-white mr-4 hover:underline">Home</a>
        <a href="{{ url('/movies/popular') }}" class="text-white mr-4 hover:underline">Populares</a>
        <a href="{{ url('/movies/now_playing') }}" class="text-white mr-4 hover:underline">Now Playing</a>
        <a href="{{ url('/movies/top_rated') }}" class="text-white mr-4 hover:underline">Top Rated</a>
        <a href="{{ url('/movies/upcoming') }}" class="text-white hover:underline">Upcoming</a>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">

        <!-- Genre Selection -->
        <div class="my-4">
            <form id="genreForm" class="flex items-center">
                <label for="genreDropdown" class="mr-2">Choose a genre:</label>
                <select id="genreDropdown" name="genreId"
                    class="p-2 border border-gray-600 rounded-md bg-gray-800 text-white">
                    @foreach ($genres as $genreId => $genreName)
                        <option value="{{ $genreId }}">{{ $genreName }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Movie Slider -->
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

        <!-- Movie Search -->
        <div class="search-container my-4">
            <label for="search" class="block text-sm font-semibold text-gray-300">Search for a movie:</label>
            <input type="text" id="search"
                class="mt-1 p-2 border border-gray-600 rounded-md w-full bg-gray-800 text-white"
                placeholder="Enter the name of the movie">
        </div>

        <!-- Movie Grid -->
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
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

        const genreDropdown = document.getElementById('genreDropdown');
        genreDropdown.addEventListener('change', function () {
            const selectedGenreId = genreDropdown.value;
            window.location.href = `/movies/genre/${selectedGenreId}`;
        });

        const searchInput = document.getElementById('search');
        const movieCards = document.querySelectorAll('.relative');

        searchInput.addEventListener('input', function () {
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

        document.querySelectorAll('.login-button, .register-button').forEach(button => {
            button.addEventListener('mouseenter', function() {
                button.classList.add('animate-pulse');
            });

            button.addEventListener('mouseleave', function() {
                button.classList.remove('animate-pulse');
            });
        });
    </script>

</body>

</html>
