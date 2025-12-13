@props([
    'class' => 'container-fluid general-widget',
])
<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="row">
        {{ $slot }}
    </div>
</div>
