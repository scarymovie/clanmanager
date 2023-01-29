<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan"></x-clan-menu>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @foreach($events as $event)
                    @if($event->status === null)
                        <div data-event="{{ $event->id }}"
                             class="eventFull hidden float-right min-w-[66%] max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $event->title }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">{{ $event->weekday }}
                                <br>{{ $event->time }}</p>
                        </div>
                        <div
                            class="mb-4 block max-w-xs p-6 bg-white border border-gray-200 rounded-lg shadow-md
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
                        <div data-event="{{ $event->id }}"
                             class="eventFull hidden float-right min-w-[66%] max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $event->title }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">{{ $event->weekday }}
                                <br>{{ $event->time }}</p>
                        </div>
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
                        <div data-event="{{ $event->id }}"
                             class="eventFull hidden float-right min-w-[66%] max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $event->title }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">{{ $event->weekday }}
                                <br>{{ $event->time }}</p>
                        </div>
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
                console.log('asd')

                let event_id = $(this).attr('id')
                $('.eventFull[data-event='+event_id+']').toggle()
            })
        })
    </script>
</x-app-layout>
