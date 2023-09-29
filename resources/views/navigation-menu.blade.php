<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('st.index') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @can('student.home')
                        <x-jet-nav-link href="{{ route('st.index') }}" :active="request()->routeIs('st.index')">
                            {{ __('Inicio') }}
                        </x-jet-nav-link>
                    @endcan
                    @if (auth()->user()->personale->inscripciones->where('estado', '1')->whereIn('programa_id', session('programa_activo'))->count() ||
                            auth()->user()->can('admin.programas.viewList'))

                        <div class="inline-flex items-center px-1 pt-1">
                            <x-jet-dropdown>
                                <x-slot name="trigger">
                                    <button
                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Mi familia</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <!-- User Management -->
                                    @foreach (Auth::user()->personale->inscripciones as $inscripcione)
                                        @if ($inscripcione->programa->pfj->estado == 1)
                                            <div class="p-2"> {{ $inscripcione->programa->nombre }}</div>
                                            @can('admin.programas.grupos')
                                                {{-- Si puede 'Ver los grupos de su sesión' --}}
                                                @foreach ($inscripcione->programa->grupos as $grupo)
                                                    <x-jet-dropdown-link href="{{ route('st.grupos.show', $grupo) }}">
                                                        {{ 'Familia ' . $grupo->numero . ' ' . $grupo->nombre }}
                                                    </x-jet-dropdown-link>
                                                @endforeach
                                            @else
                                                @if ($inscripcione->programa->mostrarGrupos == 1)
                                                    @if (isset($inscripcione->inscripcioneCompanerismo->companerismo))
                                                        @php
                                                            $grupo = $inscripcione->inscripcioneCompanerismo->companerismo->grupo;
                                                        @endphp
                                                        <x-jet-dropdown-link href="{{ route('st.grupos.show', $grupo) }}">
                                                            {{ 'Familia ' . $grupo->numero . ' ' . $grupo->nombre }}
                                                        </x-jet-dropdown-link>
                                                    @endif
                                                @else
                                                    <div class="p-2">
                                                        {{ 'Se están realizando cambios' }}
                                                    </div>
                                                @endif
                                            @endcan
                                        @endif
                                    @endforeach
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                        <div class="inline-flex items-center px-1 pt-1">
                            <x-jet-dropdown>
                                <x-slot name="trigger">
                                    <button
                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Manual PFJ</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-jet-dropdown-link href="{{ config('app.url') . '/img/PFJManualStaff2022.pdf' }}"
                                        target="_blank">
                                        {{ __('Manual para el personal') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link
                                        href="{{ config('app.url') . '/img/PFJManualParticipante2022.pdf' }}"
                                        target="_blank">
                                        {{ __('Manual para el participante') }}
                                    </x-jet-dropdown-link>
                                </x-slot>

                            </x-jet-dropdown>
                        </div>
                        @if (auth()->user()->personale->inscripciones->where('estado', '1')->whereIn('programa_id', session('programa_activo'))->first()->programa->estado == 1)
                            <div class="inline-flex items-center px-1 pt-1">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>
                                                {{ 'Inscripciones' }}
                                            </div>
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        @foreach (Auth::user()->personale->inscripciones as $inscripcione)
                                            @if ($inscripcione->programa->pfj->estado == 1)
                                                <x-jet-dropdown-link
                                                    href="{{ route('st.programas.inscripciones', $inscripcione->programa) }}">
                                                    {{ $inscripcione->programa->nombre }}
                                                </x-jet-dropdown-link>
                                            @endif
                                        @endforeach
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @endif

                        @can('admin.home')
                            <x-jet-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                                {{ __('Panel administrativo') }}
                            </x-jet-nav-link>
                        @endcan
                        @php
                            $hasCompania = false;
                            $countCompanias = 0;
                            $companerismo = null;
                            foreach (auth()->user()->personale->inscripciones as $inscripcione) {
                                if ($inscripcione->programa->pfj->estado == 1 &&  isset($inscripcione->inscripcioneCompanerismo)) {
                                    $hasCompania = true;
                                    $countCompanias++;
                                    $companerismo = $inscripcione->inscripcioneCompanerismo->companerismo;
                                    // break;
                                }
                            }
                        @endphp
                        @if ($hasCompania)
                            <x-jet-nav-link href="{{ route('st.participante.compania', $companerismo) }}"
                                :active="request()->routeIs('st.participante.compania')">
                                {{ __('Mi compañia') }}
                            </x-jet-nav-link>
                        @endif
                        @can('admin.programas.viewList')
                            <div class="inline-flex items-center px-1 pt-1">
                                <x-jet-dropdown>
                                    <x-slot name="trigger">
                                        <button
                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            <div>Ver como:</div>
                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        {{-- @forelse (\App\Models\Inscripcione::where('programa_id', session('programa_activo'))->get() as $inscripcione)
                                            @php
                                                //$inscripcione = \App\Models\Inscripcione::where('programa_id', $programa->id)->first();
                                            @endphp
                                            <x-jet-dropdown-link href="{{ '#' }}" target="_blank">
                                                @if ($inscripcione->personale->user)
                                                {{ $inscripcione->personale->user->name }}
                                                @endif
                                            </x-jet-dropdown-link>
                                        @empty
                                        @endforelse --}}
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @endcan
                    @endif

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Administrar cuenta') }}
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="border-t border-gray-100"></div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @can('student.home')
                <x-jet-responsive-nav-link href="{{ route('st.index') }}" :active="request()->routeIs('st.index')">
                    {{ __('Inicio') }}
                </x-jet-responsive-nav-link>
            @endcan
            @php
                $hasCompania = false;
                $countCompanias = 0;
                $companerismo = null;
                foreach (auth()->user()->personale->inscripciones as $inscripcione) {
                    if ($inscripcione->programa->pfj->estado == 1 &&  isset($inscripcione->inscripcioneCompanerismo)) {
                        $hasCompania = true;
                        $countCompanias++;
                        $companerismo = $inscripcione->inscripcioneCompanerismo->companerismo;
                        // break;
                    }
                }
            @endphp
            @if ($hasCompania)
                <x-jet-nav-link href="{{ route('st.participante.compania', $companerismo) }}" :active="request()->routeIs('st.participante.compania')">
                    {{ __('Mi compañia') }}
                </x-jet-nav-link>
            @endif
            @if (auth()->user()->personale->inscripciones->where('estado', '1')->whereIn('programa_id', session('programa_activo'))->count() ||
                    auth()->user()->can('admin.programas.viewList'))
                <!-- Account Management -->
                <x-jet-dropdown>
                    <x-slot name="trigger">

                        <button
                            class="flex items-center block pl-3 pr-4 py-2 w-full  text-base text-sm font-medium focus:bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 border-l-4 transition duration-150 ease-in-out ">
                            {{-- block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base  hover:text-gray-700 hover:border-grayborder-l-4 border-indigo-400  text-indigo-700 bg-indigo-50 active:border-indigo-400  active:text-indigo-700 active:bg-indigo-50 active:border-l-4 --}}
                            <div>Mi familia</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                    </x-slot>

                    <x-slot name="content">
                        @foreach (Auth::user()->personale->inscripciones as $inscripcione)
                            @if ($inscripcione->programa->pfj->estado == 1)
                                <div class="p-2"> {{ $inscripcione->programa->nombre }}</div>
                                @can('admin.programas.grupos')
                                    {{-- Si puede 'Ver los grupos de su sesión' --}}
                                    @foreach ($inscripcione->programa->grupos as $grupo)
                                        <x-jet-dropdown-link href="{{ route('st.grupos.show', $grupo) }}">
                                            {{ 'Familia ' . $grupo->numero . ' ' . $grupo->nombre }}
                                        </x-jet-dropdown-link>
                                    @endforeach
                                @else
                                    @if (isset($inscripcione->inscripcioneCompanerismo->companerismo))
                                        @php
                                            $grupo = $inscripcione->inscripcioneCompanerismo->companerismo->grupo;
                                        @endphp
                                        <x-jet-dropdown-link href="{{ route('st.grupos.show', $grupo) }}">
                                            {{ 'Familia ' . $grupo->numero . ' ' . $grupo->nombre }}
                                        </x-jet-dropdown-link>
                                    @endif
                                @endcan
                            @endif
                        @endforeach
                    </x-slot>

                </x-jet-dropdown>
                {{-- Manual --}}
                <x-jet-dropdown>
                    <x-slot name="trigger">
                        <button
                            class="flex items-center block pl-3 pr-4 py-2 w-full  text-base text-sm font-medium focus:bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 border-l-4 transition duration-150 ease-in-out ">
                            {{-- block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base  hover:text-gray-700 hover:border-grayborder-l-4 border-indigo-400  text-indigo-700 bg-indigo-50 active:border-indigo-400  active:text-indigo-700 active:bg-indigo-50 active:border-l-4 --}}
                            <div>Manual PFJ </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ config('app.url') . '/img/PFJManualStaff2022.pdf' }}"
                            target="_blank">
                            {{ __('Manual para el personal') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ config('app.url') . '/img/PFJManualParticipante2022.pdf' }}"
                            target="_blank">
                            {{ __('Manual para el participante') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
                @if (auth()->user()->personale->inscripciones->where('estado', '1')->whereIn('programa_id', session('programa_activo'))->first()->programa->estado == 1)
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">

                            <button type="button"
                                class="flex items-center block pl-3 pr-4 py-2 w-full  text-base text-sm font-medium focus:bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 border-l-4 transition duration-150 ease-in-out ">
                                <div>
                                    {{ 'Inscripciones' }}
                                </div>
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @foreach (Auth::user()->personale->inscripciones as $inscripcione)
                                @if ($inscripcione->programa->pfj->estado == 1)
                                    <x-jet-dropdown-link
                                        href="{{ route('st.programas.inscripciones', $inscripcione->programa) }}">
                                        {{ $inscripcione->programa->nombre }}
                                    </x-jet-dropdown-link>
                                @endif
                            @endforeach
                        </x-slot>
                    </x-jet-dropdown>
                @endif
                @can('admin.home')
                    <x-jet-responsive-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                        {{ __('Panel Administrativo') }}
                    </x-jet-responsive-nav-link>
                @endcan
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Perfil') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Cerrar Sessión') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
