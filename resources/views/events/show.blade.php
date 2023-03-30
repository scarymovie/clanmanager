<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$member"></x-clan-menu>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <h5 class="eventFullTitle ml-8 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $event->title }}</h5>

                <p class="eventFullTime mb-3 font-normal text-gray-700 dark:text-gray-400 text-center">{{ $event->week_day }}
                    <br>{{ date('H:i', strtotime($event->start_date)) }}</p>

                <form action="{{ route('events.status', [$clan, $event, $difference]) }}">
                    <div>
                        <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Персонаж</label>
                        <select id="types" name="character_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($characters as $character)
                                <option value="{{ $character->id }}">{{ $character->nickname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ПЛ</label>
                        <select id="types" name="party_leader_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            {{--                        @foreach($characters as $character)--}}
                            <option value="id">ПЛЫ</option>
                            {{--                        @endforeach--}}
                        </select>
                    </div>
                    <div>
                        <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Скрин</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Комментарий</label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" name="note" type="text" autofocus="autofocus">
                    </div>
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
