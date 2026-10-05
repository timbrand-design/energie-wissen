<x-site-layout>

<h1 class="text-3xl font-bold text-slate-900">
    {{ $article->title }}
</h1>

  <p class="mt-8 whitespace-pre-line text-lg leading-8 text-slate-700">
    {{ $article->content }}
</p>

   <p class="mt-4 text-sm text-slate-600">
    Kategorie: {{ $article->category->name }}
</p>

<p class="text-sm text-slate-600">
    Autor: {{ $article->user->name }}
</p>
    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Artikel löschen
    </button>
</form>

<h2 class="mt-12 border-t border-slate-200 pt-8 text-2xl font-bold text-slate-900">
    Kommentare
</h2>
    @forelse ($article->comments as $comment)
        <p>
            <strong>{{ $comment->user->name }}:</strong>
            {{ $comment->content }}
        </p>
        @can('delete', $comment)
    <form
        method="POST"
        action="{{ route('comments.destroy', ['article' => $article, 'comment' => $comment]) }}"
    >
        @csrf
        @method('DELETE')

        <button type="submit">
            Kommentar löschen
        </button>
    </form>
@endcan
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
</x-site-layout>