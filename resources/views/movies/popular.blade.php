<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes Populares</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .movies-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start; /* Alinhe os itens ao topo */
            padding: 20px;
        }

        .movie-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            max-width: 300px;
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .movie-card img {
            width: 100%;
            height: 300px; /* Defina uma altura específica para a imagem */
            object-fit: cover; /* Garante que a imagem cubra completamente o contêiner */
        }

        .movie-details {
            padding: 20px;
            text-align: center;
        }

        .details-button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Remova a decoração de texto para que pareça um botão */
            display: inline-block; /* Garante que o botão ocupe apenas o espaço necessário */
            margin-top: 10px; /* Adicione um espaço superior para separar o botão do texto */
        }

        .details-button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <header>
        <h1>Popular</h1>
    </header>

    <div class="movies-container">
        @foreach ($movies as $movie)
        <div class="movie-card">
            <img src="{{ asset('movies' . $movie->poster_path) }}" alt="{{ $movie->title }}">
            <div class="movie-details">
                <h2>{{ $movie->title }}</h2>
                <a href="{{ url('/movies/popular', $movie->id) }}" class="details-button">Ver Detalhes</a>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function redirectToDetails(movieId) {
            // Redireciona o usuário para a página de detalhes do filme com base no ID do filme
            window.location.href = `/movie/details/${movieId}`;
        }
    </script>
</body>

</html>
