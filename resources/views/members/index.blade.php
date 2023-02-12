<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan"></x-clan-menu>
    </x-slot>
    <div class="bg-white shadow mt-0.5">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('members', $clan) }}">Все мемберы</a>
                <a href="{{ route('members.create', $clan) }}">Добавить мембера</a>
            </h2>
        </div>
    </div>

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
                            <th scope="col" class="px-12 py-4">

                            </th>
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
                                    {{ $member->nickname }}
                                </th>
                                <td class="px-12 py-4">
                                    {{ $member->rank }}
                                </td>
                                <td>
                                    @if($member->rank === 'Мастер')
                                        Изменить
                                    @else
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
