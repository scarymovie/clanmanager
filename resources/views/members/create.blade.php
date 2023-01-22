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
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Добавить мембера
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                            Пригласительная ссылка
                        </h2>
                    </header>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('members.store', $clan) }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="nickname">
                                    Ник
                                </label>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    id="nickname" name="nickname" type="text" required="required"
                                    autofocus="autofocus" autocomplete="nickname">
                                <label class="block font-medium text-sm text-gray-700" for="rank">
                                    Звание
                                </label>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    id="rank" name="rank" type="text" required="required"
                                    autofocus="autofocus" autocomplete="rank">
                                <label class="block font-medium text-sm text-gray-700" for="user_name">
                                    Найти зарегистрированного пользователя
                                </label>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    id="user_name" name="user_name" type="text"
                                    autofocus="autofocus" autocomplete="user_name">
                                <input type="hidden" id="user_id" name="user_id">
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Создать
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){

            $(document).on('click', '#user_name', function () {
                $('#user_name').autocomplete({
                    source: function (request, response) {
                        jQuery.get("/getusers", {
                            query: request.term
                        }, function (data) {
                            response(data);
                            $('#user_id').val(data[0].id)
                            $('#user_name').val(data[0].name)
                        });
                    },
                    minLength: 2
                });
                $('.ui-helper-hidden-accessible').remove()
            })
        })
    </script>

</x-app-layout>
