<x-app-layout>
    <x-slot name="header">
        <x-clan-menu></x-clan-menu>
    </x-slot>
    <div class="bg-white shadow mt-0.5">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('members', request()->clan) }}">Добавить мембера</a>
                <a href="{{ route('members', request()->clan) }}">Все мемберы</a>
            </h2>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="grid grid-cols-4 gap-4">
                        <div>01</div>
                        <!-- ... -->
                        <div>09</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
