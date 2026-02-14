<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-83.75 w-full flex-col lg:max-w-5xl lg:flex-row">
            <div class="text-[13px] leading-5 flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg rounded-tl-lg rounded-tr-lg mb-2 lg:mb-0 lg:rounded-tl-lg lg:rounded-br-lg lg:rounded-tr-lg">
                <h1 class="mb-1 font-large text-2xl">Welcome to Chatter!</h1>
                <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A]">Chatter is a social microblogging application. Sign up and make friends!</a></p>
            </div>
            <div class="relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-335/376 lg:aspect-auto w-full lg:w-109.5 shrink-0 overflow-hidden">
                <div class="card w-full bg-base-100">
                    <div class="card-body">
                        <form method="POST" action="/login">
                            @csrf

                            <!-- Email -->
                            <label class="floating-label mb-6">
                                <input type="email"
                                    name="email"
                                    placeholder="mail@example.com"
                                    value="{{ old('email') }}"
                                    class="input input-bordered @error('email') input-error @enderror"
                                    required
                                    autofocus>
                                <span>Email</span>
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
                                <span>Password</span>
                            </label>
                            @error('password')
                                <div class="label -mt-4 mb-2">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror

                            <!-- Remember Me -->
                            <div class="form-control mt-4">
                                <label class="label cursor-pointer justify-start">
                                    <input type="checkbox"
                                        name="remember"
                                        class="checkbox">
                                    <span class="label-text ml-2">Remember me</span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-control mt-8">
                                <button type="submit" class="btn btn-primary btn-sm w-full">
                                    Sign In
                                </button>
                            </div>
                        </form>

                        <div class="divider">OR</div>
                        <p class="text-center text-sm">
                            Don't have an account?
                            <a href="/register" class="link link-primary">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout>
