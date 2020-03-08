@extends('layout')
@section('content')
<div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        {{-- Desktop --}}
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 hidden md:block">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Author
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Github
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white">
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 flex justify-between">
                        <div>
                            <div class="text-md leading-5 text-gray-900">
                                {{ $pr->title }}
                            </div>
                            <div class="text-sm leading-5 text-gray-500">{{ $pr->pr_merged_at->format('Y-m-d H:i') }}   @if($pr->isToday())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    | Today
                                </span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <a href="{{ $pr->author->url() }}">
                                    <img class="h-10 w-10 rounded-full" src="{{ $pr->author->photo ?? '#' }}" alt="{{ $pr->author->name ?? '-' }}" />
                                </a>
                            </div>
                            <div class="ml-4">
                                <a class="text-sm leading-5 font-medium text-gray-600" href="{{ $pr->author->url() }}">
                                    {{ $pr->author->name ?? '-' }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        <a href="{{ url('/r/'.$pr->id) }}" target="_block" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-purple-500">
                            #{{ $pr->pr_id }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="bg-white p-4">
                        <div class="overflow-x-auto origin-center">
                            @markdown($pr->content)
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        {{-- Mobile --}}
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 md:hidden">
            <div class="bg-white border-b border-gray-200 p-2 text-md leading-5 text-gray-900">
                <div>
                    {{ $pr->title }}
                </div>
                <div class="text-sm leading-5 text-gray-500 mt-1 flex">
                    <div class="">
                        {{ $pr->pr_merged_at->format('Y-m-d H:i') }}   @if($pr->isToday())
                            <div class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                               | Today
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="pt-2 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-6 w-6">
                                <img class="h-6 w-6 rounded-full" src="{{ $pr->author->photo ?? '#' }}" alt="{{ $pr->author->name ?? '-' }}" />
                            </div>
                            <div class="ml-2">
                                <a class="text-sm leading-5 font-medium text-gray-600" href="{{ $pr->author->url() }}">
                                    {{ $pr->author->name ?? '-' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 whitespace-no-wrap">
                        <a href="{{ url('/r/'.$pr->id) }}" target="_block" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-purple-500">
                            #{{ $pr->pr_id }}
                        </a>
                    </div>
                    <div class="pt-2 whitespace-no-wrap pr-4">
                        <a href="{{ url('/pull-request/'.$pr->id) }}">
                            <svg viewBox="0 0 24 24" width="24" height="24" class="text-gray-600 hover:text-gray-400" fill="currentColor">
                                <path d="M17.56 17.66a8 8 0 0 1-11.32 0L1.3 12.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95zm-9.9-1.42a6 6 0 0 0 8.48 0L20.38 12l-4.24-4.24a6 6 0 0 0-8.48 0L3.4 12l4.25 4.24zM11.9 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                            </svg>
                        </a>
                    </div>
                </div>
        </div>
        <div class="bg-white px-2 py-4">
            <div class="overflow-x-auto origin-center">
                @markdown($pr->content)
            </div>
        </div>
    </div>
</div>
@endsection
