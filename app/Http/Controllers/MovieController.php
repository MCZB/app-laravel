<?php

namespace App\Http\Controllers;

use App\Models\PopularMovie;
use App\Models\TopRatedMovie;
use App\Models\UpcomingMovie;
use App\Models\NowPlayingMovie;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class MovieController extends Controller
{
    // Método para importar dados de filmes de uma API externa
    public function importData()
    {
        set_time_limit(600);
        $client = new Client();
        $apiKey = 'dc957775a8adf2d615d5a56c0a96b81e';
        $maxMovies = 100;

        $apiUrls = [
            "https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}",
            "https://api.themoviedb.org/3/movie/top_rated?api_key={$apiKey}",
            "https://api.themoviedb.org/3/movie/upcoming?api_key={$apiKey}",
            "https://api.themoviedb.org/3/movie/now_playing?api_key={$apiKey}",
        ];

        foreach ($apiUrls as $apiUrl) {
            $pageNumber = 1;
            $moviesImported = 0;

            do {
                $response = $client->request('GET', $apiUrl . "&page={$pageNumber}");
                $moviesData = json_decode($response->getBody(), true)['results'];

                $movieModel = $this->getModelForApiUrl($apiUrl);

                foreach ($moviesData as $movieData) {
                    $releaseDate = isset($movieData['release_date']) ? $movieData['release_date'] : null;
                    $existingMovie = $movieModel::where('id', $movieData['id'])->first();                   

                    if (!$existingMovie) {
                        $movieModel::create([
                            'id' => $movieData['id'],
                            'genre_ids' => json_encode($movieData['genre_ids']),
                            'original_language' => $movieData['original_language'],
                            'original_title' => $movieData['original_title'],
                            'overview' => $movieData['overview'],
                            'popularity' => $movieData['popularity'],
                            'poster_path' => $movieData['poster_path'] ?? null,
                            'backdrop_path' => $movieData['backdrop_path'] ?? null,
                            'release_date' => $releaseDate,
                            'title' => $movieData['title'],
                            'video' => $movieData['video'],
                            'vote_average' => $movieData['vote_average'],
                            'vote_count' => $movieData['vote_count'],
                        ]);


                        $moviesImported++;

                        if ($moviesImported >= $maxMovies) {
                            break 2;
                        }
                    }
                }

                $pageNumber++;

            } while (!empty($moviesData) && $moviesImported < $maxMovies);
        }

        return "Dados importados com sucesso para o banco de dados!";
    }
    
    // Método para exibir a página inicial com todos os filmes paginado
    public function showHome()
    {
        $perPage = 50;
        $movies = Movie::paginate($perPage);

        $genres = [
            28 => "Action",
            12 => "Adventure",
            16 => "Animation",
            35 => "Comedy",
            80 => "Crime",
            99 => "Documentary",
            18 => "Drama",
            10751 => "Family",
            14 => "Fantasy",
            36 => "History",
            27 => "Horror",
            10402 => "Music",
            9648 => "Mystery",
            10749 => "Romance",
            878 => "Science Fiction",
            10770 => "TV Movie",
            53 => "Thriller",
            10752 => "War",
            37 => "Western",
        ];
        return view('movies.movies', ['movies' => $movies, 'genres' => $genres]);
    }

    // Métodos para exibir diferentes tipos de filmes (popular, top-rated, upcoming, now playing)
    public function showPopular()
    {
        $perPage = 50;
        $movies = PopularMovie::paginate($perPage);

        $genres = [
            28 => "Action",
            12 => "Adventure",
            16 => "Animation",
            35 => "Comedy",
            80 => "Crime",
            99 => "Documentary",
            18 => "Drama",
            10751 => "Family",
            14 => "Fantasy",
            36 => "History",
            27 => "Horror",
            10402 => "Music",
            9648 => "Mystery",
            10749 => "Romance",
            878 => "Science Fiction",
            10770 => "TV Movie",
            53 => "Thriller",
            10752 => "War",
            37 => "Western",
        ];

        return view('movies.popular', ['movies' => $movies, 'genres' => $genres]);
    }
    
    public function showTopRated()
    {
        $perPage = 50;
        $movies = TopRatedMovie::paginate($perPage);
        $genres = [
            28 => "Action",
            12 => "Adventure",
            16 => "Animation",
            35 => "Comedy",
            80 => "Crime",
            99 => "Documentary",
            18 => "Drama",
            10751 => "Family",
            14 => "Fantasy",
            36 => "History",
            27 => "Horror",
            10402 => "Music",
            9648 => "Mystery",
            10749 => "Romance",
            878 => "Science Fiction",
            10770 => "TV Movie",
            53 => "Thriller",
            10752 => "War",
            37 => "Western",
        ];

        return view('movies.top_rated', ['movies' => $movies, 'genres' => $genres]);
    }
    
    
    public function showUpcoming()
    {
        $perPage = 50;
        $movies = UpcomingMovie::paginate($perPage);
        $genres = [
            28 => "Action",
            12 => "Adventure",
            16 => "Animation",
            35 => "Comedy",
            80 => "Crime",
            99 => "Documentary",
            18 => "Drama",
            10751 => "Family",
            14 => "Fantasy",
            36 => "History",
            27 => "Horror",
            10402 => "Music",
            9648 => "Mystery",
            10749 => "Romance",
            878 => "Science Fiction",
            10770 => "TV Movie",
            53 => "Thriller",
            10752 => "War",
            37 => "Western",
        ];

        return view('movies.upcoming', ['movies' => $movies, 'genres' => $genres]);
    }
    
    public function showNowPlaying()
    {
        $perPage = 50;
        $movies = NowPlayingMovie::paginate($perPage);        
        $genres = [
            28 => "Action",
            12 => "Adventure",
            16 => "Animation",
            35 => "Comedy",
            80 => "Crime",
            99 => "Documentary",
            18 => "Drama",
            10751 => "Family",
            14 => "Fantasy",
            36 => "History",
            27 => "Horror",
            10402 => "Music",
            9648 => "Mystery",
            10749 => "Romance",
            878 => "Science Fiction",
            10770 => "TV Movie",
            53 => "Thriller",
            10752 => "War",
            37 => "Western",
        ];

        return view('movies.now_playing', ['movies' => $movies, 'genres' => $genres]);
    }

    public function showPoster($posterPath)
{
    $posterUrl = 'https://image.tmdb.org/t/p/w500/' . $posterPath;

    // Redirecione o usuário para o URL do pôster
    return redirect($posterUrl);
}

public function showDetails($type, $id)
{
    $models = [
        'movies'=> Movie::class,
        'now_playing' => NowPlayingMovie::class,
        'popular' => PopularMovie::class,
        'top_rated' => TopRatedMovie::class,
        'upcoming' => UpcomingMovie::class,
    ];

    if (array_key_exists($type, $models)) {
        $movieModel = app($models[$type]);
        $movie = $movieModel->find($id);
    } else {
        abort(404); // Página não encontrada para tipos de filmes desconhecidos
    }

    if ($movie) {
        return view('movies.details', ['movie' => $movie]);
    }

    abort(404); // Página não encontrada para filmes não encontrados
}

public function filterMoviesByGenre($genreId)
{
    // Filtra os filmes com base no gênero fornecido
    $genreName = $this->getGenreNameById($genreId);
    $filteredMovies = Movie::whereRaw('JSON_CONTAINS(genre_ids, ?)', [$genreId])->paginate(50);

    $genres = [
        28 => "Action",
        12 => "Adventure",
        16 => "Animation",
        35 => "Comedy",
        80 => "Crime",
        99 => "Documentary",
        18 => "Drama",
        10751 => "Family",
        14 => "Fantasy",
        36 => "History",
        27 => "Horror",
        10402 => "Music",
        9648 => "Mystery",
        10749 => "Romance",
        878 => "Science Fiction",
        10770 => "TV Movie",
        53 => "Thriller",
        10752 => "War",
        37 => "Western",
    ];

    // Retorna a visão com os filmes filtrados
    return view('movies.filtered', ['movies' => $filteredMovies, 'genreName' => $genreName, 'genres' => $genres]);
}

private function getGenreNameById($genreId)
{
    $genres = [
        28 => "Action",
        12 => "Adventure",
        16 => "Animation",
        35 => "Comedy",
        80 => "Crime",
        99 => "Documentary",
        18 => "Drama",
        10751 => "Family",
        14 => "Fantasy",
        36 => "History",
        27 => "Horror",
        10402 => "Music",
        9648 => "Mystery",
        10749 => "Romance",
        878 => "Science Fiction",
        10770 => "TV Movie",
        53 => "Thriller",
        10752 => "War",
        37 => "Western",
    ];

    // Retorna o nome do gênero se existir no array, caso contrário, retorna "Desconhecido"
    return $genres[$genreId] ?? "Desconhecido";
}

    private function getModelForApiUrl($apiUrl)
    {
        switch ($apiUrl) {
            case "https://api.themoviedb.org/3/movie/popular?api_key=dc957775a8adf2d615d5a56c0a96b81e":
                return PopularMovie::class;
            case "https://api.themoviedb.org/3/movie/top_rated?api_key=dc957775a8adf2d615d5a56c0a96b81e":
                return TopRatedMovie::class;
            case "https://api.themoviedb.org/3/movie/upcoming?api_key=dc957775a8adf2d615d5a56c0a96b81e":
                return UpcomingMovie::class;
            case "https://api.themoviedb.org/3/movie/now_playing?api_key=dc957775a8adf2d615d5a56c0a96b81e":
                return NowPlayingMovie::class;
            default:
                return null;
        }
    }
}
