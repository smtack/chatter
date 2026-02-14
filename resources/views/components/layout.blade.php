<!DOCTYPE html>
<html lang="en" data-theme="laravelChirper">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chatter' : 'Chatter' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    {{-- <meta property="og:image" content={{  }} /> --}}
    <meta property="og:title" content="Chatter" />
    <meta property="og:description" content="A social microblogging application." />
    {{-- <meta property="og:url" content="" /> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <nav class="navbar bg-base-100">
        <div class="navbar-start">
            <a href="/">
                <span class="text-2xl font-bold text-[color-primary]">Chatter</span>
            </a>
        </div>

        <!-- Search Bar -->
        <div class="navbar-center">
            <form method="GET" action="/search">
                <input type="text"
                        name="s"
                        placeholder="Search..."
                        class="input w-50 input-bordered">
            </form>
        </div>
        
        <div class="navbar-end gap-2">
            @auth
                <span class="text-sm">
                    <a href="{{ route('profile', auth()->user()->username) }}">
                        {{ auth()->user()->name }}
                    </a>
                </span>
                <span class="text-sm">
                    <a href="{{ route('friends') }}">
                        Friends
                    </a>
                </span>
                <span class="text-sm">
                    <a href="{{ route('auth.update') }}">
                        Settings
                    </a>
                </span>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
            @endauth
        </div>
    </nav>

    <!-- Success Toast -->
    @if (session('success'))
        <div class="toast toast-top toast-center">
            <div class="alert alert-success animate-fade-out">
                <svg xmlns="<http://www.w3.org/2000/svg>" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="w-full mt-24">
        <div class="mx-auto w-full max-w-350 px-4 xl:px-16">
            
        </div>
    </footer>
</body>
</html>