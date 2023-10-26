<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="{{ mix('resources/css/details.css') }}">
    <style>
        .background-poster {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-image: url('{{ asset("movies" . $movie->poster_path) }}');
            filter: blur(10px);
            z-index: -1;
        }
    </style>
</head>

<body>

    <header>
        <h1>Laravel Movie</h1>
    </header>

    <nav>
        <a href="{{ url('/home')}}">Home</a>
        <a href="{{ url('/movies/popular') }}">Populares</a>
        <a href="{{ url('/movies/now_playing') }}">Now Playing</a>
        <a href="{{ url('/movies/top_rated') }}">Top Rated</a>
        <a href="{{ url('/movies/upcoming') }}">Upcoming</a>
    </nav>

    <div class="container">
        <div class="background-poster"></div>
        <div class="content">
            <div class="movie-poster">
                <img src="{{ asset('movies' . $movie->poster_path) }}" alt="{{ $movie->title }}">
            </div>
            <div class="details">
                <h1>{{ $movie->original_title }}</h1>
                <ul>
                    <li><strong>Original Title:</strong> {{ $movie->original_title }}</li>
                    <li><strong>Original Language:</strong> {{ $movie->original_language }}</li>
                    <li><strong>Overview:</strong> {{ $movie->overview }}</li>
                    <li><strong>Popularity:</strong> {{ $movie->popularity }}</li>
                    <li><strong>Release Date:</strong> {{ $movie->release_date }}</li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>
