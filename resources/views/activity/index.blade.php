<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$auth_member"></x-clan-menu>
    </x-slot>
    <div class="py-12">
        <div class="max-w-max mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form action="{{ route('activity.index', $clan) }}" method="get">
                    <div date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                        </div>
                        <button type="submit" class="text-white ml-2 mt-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Подтвердить</button>
                    </div>

                </form>

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
                                @foreach ($eventStatistics as $eventName => $eventAttendances)
                                    <th>{{ $eventName }}</th>
                                @endforeach
                                @foreach($gvgList as $gvg)
                                    <th scope="col" class="px-6 py-3">
                                        {{ $gvg->title }}
                                    </th>
                                @endforeach
                                <th scope="col" class="px-6 py-3">
                                    Сумма баллов
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    @if(!$member->hasRole('Candidate'))
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <strong>{{ $member->characters->first()->nickname }}</strong>
                                        </th>
                                        <td class="px-6 py-4">
{{--                                            {{ $activity_percent }}%--}}
                                        </td>
                                        @foreach($eventStatistics as $eventAttendances)
{{--                                            @php--}}
{{--                                                $eventPoints = 0;--}}
{{--                                                if (isset($eventAttendances[$member->id])) {--}}
{{--                                                    $eventPoints = $eventAttendances[$member->characters->first()->id]['status'] === 'confirmed' ? $eventAttendances[$member->characters->first()->id]['points'] : 0;--}}
{{--                                                }--}}
{{--                                            @endphp--}}
                                            <td class="px-6 py-4 text-green-600">
                                                {{ $eventAttendances[$member->characters->first()->id]['count'] ?? 0 }}
                                            </td>
                                        @endforeach
                                        @foreach($gvgList as $gvg)
                                            @if($gvg->status != null && $gvg->status->title === 'confirmed')
                                                <td class="px-6 py-4 text-green-600">
                                                    {{ $gvg->points }}
                                                </td>
                                            @else
                                                <td class="px-6 py-4 text-red-600">
                                                    0
                                                </td>
                                            @endif
                                        @endforeach
                                        <td class="px-6 py-4 text-black-600">
{{--                                            <strong><b>{{ $pointsOfConfirmedEvents }}</b></strong>--}}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
