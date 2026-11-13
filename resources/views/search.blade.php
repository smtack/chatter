<x-layout>
    <x-slot:title>
        {{ __('general.search') }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="space-y-4 mt-8">
            @forelse ($users as $user)
                <x-user :user="$user" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <x-icons.speech-icon />
                            <p class="mt-4 text-base-content/60">{{ __('general.no_users') }}</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
