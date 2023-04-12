<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$auth_member"></x-clan-menu>
    </x-slot>

    @if($auth_member->hasRole('Master'))
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400 border-2">
            <li class="w-full">
                <a href="{{ route('signatures.index', $clan) }}"
                   class="@if(request()->routeIs('signatures.index')) text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 rounded-l-lg focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:bg-gray-700 dark:text-white" aria-current="page">GvG</a>
            </li>
            <li class="w-full">
                <a href="{{ route('signaturesEvents.index', [$clan]) }}"
                   class="@if(request()->routeIs('signaturesEvents.index'))text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Ивенты</a>
            </li>
        </ul>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form action="{{ route('signatures.index', $clan) }}" method="get">
                    <div date-rangepicker datepicker-format="dd.mm.yyyy" class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input name="start" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="{{ $start ?? now()->startOfMonth()->format('d.m.Y') }}">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input name="end" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="{{ $end ?? now()->endOfMonth()->format('d.m.Y') }}">
                        </div>
                        <button type="submit" class="text-white ml-2 mt-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Подтвердить</button>
                    </div>

                </form>
                <div class="flex flex-wrap -mx-4">
                @foreach($gvgList as $gvg)
                    <div class="w-1/2 px-4 mb-8">
                        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
                            <a href="{{ route('signatures.show', [$clan, $gvg]) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $gvg->title }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Отписей - {{ $gvg->guildWarMemberStatuses->count() }}</p>
                            <a href="{{ route('signatures.show', [$clan, $gvg]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Перейти
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

        <script>
            $(document).ready(function () {
                $(document).on('click', '.datepicker', function () {
                    let date = $('.datepicker').val()
                    if (date !== '') {
                        let queryString = '?date=' + date
                        window.location = window.location.pathname + queryString;
                    }
                })
            })
        </script>
</x-app-layout>
