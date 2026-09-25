<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Artikel bearbeiten</title>
</head>
<body>
    <h1>Artikel bearbeiten</h1>

    <form method="POST" action="#">
        @csrf

        <label for="title">Titel</label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ $article->title }}"
        >
    </form>
</body>
</html>