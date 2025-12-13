@props([
    'label' => null,
    'class' => 'btn btn-outline-primary',
    'icon' => null,
])

@php
    $label = $label ?? __('submit');
@endphp

<div>
    <button type="submit" class="{{ $class }}" {{ $attributes }}>
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label }}
    </button>
</div>
