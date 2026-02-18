<x-layout>
    <x-slot:title>
        Friends
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-xl mt-1 font-bold text-center mb-6">Friend Requests</h1>

        <div class="space-y-4 mt-4">
            @forelse ($pendingFriendRequests as $user)
                <x-user :user="$user" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">No Friend Requests!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-xl mt-1 font-bold text-center mb-6">Friends</h1>

        <div class="space-y-4 mt-4">
            @forelse ($friends as $friend)
                <x-user :user="$friend" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">No friends yet!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>