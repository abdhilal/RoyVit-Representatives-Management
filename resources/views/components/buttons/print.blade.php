@props([
    'text' => 'Print Invoice',
    'class' => 'btn btn-sm btn-primary',
])
<button type="button" class="{{ $class }}" onclick="window.print()">{{ __($text) }}</button>
