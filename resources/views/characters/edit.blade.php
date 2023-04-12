<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$member"></x-clan-menu>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('characters.update', [$clan, $character, $member]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-6 mb-6 md:grid-cols-2">

                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ник</label>
                                <input type="text" id="first_name" name="nickname" value="{{ $character->nickname }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                       focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div>
                                <label for="default-radio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Статус</label>
                                <div class="flex items-center mb-4">
                                    <input @checked($character->status === 'main') id="default-radio-1" type="radio" value="main" name="status"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                           dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Основа</label>
                                </div>
                                <div class="flex items-center">
                                    <input @checked($character->status === 'twin') id="default-radio-2" type="radio" value="twin" name="status"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                           dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Твин</label>
                                </div>
                            </div>
                            <div>
                                <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Профа</label>
                                <select id="types" name="character_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($characters_type as $character_type)
                                        <option @selected($character->type->id == $character_type->id) value="{{ $character_type->id }}">{{ $character_type->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ссылка на куклу</label>
                                <input type="text" id="link" name="link" value="{{ $character->link }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                       focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Добавить персонажа</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
