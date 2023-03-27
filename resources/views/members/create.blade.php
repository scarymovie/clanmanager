<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$auth_member"></x-clan-menu>
    </x-slot>

    @if($auth_member->hasRole('Master'))
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
            <li class="w-full">
                <a href="{{ route('members', $clan) }}"
                   class="@if(request()->routeIs('members')) text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 rounded-l-lg focus:ring-4 focus:ring-blue-300 focus:outline-none
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
                        <div id="content" data-clipboard-text="{{ route('invited_user', [$clan->invite_link]) }}"></div>
                    </section>
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
