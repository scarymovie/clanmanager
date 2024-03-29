<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$member"></x-clan-menu>
    </x-slot>

    @if($member->hasRole('Master'))
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400 border-2">
            <li class="w-full">
                <a href="{{ route('gvg.index', $clan) }}"
                   class="@if(request()->routeIs('gvg.index')) text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 rounded-l-lg focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:bg-gray-700 dark:text-white" aria-current="page">Все GvG</a>
            </li>
            <li class="w-full">
                <a href="{{ route('gvg.create', [$clan]) }}"
                   class="@if(request()->routeIs('gvg.create'))text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Создать GvG</a>
            </li>
        </ul>
    @else
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400 border-2">
            <li class="w-full">
                <a href="{{ route('gvg.index', $clan) }}"
                   class="@if(request()->routeIs('gvg.index')) text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 rounded-l-lg focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:bg-gray-700 dark:text-white" aria-current="page">Все Gvg</a>
            </li>
        </ul>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="position: sticky; top: 2%;"
                     class="eventFull hidden float-right min-w-[66%] max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">


                    <button type="button"
                            class="closeEventMenu float-right bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h5 class="eventFullTitle ml-8 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"></h5>

                    <p class="eventFullTime mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">
                        <br></p>

                    <label for="countries_disabled"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваш персонаж по умолчанию(основа)</label>
                    <input disabled id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                    block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $character->nickname }} {{ $character->type->title }}">
                    {{--                        <h6>Изменить можно <a href="{{ route('clan.characters.create', $clan) }}">здесь</a></h6>--}}
                </div>

                <div class="pb-5">
                    <div class="relative max-w-xs">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <label>
                            <input datepicker datepicker-format="dd.mm.yyyy" type="text"
                                   class="datepicker bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="{{ $date ?? now()->format('d.m.Y') }}">
                        </label>
                    </div>
                </div>

                @foreach($guildWars as $guildWar)
                    @if(\Carbon\Carbon::parse($guildWar->date)->format('d.m.Y H:i') < now()->format('d.m.Y H:i'))
                        <div
                            class="mb-4 test block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <div style="display: flex;">
                                <div style="display: inline">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $guildWar->title }}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">
                                        <br>{{  date('d.m.Y H:i', strtotime($guildWar->date)) }}</p>
                                </div>
                                <div style="display: inline; margin-left: auto">
                                    <button type="button" id="{{ $guildWar->id }}"
                                            class="eventUnique ml-20 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                             viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                </div>
                            </div>
                            @if (in_array($guildWar->id, $attendedGvgs))
                                <p>Вы уже отчитались о посещении этого мероприятия</p>
{{--                            @else--}}
{{--                                <div--}}
{{--                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">--}}
{{--                                    <a href="{{ route('gvg.show', [$clan, $guildWar]) }}">--}}
{{--                                        Отчитаться--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            @endif
                        </div>
                    @elseif(\Carbon\Carbon::parse($guildWar->date)->format('d.m.Y H:i') > now()->format('d.m.Y H:i'))
                        @forelse($guildWar->guildWarMemberStatuses as $status)
                            @if($status->title === 'accept')
                                <div
                                    class="mb-4 block max-w-xs p-6 bg-green-300 border border-gray-200 rounded-lg shadow-md
                                        hover:bg-green-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                                    <div style="display: flex;">
                                        <div style="display: inline">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $guildWar->title }}</h5>
                                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                                <br> {{  date('d.m.Y H:i', strtotime($guildWar->date)) }}</p>
                                        </div>
                                        <div style="display: inline; margin-left: auto">
                                            <button type="button" id="{{ $guildWar->id }}"
                                                    class="eventUnique ml-20 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-20 mb-2">
                                        <a href="{{ route('gvg.status', [$clan, $guildWar, 'status' => 'decline']) }}">
                                            Не приду
                                        </a>
                                    </div>
                                </div>
                            @elseif($status->title === 'decline')
                                <div
                                    class="mb-4 block max-w-xs p-6 bg-red-500 border border-gray-200 rounded-lg shadow-md
                                        dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                                    <div style="display: flex;">
                                        <div style="display: inline">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $guildWar->title }}</h5>
                                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                                <br> {{  date('d.m.Y H:i', strtotime($guildWar->date)) }}</p>
                                        </div>
                                        <div style="display: inline; margin-left: auto">
                                            <button type="button" id="{{ $guildWar->id }}"
                                                    class="eventUnique ml-20 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-20 mb-2">
                                        <a href="{{ route('gvg.status', [$clan, $guildWar,'status' => 'accept']) }}">
                                            Приду
                                        </a>
                                    </div>
                                </div>
                            @elseif($status->title === 'confirmed')
                                <div
                                    class="mb-4 test block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                                    <div style="display: flex;">
                                        <div style="display: inline">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $guildWar->title }}</h5>
                                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                                <br>{{  date('d.m.Y H:i', strtotime($guildWar->date)) }}</p>
                                        </div>
                                        <div style="display: inline; margin-left: auto">
                                            <button type="button" id="{{ $guildWar->id }}"
                                                    class="eventUnique ml-20 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <a href="{{ route('gvg.status', [$clan, $guildWar,'status' => 'accept']) }}">
                                            Приду
                                        </a>
                                    </div>
                                    <div
                                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <a href="{{ route('gvg.status', [$clan, $guildWar, 'status' => 'decline']) }}">
                                            Не приду
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div
                                class="mb-4 test block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                                <div style="display: flex;">
                                    <div style="display: inline">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $guildWar->title }}</h5>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">
                                            <br>{{  date('d.m.Y H:i', strtotime($guildWar->date)) }}</p>
                                    </div>
                                    <div style="display: inline; margin-left: auto">
                                        <button type="button" id="{{ $guildWar->id }}"
                                                class="eventUnique ml-20 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                 viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Icon description</span>
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    <a href="{{ route('gvg.status', [$clan, $guildWar,'status' => 'accept']) }}">
                                        Приду
                                    </a>
                                </div>
                                <div
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    <a href="{{ route('gvg.status', [$clan, $guildWar, 'status' => 'decline']) }}">
                                        Не приду
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $(document).on('click', '.eventUnique', function () {

                let gvg_id = $(this).attr('id')

                $.ajax({
                    method: "get",
                    url: "{{ route('gvg.show_details', [$clan]) }}",
                    data: {gvg: gvg_id},
                    success: function (data) {
                        console.log(data)
                        $('.eventFullTitle').text(data.title)
                        $('.eventFullTime').text(data.time)
                    }
                })
                $('.eventFull').show()
            })
            $(document).on('click', '.closeEventMenu', function () {
                $('.eventFull').hide()
            })

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
