<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin-Artikelübersicht</title>
</head>
<body>
    <h1>Admin-Artikelübersicht</h1>
    @forelse ($articles as $article)
    <article>
        <h2>{{ $article->title }}</h2>

        @if ($article->is_published)
            <p>Status: Veröffentlicht</p>
        @else
            <p>Status: Entwurf</p>
        @endif

        <a href="{{ route('admin.articles.edit', $article) }}">
    Artikel bearbeiten
</a>

<form method="POST" action="{{ route('admin.articles.destroy', $article) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Artikel löschen
    </button>
</form>
    </article>
@empty
    <p>Keine Artikel vorhanden.</p>
@endforelse
</body>
</html>