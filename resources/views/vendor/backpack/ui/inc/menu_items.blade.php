{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('series') }}">📚 Series</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('comic') }}">📖 Comics</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('character') }}">🦸 Characters</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}">👥 Users</a></li>
{{-- <x-backpack::menu-item title="Dashboard" icon="la la-home" :link="backpack_url('dashboard')" /> --}}
<x-backpack::menu-item title="Series" icon="la la-question" :link="backpack_url('series')" />
<x-backpack::menu-item title="Comics" icon="la la-question" :link="backpack_url('comic')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Characters" icon="la la-question" :link="backpack_url('character')" />