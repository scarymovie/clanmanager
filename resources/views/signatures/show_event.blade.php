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
            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{ $event->title }}
                </h1>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Номер
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ник
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Профа
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Статус
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Изменить статус
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            @if(isset($member->eventMemberStatuses->first()->status) && $member->eventMemberStatuses->first()->status === 'accept')
                                <tr class="border-b dark:bg-gray-900 dark:border-gray-700 bg-green-300" style="background-color: #75E175">
                            @elseif(isset($member->eventMemberStatuses->first()->status) && $member->eventMemberStatuses->first()->status === 'decline')
                                <tr class="border-b dark:bg-gray-900 dark:border-gray-700 bg-red-300" style="background-color: #FB6767">
                            @elseif(isset($member->eventMemberStatuses->first()->status) && $member->eventMemberStatuses->first()->status === 'confirmed')
                                <tr class="bg-black border-b dark:bg-gray-900 dark:border-gray-700" style="background-color: #3EDB3E">
                            @else
                                <tr class="border-b dark:bg-gray-900 dark:border-gray-700">
                                    @endif
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $member->characters->first()->nickname }}
                                    </th>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $member->characters->first()->type->title }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ isset($member->eventMemberStatuses->first()->status) ? $member->eventMemberStatuses->first()->status : 'Нет информации' }}
                                    </td>
                                    <td>
                                        @if(isset($member->eventMemberStatuses->first()->status) && $member->eventMemberStatuses->first()->status === 'confirmed')
                                            <a href="{{ route('events.masterUpdate', [$clan, $event, $member, 'status' => 'rejected']) }}"
                                               class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                                                focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg
                                                text-sm px-5 py-2.5 text-center mr-2 mb-2">Отклонить</a>
                                        @else
                                            <a href="{{ route('events.masterUpdate', [$clan, $event, $member, 'status' => 'confirmed']) }}"
                                               class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                                                focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg
                                                text-sm px-5 py-2.5 text-center mr-2 mb-2">Подтвердить</a>
                                            <a href="{{ route('events.masterUpdate', [$clan, $event, $member, 'status' => 'rejected']) }}"
                                               class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                                                focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg
                                                text-sm px-5 py-2.5 text-center mr-2 mb-2">Отклонить</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

</x-app-layout>
