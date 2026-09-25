<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Artikel bearbeiten</title>
</head>
<body>
    <h1>Artikel bearbeiten</h1>

    <form method="POST" action="{{ route('admin.articles.update', $article) }}">
        @csrf

        <label for="title">Titel</label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ $article->title }}"
        >

        <br><br>

        <label for="excerpt">Kurzbeschreibung</label>

        <textarea
            id="excerpt"
            name="excerpt"
        >{{ $article->excerpt }}</textarea>
        <br><br>

<label for="content">Inhalt</label>

<textarea
    id="content"
    name="content"
>{{ $article->content }}</textarea>
<br><br>

<label for="category_id">Kategorie</label>

<select id="category_id" name="category_id">
    @foreach ($categories as $category)
        <option
            value="{{ $category->id }}"
            @selected($article->category_id === $category->id)
        >
            {{ $category->name }}
        </option>
    @endforeach
</select>
<br><br>

<label for="user_id">Autor</label>

<select id="user_id" name="user_id">
    @foreach ($users as $user)
        <option
            value="{{ $user->id }}"
            @selected($article->user_id === $user->id)
        >
            {{ $user->name }}
        </option>
    @endforeach
</select>
<br><br>

<label for="is_published">
    <input
        type="checkbox"
        id="is_published"
        name="is_published"
        value="1"
        @checked($article->is_published)
    >
    Veröffentlicht
</label>
<br><br>

<button type="submit">
    Änderungen speichern
</button>
    </form>
</body>
</html>