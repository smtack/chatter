@props(['user'])

<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="https://avatars.laravel.cloud/{{ urlencode($user->email) }}"
                        alt="{{ $user->name }}'s avatar" class="rounded-full" />
                </div>
            </div>

            <div class="min-w-0 flex-1">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('profile', $user->username) }}">
                        {{ $user->name }}
                    </a>
                </h2>
                <h3>
                    <a href="{{ route('profile', $user->username) }}">
                        {{ __("@" . $user->username) }}
                    </a>
                </h3>
                <h4 class="text-sm text-base-content/60">Joined {{ $user->created_at->diffForHumans() }}</h4>
            </div>
        </div>
    </div>
</div>