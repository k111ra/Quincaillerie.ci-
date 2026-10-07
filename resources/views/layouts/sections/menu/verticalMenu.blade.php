<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="" alt="">
        {{-- @include('_partials.macros',["width"=>25,"withbg"=>'#696cff']) --}}
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-autod-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @foreach ($menuData[0]->menu as $menu)

    {{-- adding active and open class if child is active --}}

    {{-- menu headers --}}
    @if (isset($menu->menuHeader))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">{{ $menu->menuHeader }}</span>
    </li>

    @else

    {{-- active menu method --}}
    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();
    $matchesMenuRoute = function ($slugs) use ($currentRouteName) {
      foreach ((array) $slugs as $slug) {
        if ($currentRouteName === $slug || str_starts_with($currentRouteName, $slug . '.')) {
          return true;
        }
      }

      return false;
    };

    if ($matchesMenuRoute($menu->slug)) {
    $activeClass = isset($menu->submenu) ? 'active open' : 'active';
    }
    elseif (isset($menu->submenu)) {
    if ($matchesMenuRoute($menu->slug)) {
    $activeClass = 'active open';
    }
    }
    @endphp

    {{-- main menu --}}
    <li class="menu-item {{$activeClass}}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }}"></i>
        @endisset
        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
      </a>

      {{-- submenu --}}
      @isset($menu->submenu)
      @include('layouts.sections.menu.submenu',['menu' => $menu->submenu])
      @endisset
    </li>
    @endif
    @endforeach
  </ul>

</aside>
