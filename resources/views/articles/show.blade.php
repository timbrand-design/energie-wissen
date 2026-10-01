<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
</head>
<body>
    <h1>{{ $article->title }}</h1>
    @if (session('success'))
    <p>{{ session('success') }}</p>
@endif

    <p>{{ $article->content }}</p>

    <p>
        Kategorie: {{ $article->category->name }}
    </p>

    <p>
        Autor: {{ $article->user->name }}
    </p>
    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Artikel löschen
    </button>
</form>

    <h2>Kommentare</h2>

    @forelse ($article->comments as $comment)
        <p>
            <strong>{{ $comment->user->name }}:</strong>
            {{ $comment->content }}
        </p>
    @empty
        <p>Noch keine Kommentare vorhanden.</p>
    @endforelse
    @auth
    <h3>Kommentar schreiben</h3>

    <form method="POST" action="{{ route('comments.store', $article) }}">
        @csrf

        <label for="content">Kommentar</label>

        <br>

        <textarea
            id="content"
            name="content"
            rows="4"
        ></textarea>

        <br><br>

        <button type="submit">
            Kommentar speichern
        </button>
    </form>
@else
    <p>
        <a href="{{ route('login') }}">Einloggen</a>, um einen Kommentar zu schreiben.
    </p>
@endauth
</body>
</html>