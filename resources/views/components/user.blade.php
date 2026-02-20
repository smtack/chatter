@props(['user'])

<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s avatar" class="rounded-full" />
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
                <h4 class="text-sm text-base-content/60">{{ __('general.joined') }} {{ $user->created_at->diffForHumans() }}</h4>

                <p class="mt-2 text-gray-800">{{ $user->bio }}</p>
            </div>
            <div>
                @auth
                    @if (auth()->user()->isFriendsWith($user))
                        <form action="{{ route('friends.remove', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-ghost btn-xs">{{ __('general.remove_friend') }}</button>
                        </form>
                    @elseif (auth()->user()->hasSentFriendRequest($user))
                        <button class="btn btn-ghost btn-xs">{{ __('general.friend_sent') }}</button>
                    @elseif (auth()->user()->hasReceivedFriendRequest($user))
                        <form action="{{ route('friends.accept', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-ghost btn-xs">{{ __('general.accept_friend') }}</button>
                        </form>
                    @elseif (auth()->id() !== $user->id)
                        <form action="{{ route('friends.add', $user) }}" method="POST">
                            @csrf

                            <button class="btn btn-primary btn-xs sla">{{ __('general.add_friend') }}</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>