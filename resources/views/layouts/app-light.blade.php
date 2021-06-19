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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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

    <div class="min-h-screen bg-white" style="z-index: 99999;">
        @livewire('navigation-menu')


        <div class="flex flex-col justify-around w-full md:flex-row">
            <div class="mt-3 bg-white md:w-1/5">
                <div
                    class="fixed left-0 invisible w-0 h-0 overflow-y-scroll bg-white md:px-2 md:py-3 md:visible md:w-1/5 md:mx-auto md:min-h-screen md:mt-14">
                    <div class="min-h-screen pl-8 text-galleria-500 hover:text-galleria-400">
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

            <div class="bg-white md:w-4/5">
                <!-- Page Heading -->
                <div class="px-4 py-6 mx-auto mt-5 bg-white sm:px-6 lg:px-8">
                    {{-- <h2 class="text-2xl font-semibold leading-normal text-gray-900">
                        {{ $header }}
                    </h2> --}}
                </div>
                <!-- </header> -->

                <!-- Page Content -->
                <main>
                    {{-- {{ $slot }} --}}
                    @yield('body')
                </main>

            </div>
        </div>

        {{-- <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header> --}}

        <!-- Page Content -->
        {{-- <main>
            {{ $slot }}
        </main> --}}
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
