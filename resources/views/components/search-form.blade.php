@props([
    'action' => null,
    'route' => null,
    'method' => 'GET',
    'name' => 'search',
    'value' => null,
    'placeholder' => null,
    'label' => null,
    'col' => 3,
    'inputClass' => 'form-control',
    'buttonClass' => 'btn btn-outline-secondary',
    'submitLabel' => null,
    'showClear' => true,
    'keepQuery' => true,
])
@php
    $formAction = $action ?? ($route ? route($route) : url()->current());
    $currentValue = $value ?? request($name);
    $placeholderText = $placeholder ?? __('search');
    $submitText = $submitLabel ?? __('search');
    $colClass = 'col-md-' . (int) $col;
    $isGet = strtoupper($method) === 'GET';
    $clearUrl = $formAction;
    if ($keepQuery) {
        $otherQuery = request()->except($name);
        if (!empty($otherQuery)) {
            $clearUrl = $formAction . '?' . http_build_query($otherQuery);
        }
    }
@endphp
<div class="{{ $colClass }}">
    @if($label)
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endif
    <form action="{{ $formAction }}" method="{{ $isGet ? 'GET' : 'POST' }}" class="d-flex" {{ $attributes }}>
        @unless($isGet)
            @csrf
            @method($method)
        @endunless
        @if($keepQuery)
            @foreach(request()->except($name) as $key => $val)
                @if(is_array($val))
                    @foreach($val as $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endif
            @endforeach
        @endif
        <input
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $currentValue }}"
            class="{{ $inputClass }} me-2"
            placeholder="{{ $placeholderText }}"
            autocomplete="off"
        />
        <button type="submit" class="{{ $buttonClass }}">{{ $submitText }}</button>
        @if($showClear)
            <a href="{{ $clearUrl }}" class="btn btn-light ms-2">{{ __('clear') }}</a>
        @endif
    </form>
</div>
