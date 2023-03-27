<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$member"></x-clan-menu>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(!$clan->members()->where('rank', 'Мастер')->exists())
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Ваши данные
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Ник мастера
                                </p>
                            </header>

                            <form method="post" action="{{ route('master.create', $clan) }}" class="mt-6 space-y-6">
                                @csrf
                                <div>
                                    <label class="block font-medium text-sm text-gray-700" for="nickname">
                                        Ник
                                    </label>
                                    <input
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                        id="nickname" name="nickname" type="text" required="required"
                                        autofocus="autofocus" autocomplete="nickname">
                                </div>
                                <div class="flex items-center gap-4">
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Создать
                                    </button>
                                </div>
                            </form>
                        </section>
                    @else
                        Мастер уже есть
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
