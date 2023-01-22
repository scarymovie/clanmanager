<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan"></x-clan-menu>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @foreach($events as $event)

                    @if($event->status === null)
                        <div
                            class="mb-4 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $event->weekday }} {{ $event->time }}</p>
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
                            class="mb-4 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                        hover:bg-red-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $event->weekday }} {{ $event->time }}</p>
                            <div
                                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                <a href="{{ route('event.status', ['event' => $event, 'status' => 'accept', 'clan' => $clan]) }}">
                                    Приду
                                </a>
                            </div>
                        </div>
                    @elseif($event->status === 'accept')
                        <div
                            class="mb-4 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md
                                        hover:bg-green-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 event">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $event->weekday }} {{ $event->time }}</p>
                            <div
                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
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
            $(document).on('click', '.event', function ($e) {
                //
            })
        })
    </script>
</x-app-layout>
