@props([
    'value' => null,
    'label' => null,
    'icon' => 'shopping-cart',
    'iconLib' => 'feather',
    'iconClass' => null,
    'roundColor' => 'danger',
    'trendText' => null,
    'trendClass' => 'font-danger',
    'colClass' => 'col-sm-6 col-xl-3 box-col-6',
])
<div {{ $attributes->merge(['class' => $colClass]) }}>
    <div class="card widget-1">
        <div class="card-body">
            <div class="widget-content">
                <div class="widget-round {{ $roundColor }}">
                    <div class="bg-round">
                        @switch($iconLib)
                            @case('feather')
                                <i data-feather="{{ $icon }}" class="svg-fill {{ $iconClass }}"></i>
                                @break
                            @default
                                <i class="{{ $icon }} svg-fill {{ $iconClass }}"></i>
                        @endswitch
                        <svg class="half-circle svg-fill">
                            <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                        </svg>
                    </div>
                </div>
                <div>
                    <h4>{{ $value }}</h4><span class="f-light">{{ $label }}</span>
                </div>
            </div>
            @if($trendText)
                <div class="{{ $trendClass }} f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>{{ $trendText }}</span></div>
            @endif
        </div>
    </div>
</div>
