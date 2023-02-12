<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan"></x-clan-menu>
    </x-slot>
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
                                Статус
                            </th>
                            <th scope="col" class="px-12 py-4">
                                Профа
                            </th>
                            <th class="unset">
                                <a href="{{ route('clan.characters.create', $clan) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Добавить
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($characters as $character)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>
                                <td
                                    class="px-12 py-4">
                                    {{ $character->nickname }}
                                </td>
                                <td class="px-12 py-4">
                                    {{ $character->status }}
                                </td>
                                <td class="px-12 py-4">
                                    {{ $character->type->title }}
                                </td>
                                <td class="pt-2" style="display: flex">
                                    <a href="{{ route('clan.characters.edit', [$clan, 'character' => $character->id]) }}"
                                            class="mr-2 text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4
                                            focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2
                                            dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Изменить</a>
                                        <form action="{{ route('character.delete', [$clan, $character->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium
                                        rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                Удалить
                                            </button>
                                        </form>
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
