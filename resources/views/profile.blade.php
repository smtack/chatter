<x-layout>
    <x-slot:title>
        {{ $user->name }}'s {{ __('general.users_profile') }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <x-user :user="$user" />

        @auth
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('posts.store', $user) }}">
                        @csrf

                        <div x-data="{ message: '' }" class="form-control w-full">
                            <textarea
                                name="message"
                                x-model="message"
                                maxlength="255"
                                placeholder="{{ __('general.whats_on_your_mind') }}"
                                class="textarea textarea-bordered w-full h-10 resize-none @error('message') textarea-error @enderror"
                                required
                            >{{ old('message') }}</textarea>

                            @error('message')
                                <div class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror

                            <div class="text-right text-sm mt-1">
                                <span
                                    x-text="message.length + ' / 255'"
                                    :class="message.length >= 255 ? 'text-red-500' : 'text-gray-500'"
                                ></span>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <input type="file" name="image" accept="image/*" class="file-input file-input-bordered file-input-sm w-full max-w-xs mr-4 @error('image') file-input-error @enderror">

                            <button type="submit" class="btn btn-primary btn-sm">
                                {{ __('general.post') }}
                            </button>
                        </div>

                        @error('image')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </form>
                </div>
            </div>
        @endauth

        <div class="space-y-4 mt-8">
            @forelse ($posts as $post)
                <x-post :post="$post" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">{{ __('general.no_posts') }}</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
