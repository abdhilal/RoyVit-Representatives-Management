@props([
    'href' => null,
    'route' => null,
    'label' => null,
    'class' => 'btn btn-outline-secondary',
])

@php
    $url = $href ?? ($route ? route($route) : '#');
    $label = $label ?? __('cancel');
@endphp

<div>
    <a href="{{ $url }}" class="{{ $class }}" {{ $attributes }}>{{ $label }}</a>
</div>