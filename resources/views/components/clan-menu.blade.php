<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('members.index', $clan) }}"
                       @if(request()->routeIs('members.*'))
                           class="border-b-2 border-indigo-500"
                        @endif>
                        Мемберы
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.index', $clan) }}"
                       @if(request()->routeIs(['events.*']))
                           class="border-b-2 border-indigo-500"
                        @endif>Ивенты
                    </a>
                </li>
                <li>
                    <a href="{{ route('gvg.index', $clan) }}"
                       @if(request()->routeIs(['gvg.*']))
                           class="border-b-2 border-indigo-500"
                        @endif>GvG
                    </a>
                </li>
                <li>
                        <a href="{{ route('characters.index', $clan) }}"
                            @if(request()->routeIs(['characters.*']))
                            class="border-b-2 border-indigo-500"
                            @endif>Мои персонажи
                        </a>
                </li>
                <li>
                    {{--    <a href="{{ route('clan.activity.index', $clan) }}"--}}
                    {{--       @if(request()->routeIs(['clan.activity.*']))--}}
                    {{--        class="border-b-2 border-indigo-500"--}}
                    {{--        @endif>Активность</a>--}}
                </li>
            </ul>
        </div>
    </div>
</nav>

