@props(['chirp'])

<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="{{ Storage::url($chirp->user->avatar) }}"
                        alt="{{ $chirp->user->name }}'s avatar" class="rounded-full" />
                </div>
            </div>

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1">
                        <span class="text-sm font-semibold">
                            <a href="{{ route('profile', $chirp->user->username) }}">
                                {{ $chirp->user->name }}
                            </a>
                        </span>
                        <span>
                            <a href="{{ route('profile', $chirp->user->username) }}">
                                {{ __("@" . $chirp->user->username) }}
                            </a>
                        </span>
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60">{{ $chirp->created_at->diffForHumans() }}</span>
                        @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                            <span class="text-base-content/60">·</span>
                            <span class="text-sm text-base-content/60 italic">edited</span>
                        @endif
                    </div>

                    @can('update', $chirp)
                        <div class="flex gap-1">
                            <a href="/chirps/{{ $chirp->id }}/edit" class="btn btn-ghost btn-xs">
                                Edit
                            </a>
                            <form method="POST" action="/chirps/{{ $chirp->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this chirp?')"
                                    class="btn btn-ghost btn-xs text-error">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
                <p class="mt-1">{{ $chirp->message }}</p>

                <div class="mt-2">
                    <form action="{{ route('chirp.like', $chirp) }}" method="POST">
                        @csrf

                        <button type="submit" class="flex items-center space-x-2 cursor-pointer">
                            @if ($chirp->liked_by_user)
                                <img class="w-4" src="{{ asset('icons/like-full.svg') }}" alt="Like Chirp" />
                            @else
                                <img class="w-4" src="{{ asset('icons/like.svg') }}" alt="Like Chirp" />
                            @endif

                            <span>{{ $chirp->likes_count }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>