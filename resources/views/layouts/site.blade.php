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

    <header>
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

</body>
</html>