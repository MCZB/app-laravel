<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Rated</title>
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
</head>

<body>
    <header>
        <h1>Top Rated</h1>
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
            <a href="{{ url('/movies/top_rated', $movie->id) }}">
                <img src="{{ asset('movies' . $movie->poster_path) }}" alt="{{ $movie->title }}">
            </a>
        </div>
        @endforeach
    </div>
</body>

</html>
