<div>
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
