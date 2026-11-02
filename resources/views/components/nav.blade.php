<nav x-data="{ open: false }"
    @keydown.escape.window="open = false"
    class="relative bg-primary text-white">

    <div class="h-16 px-4 grid grid-cols-3 items-center">
        <!-- Logo -->
        <div class="flex justify-start">
            <a href="/">
                <span class="text-2xl font-bold text-white">
                    Chatter
                </span>
            </a>
        </div>

        <!-- Hamburger Menu -->
        <button
            @click="open = !open"
            type="button"
            class="md:hidden col-start-3 justify-self-end flex flex-col justify-center items-center w-10 h-10 gap-1.5 text-white focus:outline-none cursor-pointer"
            aria-expanded="open.toString()"
            aria-label="Toggle navigation menu">

            <!-- Hamburger / Cross animation -->
            <span
                class="block w-6 h-0.5 bg-white rounded transition-all duration-300"
                :class="open ? 'translate-y-2 rotate-45' : ''">
            </span>

            <span
                class="block w-6 h-0.5 bg-white rounded transition-all duration-300"
                :class="open ? 'opacity-0' : 'opacity-100'">
            </span>

            <span
                class="block w-6 h-0.5 bg-white rounded transition-all duration-300"
                :class="open ? '-translate-y-2 -rotate-45' : ''">
            </span>
        </button>

        <!-- Desktop Search Bar -->
        <div class="hidden md:flex justify-center">
            <form method="GET" action="/search">
                <input
                    type="text"
                    name="s"
                    placeholder="{{ __('general.search') . '...' }}"
                    class="input w-full md:w-50 input-bordered text-secondary">
            </form>
        </div>

        <!-- Desktop Navigation Icons -->
        <div class="hidden md:flex justify-end items-center gap-2">
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
                <span>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="pt-2 pl-1 pr-1 border-0 bg-transparent hover:bg-transparent hover:cursor-pointer">
                            <x-icons.logout-icon />
                        </button>
                    </form>
                </span>
                <span class="text-sm p-1">
                    <a href="{{ route('profile', auth()->user()->username) }}">
                        <img
                            src="{{ Storage::url(auth()->user()->avatar) }}"
                            alt="{{ auth()->user()->name }}'s avatar"
                            class="size-10 min-w-10 shrink-0 rounded-full object-cover" />
                    </a>
                </span>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm">{{ __('general.signin') }}</a>
                <a href="{{ route('register') }}" class="btn btn-sm">{{ __('general.signup') }}</a>
            @endauth
        </div>
    </div>

    <!-- Responsive Menu -->
    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute top-full left-0 right-0 z-50 bg-primary p-4 shadow-lg flex flex-col gap-4 md:hidden">

        <!-- Mobile Search Bar -->
        <form method="GET" action="/search">
            <input
                type="text"
                name="s"
                placeholder="{{ __('general.search') . '...' }}"
                class="input w-full input-bordered text-secondary">
        </form>

        <!-- Mobile Navigation Icons -->
        <div class="flex items-center justify-around gap-4">
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
                <span>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="pt-2 pl-1 pr-1 border-0 bg-transparent hover:bg-transparent hover:cursor-pointer">
                            <x-icons.logout-icon />
                        </button>
                    </form>
                </span>
                <span class="text-sm p-1">
                    <a href="{{ route('profile', auth()->user()->username) }}">
                        <img
                            src="{{ Storage::url(auth()->user()->avatar) }}"
                            alt="{{ auth()->user()->name }}'s avatar"
                            class="size-10 min-w-10 shrink-0 rounded-full object-cover" />
                    </a>
                </span>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm">{{ __('general.signin') }}</a>
                <a href="{{ route('register') }}" class="btn btn-sm">{{ __('general.signup') }}</a>
            @endauth
        </div>
    </div>
</nav>
