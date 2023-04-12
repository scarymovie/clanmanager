<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$auth_member"></x-clan-menu>
    </x-slot>

    @if($auth_member->hasRole('Master'))
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400 border-2">
            <li class="w-full">
                <a href="{{ route('members.index', $clan) }}"
                   class="@if(request()->routeIs('members.index')) text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 rounded-l-lg focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:bg-gray-700 dark:text-white" aria-current="page">Все мемберы</a>
            </li>
            <li class="w-full">
                <a href="{{ route('members.create', [$clan, $auth_member]) }}"
                   class="@if(request()->routeIs('members.create'))text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Заявки в клан</a>
            </li>
        </ul>
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-2 py-4">
                                Номер
                            </th>
                            <th scope="col" class="px-12 py-4">
                                Ник
                            </th>
                            <th scope="col" class="px-12 py-4">
                                Звание
                            </th>
                            @if($auth_member->hasRole('Master'))
                                <th scope="col" class="px-12 py-4">

                                </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>
                                <th scope="row"
                                    class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $member->characters->first()->nickname }}
                                </th>
                                <td class="px-12 py-4">
                                    {{ $member->rank }}
                                </td>
                                <td class="px-12 py-4">
                                @if($auth_member->hasRole('Master') && $auth_member->id !== $member->id)
                                    <form action="{{ route('members.delete', [$clan, $member]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="mt-1 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            Кикнуть
                                        </button>
                                    </form>
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
