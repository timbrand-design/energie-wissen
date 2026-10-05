<x-site-layout>

<h1 class="mb-8 text-3xl font-bold text-slate-800">
    Wissensartikel über erneuerbare Energien
</h1>

<form
    method="GET"
    action="{{ route('articles.index') }}"
    class="mb-10 flex flex-wrap items-end gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200"
>    <div>
        <label for="search">Suche</label>

        <input
            type="text"
            id="search"
            name="search"
            value="{{ $search }}"
            placeholder="Artikel suchen"
        >
    </div>

    <br>

    <div>
        <label for="category">Kategorie</label>

        <select id="category" name="category">
            <option value="">Alle Kategorien</option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected((string) $categoryId === (string) $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <button type="submit">
        Suchen und filtern
    </button>

    @if ($search || $categoryId)
        <a href="{{ route('articles.index') }}">
            Filter zurücksetzen
        </a>
    @endif
</form>

<br>

    @if (session('success'))
    <p>{{ session('success') }}</p>
@endif

    @forelse ($articles as $article)
<article class="mb-6 rounded-lg bg-white p-6 shadow-sm ring-1 ring-slate-200">        
<h2 class="text-xl font-semibold text-slate-900">
    {{ $article->title }}
</h2>
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
</x-site-layout>