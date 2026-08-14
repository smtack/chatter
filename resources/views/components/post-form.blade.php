@props(['user'])

<div class="card bg-base-100 shadow mt-8">
    <div class="card-body">
        <form method="POST" action="{{ route('posts.store', $user) }}">
            @csrf

            <div class="form-control w-full">
                <textarea
                    name="message"
                    placeholder="{{ __('general.whats_on_your_mind') }}"
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
                    {{ __('general.post') }}
                </button>
            </div>
        </form>
    </div>
</div>
