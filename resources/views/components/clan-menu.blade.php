<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('members.index', $clan) }}"
       @if(request()->routeIs('members', 'members.*'))
           class="border-b-2 border-indigo-500"
        @endif>
        Мемберы
    </a>

{{--    <a href="{{ route('events', $clan) }}"--}}
{{--       @if(request()->routeIs(['event.*', 'events', 'events.*']))--}}
{{--           class="border-b-2 border-indigo-500"--}}
{{--        @endif>Ивенты--}}
{{--    </a>--}}
{{--    <a href="{{ route('clan.gvg.index', $clan) }}"--}}
{{--       @if(request()->routeIs(['clan.gvg.*']))--}}
{{--           class="border-b-2 border-indigo-500"--}}
{{--        @endif>GvG--}}
{{--    </a>--}}
{{--    <a href="{{ route('clan.characters.index', $clan) }}"--}}
{{--        @if(request()->routeIs(['clan.characters.*']))--}}
{{--        class="border-b-2 border-indigo-500"--}}
{{--        @endif>Мои персонажи--}}
{{--    </a>--}}
{{--    <a href="{{ route('clan.activity.index', $clan) }}"--}}
{{--       @if(request()->routeIs(['clan.activity.*']))--}}
{{--        class="border-b-2 border-indigo-500"--}}
{{--        @endif>Активность</a>--}}

{{--    @if($member->hasRole('Master'))--}}
{{--        <a href="">Управление</a>--}}
{{--    @endif--}}
</h2>
