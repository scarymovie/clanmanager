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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="invite_link">
                        <label class="block font-medium text-sm text-gray-700" for="nickname">
                            Ссылка
                        </label>
                        <input disabled
                               class="border-gray-300 mr-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                               type="text" value="{{ $clan->invite_link }}"
                               autofocus="autofocus">
                        <div class="mt-2">
                            <button id="copy-button" class="bg-blue-500 mr-2 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Скопировать</button>
                            <a href="{{ route('refresh_invite_link', $clan) }}" id="copy-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Обновить</a>
                        </div>
                        <div id="content" data-clipboard-text="{{ route('invited_user', [$clan, $clan->invite_link]) }}"></div>
                    </section>
                </div>
            </div>
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
                                    <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('candidate.status', [$clan, $member, 'decision' => 'accept']) }}" class="w-12 h-12 flex items-center justify-center rounded-full bg-green-500 hover:bg-green-600 focus:bg-green-600 focus:outline-none margin-0">
                                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 20 20">
                                            <path d="M18.293 3.293a1 1 0 00-1.414 0L7 13.586l-3.293-3.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l11-11a1 1 0 000-1.414z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('candidate.status', [$clan, $member, 'decision' => 'decline']) }}" class="w-12 h-12 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 focus:bg-red-600 focus:outline-none margin-0">
                                        <svg class="w-full h-full fill-current" viewBox="0 0 24 24">
                                            <path d="M18.364 5.636a.999.999 0 0 0-1.414 0L12 10.586 7.05 5.636a.999.999 0 1 0-1.414 1.414L10.586 12l-4.95 4.95a.999.999 0 1 0 1.414 1.414L12 13.414l4.95 4.95a.999.999 0 1 0 1.414-1.414L13.414 12l4.95-4.95a.999.999 0 0 0 0-1.414z"/>
                                        </svg>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function () {
            const copyButton = document.getElementById('copy-button');
            const content = document.getElementById('content');
            const clipboard = new ClipboardJS(copyButton, {
                text: function () {
                    return content.getAttribute('data-clipboard-text');
                }
            });

        })
    </script>

</x-app-layout>
