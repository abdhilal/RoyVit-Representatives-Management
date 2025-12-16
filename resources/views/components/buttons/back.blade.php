@props([
    'action' => '',
    'text' => 'back',
    'class' => 'btn btn-sm btn-outline-secondary',
])
<a href="{{ $action }}" class="{{ $class }}">{{ __($text) }}</a>
