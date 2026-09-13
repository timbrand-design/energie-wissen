<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energie-Wissen</title>
</head>
<body>
    <h1>Wissensartikel über erneuerbare Energien</h1>

    @forelse ($articles as $article)
        <article>
            <h2>{{ $article->title }}</h2>

            <p>{{ $article->excerpt }}</p>

            <p>
                Kategorie: {{ $article->category->name }}
            </p>

            <p>
                Autor: {{ $article->user->name }}
            </p>
            <a href="{{ route('articles.show', $article) }}">
    Artikel lesen
</a>
        </article>
    @empty
        <p>Keine veröffentlichten Artikel vorhanden.</p>
    @endforelse
</body>
</html>