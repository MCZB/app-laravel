<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Filme</title>
</head>
<body>
    <h1>Detalhes do Filme</h1>
    @if ($movie)
    <ul>
        <li><strong>Título Original:</strong> {{ $movie->original_title }}</li>
        <li><strong>Resumo:</strong> {{ $movie->overview }}</li>
        <li><strong>Popularidade:</strong> {{ $movie->popularity }}</li>
        <li><strong>Data de Lançamento:</strong> {{ $movie->release_date }}</li>
        <li><strong>Título:</strong> {{ $movie->title }}</li>
    </ul>
    @else
    <p>Filme não encontrado.</p>
    @endif
</body>
</html>
