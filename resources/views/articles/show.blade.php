<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
</head>
<body>
    <h1>{{ $article->title }}</h1>

    <p>{{ $article->content }}</p>

    <p>
        Kategorie: {{ $article->category->name }}
    </p>

    <p>
        Autor: {{ $article->user->name }}
    </p>

    <h2>Kommentare</h2>

    @forelse ($article->comments as $comment)
        <p>
            <strong>{{ $comment->user->name }}:</strong>
            {{ $comment->content }}
        </p>
    @empty
        <p>Noch keine Kommentare vorhanden.</p>
    @endforelse
</body>
</html>