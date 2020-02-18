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
                <div id="pr-item" class="bg-white shadow-lg rounded p-2 mb-4">
                    <div class="text-2xl text-indigo-700 font-thin">
                        <a href="{{ url('/r/'.$pr->id) }}" target="_block">
                            {{ $pr->title }}
                        </a>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-center mt-4">
                            <img
                                class="w-10 h-10 rounded-full mr-4 shadow-lg"
                                src="{{ $pr->author_photo }}"
                                alt="{{ $pr->author_name }}"
                            >
                            <div class="text-sm">
                                <p class="text-gray-700 font-bold leading-none">{{ $pr->author_name }}</p>
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
                </div>
            @endforeach
            </div>
            <div id="pagination">
                @include('pagination', ['paginator' => $pullRequests])
            </div>
        </div>
    </body>
</html>
