<x-layouts.layout>
    <x-slot:title>
        {{ __('general.edit_reply') }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">{{ __('general.edit_reply') }}</h1>

        <div class="card bg-base-100 mt-8">
            <div class="card-body">
                <form method="POST" action="/replies/{{ $reply->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
                            required
                        >{{ old('message', $reply->message) }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="card-actions justify-between mt-4">
                        <a href="/posts/{{ $reply->post_id }}" class="btn btn-ghost btn-sm">
                            {{ __('general.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            {{ __('general.update_reply') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-2xl mx-auto mt-4">
            <div class="card bg-base-100">
                <div class="card-body">
                    <h2 class="text-lg font-semibold">{{ __('general.delete_reply') }}</h2>
                    <p class="text-sm text-base-content/60 mt-1">{{ __('general.delete_reply_warning') }}</p>

                   <form method="POST" action="/replies/{{ $reply->id }}" class="flex justify-end mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-error btn-sm text-white">
                            {{ __('general.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>
