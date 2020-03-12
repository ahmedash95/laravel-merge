<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Merged</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        @livewireStyles

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-93950970-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-93950970-2');
        </script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>
    <body class="bg-gray-300">
        <div>
        <div class="bg-gray-800 pb-32">
            <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="border-b border-gray-700">
                <div class="flex items-center justify-between h-16 px-4 sm:px-0">
                    <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-32 w-32" src="/lm.svg" alt="logo" />
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline">
                            <a href="/" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Pull Requests</a>
                        </div>
                    </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @livewire('login-component')
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            <div :class="{'block': open, 'hidden': !open}" class="hidden border-b border-gray-700 md:hidden">
                <div class="px-2 py-3 sm:px-3">
                    <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Pull Requests</a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-700">
                    <div class="flex items-center px-5">
                        @auth
                        <a class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700" href="#">
                            Weclome {{ auth()->user()->name }}
                        </a>
                        @endauth
                        @guest
                        <a class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700" href="{{ url('/login') }}">
                            Login via Github
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
            </nav>
            <header class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('title')
            </div>
            </header>
        </div>
        <main class="-mt-32">
            <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
        </div>
    @livewireScripts
    </body>
</html>
