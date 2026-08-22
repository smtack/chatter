<nav class="navbar bg-blue h-16">
    <div class="navbar-start">
        <a href="/">
            <span class="text-2xl font-bold text-white">Chatter</span>
        </a>
    </div>

    <!-- Search Bar -->
    <div class="navbar-center">
        <form method="GET" action="/search">
            <input type="text"
                    name="s"
                    placeholder="{{ __('general.search') . '...' }}"
                    class="input w-50 input-bordered">
        </form>
    </div>

    <div class="navbar-end gap-2">
        @auth
            <span class="text-sm p-1">
                <a href="{{ route('explore') }}">
                    <x-icons.explore-icon />
                </a>
            </span>
            <span class="text-sm p-1">
                <a href="{{ route('likes') }}">
                    <x-icons.like-white-icon />
                </a>
            </span>
            <span class="text-sm p-1">
                <a href="{{ route('friends') }}">
                    <x-icons.friends-icon />
                </a>
            </span>
            <span class="text-sm p-1">
                <a href="{{ route('auth.update') }}">
                    <x-icons.settings-icon />
                </a>
            </span>
            <span class="">
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="pt-2 pl-1 pr-1 border-0 bg-transparent hover:bg-transparent hover:cursor-pointer">
                        <x-icons.logout-icon />
                    </button>
                </form>
            </span>
            <span class="text-sm p-2">
                <a href="{{ route('profile', auth()->user()->username) }}">
                    <img src="{{ Storage::url(auth()->user()->avatar) }}"
                        alt="{{ auth()->user()->name }}'s avatar" class="size-10 rounded-full" />
                </a>
            </span>
        @else
            <a href="{{ route('login') }}" class="btn btn-sm">{{ __('general.signin') }}</a>
            <a href="{{ route('register') }}" class="btn btn-sm">{{ __('general.signup') }}</a>
        @endauth
    </div>
</nav>
