<x-app-layout>
    <x-slot name="header">
        <div>
{{--            <div>--}}
{{--                <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--                    Найти клан--}}
{{--                </h2>--}}
{{--            </div>--}}
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <a href="{{ route('clans.create') }}">Создать клан</a>
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-xl">
                            Добро пожаловать на сайт менеджера клана для игры Perfect World!
                            Наш сайт предоставляет вам возможность управлять вашим кланом с легкостью и эффективностью.
                            Вы можете создавать расписание ивентов, отслеживать статистику посещения и создавать статьи для вашего клана.
                            Мы работаем над тем, чтобы наш сайт был максимально простым и удобным для использования,
                            так что вы можете наслаждаться игрой и общением с другими членами вашего клана.
                        </div>
                    </div>
{{--                    <section>--}}
{{--                        <header>--}}
{{--                            <h2 class="text-lg font-medium text-gray-900">--}}
{{--                                Найти клан--}}
{{--                            </h2>--}}
{{--                        </header>--}}
{{--                        <ul>--}}
{{--                            @foreach($clans as $clan)--}}
{{--                            <li>--}}
{{--                                {{ $clan->title }}--}}
{{--                            </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}

{{--                    </section>--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
