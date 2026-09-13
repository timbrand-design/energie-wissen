<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel erstellen</title>
</head>
<body>
    <h1>Neuen Artikel erstellen</h1>

    <form method="POST" action="{{ route('admin.articles.store') }}">
        @csrf

        <div>
            <label for="title">Titel</label>
            <input type="text" id="title" name="title">
        </div>

        <br>

        <div>
            <label for="excerpt">Kurzbeschreibung</label>
            <textarea id="excerpt" name="excerpt"></textarea>
        </div>

        <br>

        <div>
            <label for="content">Inhalt</label>
            <textarea id="content" name="content"></textarea>
        </div>

        <br>

        <div>
            <label for="category_id">Kategorie</label>
            <select id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="user_id">Autor</label>
            <select id="user_id" name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <label for="is_published">
            <input type="checkbox" id="is_published" name="is_published" value="1">
            Veröffentlicht
        </label>

        <br><br>

        <button type="submit">Artikel speichern</button>
    </form>
</body>
</html>