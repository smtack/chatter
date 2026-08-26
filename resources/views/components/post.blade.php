@props(['post'])

<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            {{-- Avatar --}}
            <div class="avatar shrink-0">
                <div class="size-12 rounded-full">
                    <img
                        src="{{ Storage::url($post->user->avatar) }}"
                        alt="{{ $post->user->name }}'s avatar"
                        class="rounded-full"
                    />
                </div>
            </div>

            {{-- User Info --}}
            <div class="min-w-0 flex-1">
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <div class="text-sm font-semibold">
                            <a href="{{ route('profile', $post->user->username) }}">
                                {{ $post->user->full_name }}
                            </a>
                        </div>
                        <div class="text-sm text-base-content/60">
                            <a href="{{ route('profile', $post->user->username) }}">
                                {{ __("@" . $post->user->username) }}
                            </a>
                        </div>
                        <div class="text-sm text-base-content/60">
                            <span>{{ $post->created_at->diffForHumans() }}</span>

                            @if ($post->updated_at->gt($post->created_at->addSeconds(5)))
                                <span class="text-base-content/60">·</span>
                                <span class="text-sm text-base-content/60 italic">{{ __('general.edited') }}</span>
                            @endif
                        </div>

                        @if (!request()->routeIs('profile'))
                            <div class="text-sm text-base-content/60">
                                on
                                <a href="{{ route('profile', $post->profile) }}">
                                    {{ $post->profile->full_name }}'s profile
                                </a>
                            </div> 
                        @endif
                    </div>

                    @can('update', $post)
                        <div class="flex gap-1 shrink-0">
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-ghost btn-xs">
                                {{ __('general.edit') }}
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

        {{-- Post Content --}}
        <div class="mt-2">
            <p class="mt-2">{{ $post->message }}</p>

            @if ($post->image)
                <div class="mt-4">
                    <img
                        src="{{ Storage::url($post->image) }}"
                        alt="{{ Storage::url($post->image) }}"
                        class="rounded-lg max-h-96 w-full object-cover"
                    />
                </div>
            @endif
        </div>

        {{-- Like and Reply --}}
        <div class="mt-3 flex items-center space-x-4">
            <form action="{{ route('post.like', $post) }}" method="POST">
                @csrf

                <button type="submit" class="flex items-center space-x-2 cursor-pointer">
                    @if ($post->liked_by_user)
                        <x-icons.like-full-icon />
                    @else
                        <x-icons.like-icon />
                    @endif

                    <span>{{ $post->likes_count }}</span>
                </button>
            </form>

            <a href="/posts/{{ $post->id }}" class="flex space-x-2">
                <x-icons.reply-icon />
                <span class="text-black">{{ $post->replies_count }}</span>
            </a>
        </div>
    </div>
</div>
