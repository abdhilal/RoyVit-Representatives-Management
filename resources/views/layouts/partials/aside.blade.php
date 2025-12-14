<aside class="page-sidebar {{ session('icon') === 'Colorful' ? 'iconcolor-sidebar' : '' }}" data-sidebar-layout="{{ session('icon') === 'Colorful' ? 'iconcolor-sidebar' : 'stroke-svg' }}">
  <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
  <div class="main-sidebar" id="main-sidebar">
    <ul class="sidebar-menu" id="simple-bar">
      <li class="pin-title sidebar-main-title">
        <div>
          <h5 class="f-w-700 sidebar-title">{{ __('Pinned') }}</h5>
        </div>
      </li>
      @foreach(config('sidebar') as $section)
        @if(!empty($section['title']))
          <li class="sidebar-main-title">
            <div>
              <h5 class="f-w-700 sidebar-title">{{ __($section['title']) }}</h5>
            </div>
          </li>
        @endif
        @foreach(($section['items'] ?? []) as $item)
          @php
            $perm = $item['parmitions'] ?? null;
            $user = auth()->user();
            $allowed = true;
            if ($perm && $user) {
              if (isset($perm['can'])) {
                $can = $perm['can'];
                $allowed = is_array($can)
                  ? collect($can)->contains(fn($p) => $user->can($p))
                  : $user->can($can);
              }
              if ($allowed && isset($perm['role'])) {
                $role = $perm['role'];
                $allowed = is_array($role)
                  ? collect($role)->contains(fn($r) => $user->hasRole($r))
                  : $user->hasRole($role);
              }
            }
            $children = $item['children'] ?? [];
            $children = array_values(array_filter($children, function($c) use ($user) {
              $perm = $c['parmitions'] ?? null;
              if (!$perm || !$user) { return true; }
              $ok = true;
              if (isset($perm['can'])) {
                $can = $perm['can'];
                $ok = is_array($can)
                  ? collect($can)->contains(fn($p) => $user->can($p))
                  : $user->can($can);
              }
              if ($ok && isset($perm['role'])) {
                $role = $perm['role'];
                $ok = is_array($role)
                  ? collect($role)->contains(fn($r) => $user->hasRole($r))
                  : $user->hasRole($role);
              }
              return $ok;
            }));
            $hasChildren = count($children) > 0;
            $href = $hasChildren ? 'javascript:void(0)' : (isset($item['route']) ? route($item['route']) : ($item['url'] ?? '#'));
            $icon = $item['icon'] ?? null;
            $iconFa = $item['icon_fa'] ?? null;
            $label = $item['label'] ?? '';
            $itemActive = isset($item['route']) ? request()->routeIs($item['route']) : (isset($item['url']) ? request()->is(ltrim(parse_url($item['url'], PHP_URL_PATH) ?? '', '/')) : false);
            // keep submenu open if any child is active
            $open = $itemActive;
            if ($hasChildren) {
              foreach ($children as $c) {
                $cActive = isset($c['route']) ? request()->routeIs($c['route']) : (isset($c['url']) ? request()->is(ltrim(parse_url($c['url'], PHP_URL_PATH) ?? '', '/')) : false);
                if ($cActive) { $open = true; break; }
              }
            }
          @endphp
          @if($allowed)
          <li class="sidebar-list {{ $open ? 'active' : '' }}">
            <i class="fa-solid fa-thumbtack"></i>
            <a class="sidebar-link" href="{{ $href }}" @if($hasChildren) aria-expanded="{{ $open ? 'true' : 'false' }}" @endif>
              @if($iconFa)
                <i class="{{ $iconFa }}"></i>
              @elseif($icon)
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/iconly-sprite.svg#'.$icon) }}"></use>
                </svg>
              @endif
              <h6 class="f-w-600" @if(!empty($item['color'])) style="color: {{ $item['color'] }}" @endif>{{ __($label) }}</h6>
              @if($hasChildren)
                <i class="iconly-Arrow-Right-2 icli"></i>
              @endif
            </a>
            @if($hasChildren)
              <ul class="sidebar-submenu" @if($open) style="display: block;" @endif>
                @foreach($children as $child)
                  @php
                    $childHref = isset($child['route']) ? route($child['route']) : ($child['url'] ?? '#');
                    $childActive = isset($child['route']) ? request()->routeIs($child['route']) : (isset($child['url']) ? request()->is(ltrim(parse_url($child['url'], PHP_URL_PATH) ?? '', '/')) : false);
                  @endphp
                  <li class="{{ $childActive ? 'active' : '' }}">
                    <a href="{{ $childHref }}" @if(!empty($child['color'])) style="color: {{ $child['color'] }}" @endif>{{ __($child['label'] ?? '') }}</a>
                  </li>
                @endforeach
              </ul>
            @endif
          </li>
          @endif
        @endforeach
      @endforeach
    </ul>
  </div>
</aside>
