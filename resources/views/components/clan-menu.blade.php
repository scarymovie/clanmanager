<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('members', request()->clan) }}"
       @if(request()->routeIs('members', 'members.*'))
           class="border-b-2 border-indigo-500"
        @endif>
        Мемберы
    </a>
    <a href="">Управление</a>
    <a href="">Ивенты</a>
    <a href="">Активность</a>
    <a href="">Отписи</a>
    <a href="">Офицерка</a>
</h2>
