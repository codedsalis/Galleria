<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ env('APP_KEYWORDS') }}">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Favicons and manifest -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="antialiased font-roboto">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')


        <div class="flex flex-col justify-around w-full md:flex-row">
            <div class="mt-3 bg-white md:w-1/5">
                <div
                    class="fixed left-0 invisible w-0 h-0 overflow-y-scroll bg-white md:px-2 md:py-3 md:visible md:w-1/5 md:mx-auto md:min-h-screen md:mt-14">
                    <div class="min-h-screen pl-8 text-galleria-500 hover:text-galleria-400">
                        @yield('nav-links')
                    </div>
                </div>
            </div>

            <div class="py-6 bg-gray-100 md:py-12 md:w-4/5">

                <!-- Page Content -->
                <main class="m-5 md:m-0">
                    @yield('body')
                </main>

            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
