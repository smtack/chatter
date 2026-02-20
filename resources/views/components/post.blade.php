@props(['post'])

<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="{{ Storage::url($post->user->avatar) }}"
                        alt="{{ $post->user->name }}'s avatar" class="rounded-full" />
                </div>
            </div>

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1">
                        <span class="text-sm font-semibold">
                            <a href="{{ route('profile', $post->user->username) }}">
                                {{ $post->user->name }}
                            </a>
                        </span>
                        <span>
                            <a href="{{ route('profile', $post->user->username) }}">
                                {{ __("@" . $post->user->username) }}
                            </a>
                        </span>
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60">{{ $post->created_at->diffForHumans() }}</span>
                        @if ($post->updated_at->gt($post->created_at->addSeconds(5)))
                            <span class="text-base-content/60">·</span>
                            <span class="text-sm text-base-content/60 italic">{{ __('general.edited') }}</span>
                        @endif
                    </div>

                    @can('update', $post)
                        <div class="flex gap-1">
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-ghost btn-xs">
                                {{ __('general.edit') }}
                            </a>
                            <form method="POST" action="/posts/{{ $post->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-ghost btn-xs text-error">
                                    {{ __('general.delete') }}
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
                
                <p class="mt-1">{{ $post->message }}</p>

                <div class="mt-2 flex items-center space-x-4">
                    <form action="{{ route('post.like', $post) }}" method="POST">
                        @csrf

                        <button type="submit" class="flex items-center space-x-2 cursor-pointer">
                            @if ($post->liked_by_user)
                                <img class="w-4" src="{{ asset('icons/like-full.svg') }}" alt="Unlike Post" />
                            @else
                                <img class="w-4" src="{{ asset('icons/like.svg') }}" alt="Like Post" />
                            @endif

                            <span>{{ $post->likes_count }}</span>
                        </button>
                    </form>

                    <a href="/posts/{{ $post->id }}" class="flex space-x-2">
                        <img class="w-4" src="{{ asset('icons/reply.svg') }}" alt="Replies" />
                        <span class="text-black">{{ $post->replies_count }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>