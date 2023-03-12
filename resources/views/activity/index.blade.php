<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan"></x-clan-menu>
    </x-slot>
    <div class="py-12">
        <div class="max-w-max mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="relative overflow-x-auto">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Ник
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Явка
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ивенты
                                </th>
                                @foreach($eventsList as $event)
                                    <th scope="col" class="px-6 py-3">
                                        {{ $event->title }}
                                    </th>
                                @endforeach
                                <th scope="col" class="px-6 py-3">
                                    Сумма баллов
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                @foreach($members as $member)
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @foreach($member->characters as $character)
                                            @if($character->status === 'main')
                                                <strong>{{ $character->nickname }}<br></strong>
                                            @endif
                                        @endforeach
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $activity_percent }}%
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $events_all }}
                                    </td>
                                    @foreach($eventsList as $event)
                                        @if($event->status != null && $event->status->status === 'confirmed')
                                            <td class="px-6 py-4 text-green-600">
                                                1
                                            </td>
                                        @else
                                            <td class="px-6 py-4 text-red-600">
                                                0
                                            </td>
                                        @endif
                                    @endforeach
                                    <td class="px-6 py-4 text-black-600">
                                        <strong><b>{{ $countOfConfirmedEvents }}</b></strong>
                                    </td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
