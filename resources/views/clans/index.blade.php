<x-app-layout>
    <x-slot name="header">
        <div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Найти клан
                </h2>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <a href="{{ route('clan.create') }}">Создать клан</a>
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Найти клан
                            </h2>
                        </header>
                        <ul>
                            @foreach($clans as $clan)
                            <li>
                                {{ $clan->title }}
                            </li>
                            @endforeach
                        </ul>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
