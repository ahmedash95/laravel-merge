<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Merged</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-93950970-2"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.0/dist/alpine-ie11.js" defer></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-93950970-2');
        </script>
    </head>
    <body class="bg-gray-300">
        <div id="container" class="w-2/4 m-auto my-16">
            <h1 class="p-2 mb-8 text text-3xl text-center text-blue-800 bg-white shadow-lg rounded">
                Laravel Merged
            </h1>
            <div id="login" class="text-center mb-8">
                @auth
                    <p>Weclome {{ auth()->user()->name }}</p>
                @endauth
                @guest
                <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    href="{{ url('/login') }}"
                >
                    Login via Github
                </a>
                @endguest
            </div>
            <div id="pr-list">
            @foreach($pullRequests as $pr)
                <div id="pr-item" class="bg-white shadow-lg rounded p-2 mb-4" x-data="{ contentOpen: false }">
                    <div class="flex justify-between">
                        <div class="text-2xl text-indigo-700 font-thin">
                            <a href="{{ url('/r/'.$pr->id) }}" target="_block">
                                {{ $pr->title }}
                            </a>
                        </div>
                        <div class="text-right mr-4 mt-4" @click="contentOpen = !contentOpen">
                            @if(!empty($pr->content))
                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="!contentOpen">
                                <path d="M1.41 0.589996L6 5.17L10.59 0.589996L12 2L6 8L0 2L1.41 0.589996Z" fill="black" fill-opacity="0.54"/>
                            </svg>
                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" x-show="contentOpen">
                                <path d="M6 0L0 6L1.41 7.41L6 2.83L10.59 7.41L12 6L6 0Z" fill="black" fill-opacity="0.54"/>
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-center mt-4">
                            <img
                                class="w-10 h-10 rounded-full mr-4 shadow-lg"
                                src="{{ $pr->author->photo ?? '#' }}"
                                alt="{{ $pr->author->name ?? '-' }}"
                            >
                            <div class="text-sm">
                                <p class="text-gray-700 font-bold leading-none">{{ $pr->author->name ?? '-' }}</p>
                                <p class="text-gray-600">{{ $pr->pr_merged_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div>
                            @if($pr->isToday())
                                <div class="bg-indigo-700 text-indigo-200 mt-6 py-1 px-3">
                                    Today
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 px-4 py-2 leading-8" x-show="contentOpen">
                        @if(!empty($pr->content))
                            <div class>
                                <span class="transform scale-150 rotate-45 translate-x-full origin-center">@markdown($pr->content)</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
            <div id="pagination">
                @include('pagination', ['paginator' => $pullRequests])
            </div>
        </div>
    </body>
</html>
