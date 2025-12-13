@props([
    'name',
    'label' => null,
    'options' => [], // [value => label]
    'value' => null,
    'model' => null,
    'id' => null,
    'placeholder' => null,
    'col' => 12,
    'required' => false,
])

@php
    $id = $id ?? $name . '_select';
    $selected = old($name, $value ?? ($model ? data_get($model, $name) : null));
    $nameAttr = $name;
@endphp

<div class="col-md-{{ $col }}">
    <div class="mb-3">
        @if($label)
            <label class="form-label" for="{{ $id }}">{{ $label }}</label>
        @endif

        <select
            id="{{ $id }}"
            name="{{ $nameAttr }}"
            @if($required) required @endif
            {{ $attributes->merge(['class' => 'form-select']) }}
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach($options as $optValue => $optLabel)
                @php $isSelected = ((string)$selected === (string)$optValue); @endphp
                <option value="{{ $optValue }}" @if($isSelected) selected @endif>
                    {{ $optLabel }}
                </option>
            @endforeach
        </select>

        @error($name)
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>
