@extends('layout')
@section('content')
<div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
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
            <tr x-data="{ contentOpen: false }">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 flex justify-between">
                    <div>
                        <div class="text-md leading-5 text-gray-900">
                            {{ $pr->title }}
                            @if($pr->isToday())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                Today
                            </span>
                            @endif
                        </div>
                        <div class="text-sm leading-5 text-gray-500">{{ $pr->pr_merged_at->format('Y-m-d H:i') }}</div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full" src="{{ $pr->author->photo ?? '#' }}" alt="{{ $pr->author->name ?? '-' }}" />
                        </div>
                        <div class="ml-4">
                            <div class="text-sm leading-5 font-medium text-gray-600">{{ $pr->author->name ?? '-' }}</div>
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
</div>
</div>
@endsection