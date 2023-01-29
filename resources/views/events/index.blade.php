<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan"></x-clan-menu>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div
                    class="eventFull hidden float-right min-w-[66%] max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">


                    <button type="button"
                            class="closeEventMenu float-right bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <h5 class="eventFullTitle ml-8 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"></h5>

                    <p class="eventFullTime mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">
                        <br></p>


                    <label for="countries_disabled"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите персонажа</label>
                    <select id="countries_disabled"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>

                    <label for="countries_disabled"
                           class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите пла</label>
                    <select id="countries_disabled"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>

                </div>
                @foreach($events as $event)
                    @if($event->status === null)
                        <div
                            class="mb-4 test block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <div style="display: flex;">
                                <div style="display: inline">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $event->weekday }}
                                        <br> {{ $event->time }}</p>
                                </div>
                                <div style="display: inline; margin-left: auto">
                                    <button type="button" id="{{ $event->id }}"
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
                                <a href="{{ route('event.status', ['event' => $event, 'status' => 'accept', 'clan' => $clan]) }}">
                                    Приду
                                </a>
                            </div>
                            <div
                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                <a href="{{ route('event.status', ['event' => $event, 'status' => 'decline', 'clan' => $clan]) }}">
                                    Не приду
                                </a>
                            </div>
                        </div>

                    @elseif($event->status === 'decline')
                        <div
                            class="mb-4 block max-w-xs p-6 bg-red-500 border border-gray-200 rounded-lg shadow-md
                                        dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <div style="display: flex;">
                                <div style="display: inline">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $event->weekday }}
                                        <br> {{ $event->time }}</p>
                                </div>
                                <div style="display: inline; margin-left: auto">
                                    <button type="button" id="{{ $event->id }}"
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
                                <a href="{{ route('event.status', ['event' => $event, 'status' => 'accept', 'clan' => $clan]) }}">
                                    Приду
                                </a>
                            </div>
                        </div>
                    @elseif($event->status === 'accept')
                        <div
                            class="mb-4 block max-w-xs p-6 bg-green-300 border border-gray-200 rounded-lg shadow-md
                                        hover:bg-green-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <div style="display: flex;">
                                <div style="display: inline">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $event->weekday }}
                                        <br> {{ $event->time }}</p>
                                </div>
                                <div style="display: inline; margin-left: auto">
                                    <button type="button" id="{{ $event->id }}"
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
                                <a href="{{ route('event.status', ['event' => $event, 'status' => 'decline', 'clan' => $clan]) }}">
                                    Не приду
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $(document).on('click', '.eventUnique', function () {

                let event_id = $(this).attr('id')

                $.ajax({
                    method: "get",
                    url: "{{ route('events.show', ['clan' => $clan]) }}",
                    data: {event: event_id},
                    success: function (data) {
                        console.log(data)
                        $('.eventFullTitle').text(data.title)
                        $('.eventFullTime').text(data.weekday + ' ' + data.time)
                    }
                })
                $('.eventFull').show()
            })
            $(document).on('click', '.closeEventMenu', function () {
                $('.eventFull').hide()
            })
        })
    </script>
</x-app-layout>
