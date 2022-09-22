<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $nombre . ' - 14 Televisión' }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
        <style>
            .video-responsivo {
                position: relative;
                padding-bottom: 56.25%;
                padding-top: 0px;
                height: 0;
                /* overflow: hidden; */
            }
    
            .video-responsivo iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>

        <!-- Styles -->
        @livewireStyles
        @stack('css')
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />
        
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            
            <!-- Page Heading -->
            @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        
        <script src="{{ mix('js/app.js') }}" defer></script>
        @stack('modals')
        
        @livewireScripts
        @stack('js')
    </body>
</html>
