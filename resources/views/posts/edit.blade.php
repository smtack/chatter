<x-layouts.layout>
    <x-slot:title>
        {{ __('general.edit_post') }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">{{ __('general.edit_post') }}</h1>

        <div class="card bg-base-100 mt-8">
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="/posts/{{ $post->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
                            required
                        >{{ old('message', $post->message) }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <input type="file" name="image" accept="image/*" class="file-input file-input-bordered file-input-sm w-full max-w-xs mr-4 @error('image') file-input-error @enderror">
                    </div>

                    <div class="card-actions justify-between mt-4">
                        <a href="{{ url()->previous(route('home')) }}" class="btn btn-ghost btn-sm">
                            {{ __('general.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            {{ __('general.update_post') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($post->image)
        <div class="max-w-2xl mx-auto mt-4">
            <div class="card bg-base-100">
                <div class="card-body">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ __('general.post_image') }}" class="rounded-lg max-h-96 w-full object-cover">

                    <form method="POST" action="{{ route('posts.destroy-image', $post) }}" class="flex justify-end mt-4">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-error btn-sm text-white">
                            {{ __('general.delete_image') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-2xl mx-auto mt-4">
        <div class="card bg-base-100">
            <div class="card-body">
                <h2 class="text-lg font-semibold">{{ __('general.delete_post') }}</h2>
                <p class="text-sm text-base-content/60 mt-1">{{ __('general.delete_post_warning') }}</p>

                <form method="POST" action="/posts/{{ $post->id }}" class="flex justify-end mt-4">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-error btn-sm text-white">
                        {{ __('general.delete_post') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.layout>
