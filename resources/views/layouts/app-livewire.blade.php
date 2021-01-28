<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ env('APP_KEYWORDS') }}">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

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

<body class="font-roboto antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')


        <div class="flex flex-col md:flex-row justify-around w-full">
            <div class="bg-white md:w-1/5 mt-3">
                <div
                    class="bg-white w-0 h-0 md:px-2 md:py-3 invisible md:visible md:w-1/5 md:mx-auto md:min-h-screen md:mt-14 fixed left-0 overflow-y-scroll">
                    <div class="text-galleria-500 min-h-screen pl-8 hover:text-galleria-400">
                        <div class="font-normal">
                            Navigation links should be made in longer and bigger
                        </div>
                        <div class="font-normal">
                            Navigation links should be made in longer and bigger
                        </div>
                        <div class="font-normal">
                            Navigation links should be made in longer and bigger
                        </div>
                        <div class="font-normal">
                            Navigation links should be made in longer and bigger
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-6 md:py-12 bg-gray-100 md:w-4/5">
                <!-- Page Heading -->
                <div class="bg-gray-100 max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 mt-14">
                    <h2 class="font-semibold text-3xl text-dark-500 leading-normal">
                        @yield('header')
                    </h2>
                </div>
                <!-- </header> -->

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
