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
       <div class="mt-4 rounded-lg bg-white p-4 shadow-sm ring-1 ring-slate-200">
    <p class="font-semibold text-slate-900">
        {{ $comment->user->name }}
    </p>

    <p class="mt-2 text-slate-700">
        {{ $comment->content }}
    </p>
</div>
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
    <h3 class="mt-8 text-xl font-semibold text-slate-900">
    Kommentar schreiben
</h3>

<form
    method="POST"
    action="{{ route('comments.store', $article) }}"
    class="mt-4 max-w-xl"
>
    @csrf

    <label
        for="content"
        class="mb-2 block text-sm font-medium text-slate-700"
    >
        Kommentar
    </label>

    <textarea
        id="content"
        name="content"
        rows="4"
        class="w-full rounded-md border border-slate-300 bg-white p-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
    ></textarea>

    <button
        type="submit"
        class="mt-3 rounded-md bg-slate-900 px-4 py-2 font-semibold text-white transition hover:bg-slate-700"
    >
        Kommentar speichern
    </button>
</form>
@else
    <p>
        <a href="{{ route('login') }}">Einloggen</a>, um einen Kommentar zu schreiben.
    </p>
@endauth
</x-site-layout>