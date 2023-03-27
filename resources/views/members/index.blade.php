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
                                Звание
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
                                    {{ $member->characters->first()->nickname }}
                                </th>
                                <td class="px-12 py-4">
                                    {{ $member->rank }}
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
