<x-layout>
    <x-slot:title>
        {{ __('general.post_by') }} {{ $post->user->name }}
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
                            placeholder="{{ __('general.what_do_you_think') }}"
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
                            {{ __('general.reply') }}
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
                                            <span class="text-sm text-base-content/60 italic">{{ __('general.edited') }}</span>
                                        @endif
                                    </div>

                                    @can('update', $reply)
                                        <div class="flex gap-1">
                                            <a href="/replies/{{ $reply->id }}/edit" class="btn btn-ghost btn-xs">
                                                {{ __('general.edit') }}
                                            </a>
                                            <form method="POST" action="/replies/{{ $reply->id }}">
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
                                <p class="mt-1">{{ $reply->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">{{ __('general.no_replies') }}</p>
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