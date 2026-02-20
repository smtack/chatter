<x-layout>
    <x-slot:title>
        {{ __('general.register') }}
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-xl mt-1 font-bold text-center mb-6">{{ __('general.create_account') }}</h1>

                    <form method="POST" action="/register">
                        @csrf

                        <!-- Name -->
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="name"
                                   placeholder="John Doe"
                                   value="{{ old('name') }}"
                                   class="input input-bordered @error('name') input-error @enderror"
                                   required>
                            <span>{{ __('general.name') }}</span>
                        </label>
                        @error('name')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Username -->
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="username"
                                   placeholder="johndoe"
                                   value="{{ old('username') }}"
                                   class="input input-bordered @error('username') input-error @enderror"
                                   required>
                            <span>{{ __('general.username') }}</span>
                        </label>
                        @error('username')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Email -->
                        <label class="floating-label mb-6">
                            <input type="email"
                                   name="email"
                                   placeholder="mail@example.com"
                                   value="{{ old('email') }}"
                                   class="input input-bordered @error('email') input-error @enderror"
                                   required>
                            <span>{{ __('general.email') }}</span>
                        </label>
                        @error('email')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Password -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('password') input-error @enderror"
                                   required>
                            <span>{{ __('general.password') }}</span>
                        </label>
                        @error('password')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Password Confirmation -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="password_confirmation"
                                   placeholder="••••••••"
                                   class="input input-bordered"
                                   required>
                            <span>{{ __('general.confirm_password') }}</span>
                        </label>

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                {{ __('general.register') }}
                            </button>
                        </div>
                    </form>

                    <div class="divider">{{ __('general.or') }}</div>
                    <p class="text-center text-sm">
                        {{ __('general.hasaccount') }}
                        <a href="/login" class="link link-primary">{{ __('general.signin') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>