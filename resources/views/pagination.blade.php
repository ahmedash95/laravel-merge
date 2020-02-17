@if ($paginator->hasPages())
    <ul class="pagination flex justify-between list-reset text-indigo-700 font-bold">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"></li>
        @else
            <li>
                <a class="button bg-transparent border border-brown py-2 px-4 rounded opacity-85" href="{{ $paginator->previousPageUrl() }}" rel="prev">« Recent
                </a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a class="button bg-transparent border border-brown py-2 px-4 rounded opacity-85" href="{{ $paginator->nextPageUrl() }}" rel="next">Older »</a>
            </li>
        @else
            <li class="disabled "></li>
        @endif
    </ul>
@endif