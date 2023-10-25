<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Now Playing</title>
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
</head>

<body>
    <header>
        <h1>Now Playing</h1>
    </header>

    <nav>
        <a href="{{ url('/movies/popular') }}">Populares</a>
        <a href="{{ url('/movies/now_playing') }}">Now Playing</a>
        <a href="{{ url('/movies/top_rated') }}">Top Rated</a>
        <a href="{{ url('/movies/upcoming') }}">Upcoming</a>
    </nav>

    <div class="movies-container">
        @foreach ($movies as $movie)
        <div class="movie-card">
            <a href="{{ url('/movies/now_playing', $movie->id) }}">
                <img src="{{ asset('movies' . $movie->poster_path) }}" alt="{{ $movie->title }}">
            </a>
        </div>
        @endforeach
    </div>

    <script>
        // Obtém todos os elementos com a classe .movie-card
        const movieCards = document.querySelectorAll('.movie-card');

        // Adiciona um ouvinte de eventos a cada cartão do filme
        movieCards.forEach(movieCard => {
            // Adiciona a classe 'highlight' quando o mouse entra no cartão do filme
            movieCard.addEventListener('mouseenter', () => {
                movieCard.classList.add('highlight');
            });

            // Remove a classe 'highlight' quando o mouse sai do cartão do filme
            movieCard.addEventListener('mouseleave', () => {
                movieCard.classList.remove('highlight');
            });
        });
    </script>

</body>

</html>
