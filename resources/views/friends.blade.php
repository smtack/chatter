<x-layout>
    <x-slot:title>
        {{ __('general.friends') }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-xl mt-1 font-bold text-center mb-6">{{ __('general.friend_requests') }}</h1>

        <div class="space-y-4 mt-4">
            @forelse ($pendingFriendRequests as $user)
                <x-user :user="$user" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">{{ __('general.no_requests') }}</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-xl mt-1 font-bold text-center mb-6">{{ __('general.friends') }}</h1>

        <div class="space-y-4 mt-4">
            @forelse ($friends as $friend)
                <x-user :user="$friend" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">{{ __('general.no_friends') }}</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>