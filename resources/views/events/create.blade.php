<x-app-layout>
    <x-slot name="header">
        <x-clan-menu :clan="$clan" :member="$member"></x-clan-menu>
    </x-slot>

    @if($member->hasRole('Master'))
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400 border-2">
            <li class="w-full">
                <a href="{{ route('events.index', $clan) }}"
                   class="@if(request()->routeIs('events.index')) text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 rounded-l-lg focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:bg-gray-700 dark:text-white" aria-current="page">Все ивенты</a>
            </li>
            <li class="w-full">
                <a href="{{ route('events.create', [$clan]) }}"
                   class="@if(request()->routeIs('events.create'))text-gray-900 bg-gray-100 @else bg-white @endif inline-block w-full p-4 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none
                   dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Создать ивент</a>
            </li>
        </ul>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <h5 class="eventFullTitle ml-8 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Создать новый ивент</h5>
                <h4 class="text-center text-red-600">Пожалуйста, создавайте ивенты на текущей неделе или прошлых, если создать на будущие, то багается. пофиксю потом</h4>
                <form action="{{ route('events.store', $clan) }}" method="post">
                    @csrf
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                        <input id="title"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                               name="title" type="text" autofocus="autofocus">
                    </div>
                    <div>
                        <label for="date-time-picker" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата</label>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               id="date-time-picker" type="text" placeholder="Выберите дату и время" name="date">
                    </div>
                    <div>
                        <label for="points" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Количество баллов за посещение</label>
                        <input id="points"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                               name="points" type="number" autofocus="autofocus" value="1">
                    </div>
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        flatpickr('#date-time-picker', {
            enableTime: true,
            time_24hr: true,
            dateFormat: 'd.m.Y H:i',
            locale: 'ru'
        });
    </script>
</x-app-layout>
