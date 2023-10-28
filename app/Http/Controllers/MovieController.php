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

    public function showPopular()
    {
        $perPage = 50;
        $movies = PopularMovie::paginate($perPage);
        return view('movies.popular', ['movies' => $movies]);
    }
    
    public function showTopRated()
    {
        $perPage = 50;
        $movies = TopRatedMovie::paginate($perPage);
        return view('movies.top_rated', ['movies' => $movies]);
    }
    
    public function showUpcoming()
    {
        $perPage = 50;
        $movies = UpcomingMovie::paginate($perPage);
        return view('movies.upcoming', ['movies' => $movies]);
    }
    
    public function showNowPlaying()
    {
        $perPage = 50;
        $movies = NowPlayingMovie::paginate($perPage);
        return view('movies.now_playing', ['movies' => $movies]);
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
