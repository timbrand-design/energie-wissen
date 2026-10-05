<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Energy Knowledge')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">

    <header class="border-b border-slate-800 bg-slate-950">
        <nav>
           <a href="{{ url('/') }}">
    Energy Knowledge
</a>

@isset($menu)
    @foreach ($menu as $item)
        <a href="{{ $item['link'] }}">
            {{ $item['label'] }}
        </a>
    @endforeach
@else
    <a href="{{ route('articles.index') }}">
        Artikel
    </a>
@endisset

            @auth
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                @can('create', \App\Models\Article::class)
                    <a href="{{ route('admin.articles.index') }}">
                        Verwaltung
                    </a>
                @endcan

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}">
                    Registrieren
                </a>
            @endauth
        </nav>
    </header>

    @if (session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div>
            <p>Bitte prüfe deine Eingaben:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <main>
    @yield('content')

    {{ $slot ?? '' }}
</main>

<footer class="mt-12 border-t border-slate-300 bg-white">
    <div class="mx-auto max-w-6xl px-6 py-6 text-sm text-slate-600">
        <p>
            &copy; {{ date('Y') }} Energy Knowledge
        </p>

        <p class="mt-1">
            Wissen über erneuerbare Energien
        </p>
    </div>
</footer>

</body>
</html>