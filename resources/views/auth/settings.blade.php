<x-layout>
    <x-slot:title>
        Update Profile
    </x-slot:title>

    <div class="hero">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-xl mt-1 font-bold text-center mb-6">Update Profile</h1>

                    <form method="POST" action="{{ route('auth.update-profile') }}">
                        @csrf

                        <!-- Name -->
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="name"
                                   placeholder="John Doe"
                                   value="{{ auth()->user()->name }}"
                                   class="input input-bordered @error('name') input-error @enderror"
                                   required>
                            <span>Name</span>
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
                                   value="{{ auth()->user()->username }}"
                                   class="input input-bordered @error('username') input-error @enderror"
                                   required>
                            <span>Username</span>
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
                                   value="{{ auth()->user()->email }}"
                                   class="input input-bordered @error('email') input-error @enderror"
                                   required>
                            <span>Email</span>
                        </label>
                        @error('email')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-xl mt-1 font-bold text-center mb-6">Update Avatar</h1>

                    <form enctype="multipart/form-data" method="POST" action="{{ route('auth.update-avatar') }}">
                        @csrf

                        <!-- Avatar -->
                        <label class="floating-label mb-6">
                            <input type="file"
                                   name="avatar"
                                   class="input input-bordered @error('avatar') input-error @enderror"
                                   required>
                            <span>Avatar</span>
                        </label>
                        @error('avatar')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <div class="hero">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-xl mt-1 font-bold text-center mb-6">Update Bio</h1>

                    <form method="POST" action="{{ route('auth.update-bio') }}">
                        @csrf

                        <!-- Bio -->
                        <label class="floating-label mb-6">
                            <textarea
                                name="bio"
                                placeholder="Tell people about yourself..."
                                class="input input-bordered h-40 resize-none text-wrap @error('bio') input-error @enderror"
                                required>{{ auth()->user()->bio }}</textarea>
                            <span>Bio</span>
                        </label>
                        @error('bio')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Update Bio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-xl mt-1 font-bold text-center mb-6">Update Password</h1>

                    <form method="POST" action="{{ route('auth.update-password') }}">
                        @csrf

                        <!-- Current Password -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="current_password"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('current_password') input-error @enderror"
                                   required>
                            <span>Current Password</span>
                        </label>
                        @error('current_password')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- New Password -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="new_password"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('new_password') input-error @enderror"
                                   required>
                            <span>New Password</span>
                        </label>
                        @error('new_password')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Password Confirmation -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="new_password_confirmation"
                                   placeholder="••••••••"
                                   class="input input-bordered"
                                   required>
                            <span>Confirm Password</span>
                        </label>

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-xl mt-1 font-bold text-center mb-6">Delete Profile</h1>

                    <form method="POST" action="{{ route('auth.delete-profile') }}">
                        @csrf
                        
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

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>