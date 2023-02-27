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
