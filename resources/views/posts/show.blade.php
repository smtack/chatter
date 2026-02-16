<x-layout>
    <x-slot:title>
        Post by {{ $post->user->name }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="space-y-4 mt-8">
            <x-post :post="$post" />
        </div>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/replies/{{ $post->id }}">
                    @csrf

                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            placeholder="What do you think?"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
                            required
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Feed -->
        <div class="space-y-4 mt-8">
            @forelse ($replies as $reply)
                <div class="card bg-base-100">
                    <div class="card-body">
                        <div class="flex space-x-3">
                            <div class="avatar">
                                <div class="size-10 rounded-full">
                                    <img src="{{ Storage::url($reply->user->avatar) }}"
                                        alt="{{ $reply->user->name }}'s avatar" class="rounded-full" />
                                </div>
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex justify-between w-full">
                                    <div class="flex items-center gap-1">
                                        <span class="text-sm font-semibold">
                                            <a href="{{ route('profile', $reply->user->username) }}">
                                                {{ $reply->user->name }}
                                            </a>
                                        </span>
                                        <span>
                                            <a href="{{ route('profile', $reply->user->username) }}">
                                                {{ __("@" . $reply->user->username) }}
                                            </a>
                                        </span>
                                        <span class="text-base-content/60">·</span>
                                        <span class="text-sm text-base-content/60">{{ $reply->created_at->diffForHumans() }}</span>
                                        @if ($reply->updated_at->gt($reply->created_at->addSeconds(5)))
                                            <span class="text-base-content/60">·</span>
                                            <span class="text-sm text-base-content/60 italic">edited</span>
                                        @endif
                                    </div>

                                    @can('update', $reply)
                                        <div class="flex gap-1">
                                            <a href="/replies/{{ $reply->id }}/edit" class="btn btn-ghost btn-xs">
                                                Edit
                                            </a>
                                            <form method="POST" action="/replies/{{ $reply->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-ghost btn-xs text-error">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                                <p class="mt-1">{{ $reply->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-base-content/60">No replies yet. Be the first to respond!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $replies->links() }}
        </div>
    </div>
</x-layout>