<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-83.75 w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
            <div class="text-[13px] leading-5 flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                <h1 class="mb-1 font-medium">Welcome to Chirper!</h1>
                <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A]">This is a demo application for the Laravel Learn Bootcamp mini course that can be found at <a href="https://laravel.com/learn">https://laravel.com/learn</a></p>
            </div>
            <div class="bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-335/376 lg:aspect-auto w-full lg:w-109.5 shrink-0 overflow-hidden">
                <img class="block w-full h-full object-cover" src="{{ asset('images/og.jpeg') }}" alt="Chirper Logo" />

                <div class="absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"></div>
            </div>
        </main>
    </div>
</x-layout>
