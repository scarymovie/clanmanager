<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('members', $clan) }}"
       @if(request()->routeIs('members', 'members.*'))
           class="border-b-2 border-indigo-500"
        @endif>
        Мемберы
    </a>
    <a href="{{ route('events', $clan) }}"
       @if(request()->routeIs(['event', 'events']))
           class="border-b-2 border-indigo-500"
        @endif>Ивенты</a>
    <a href="{{ route('clan.characters.index', $clan) }}">Мои персонажи</a>
    <a href="">Управление</a>
    <a href="">Активность</a>
    <a href="">Отписи</a>
    <a href="">Офицерка</a>
</h2>
