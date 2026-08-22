<!DOCTYPE html>
<html lang="en" data-theme="laravelCustom">

<x-head />

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <!-- Success Toast -->
    @if (session('success'))
        <x-notifications.success />
    @endif

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
