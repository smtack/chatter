<x-layout>
    <x-slot:title>
        {{ $user->name }} {{ __('general.users_profile') }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <x-user :user="$user" />

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