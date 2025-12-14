@props([
    'name',
    'label' => null,
    'options' => [], // [value => label]
    'value' => null,
    'model' => null,
    'id' => null,
    'inline' => false,
    'col' => 12,
    'required' => false,
])

@php
    $id = $id ?? $name . '_radio';
    $selected = old($name, $value ?? ($model ? data_get($model, $name) : null));
@endphp

<div class="col-md-{{ $col }}">
    <div class="mb-3">
        @if ($label)
            <p class="form-label" for="{{ $id }}">{{ $label }}</p>
        @endif

        @foreach ($options as $optValue => $optLabel)
            @php
                $valueResolved = null;
                $labelResolved = null;
                if (is_array($optLabel)) {
                    $valueResolved = $optLabel['value'] ?? $optValue;
                    $labelResolved = $optLabel['label'] ?? $optValue;
                } elseif (is_object($optLabel)) {
                    $valueResolved = property_exists($optLabel, 'value')
                        ? $optLabel->value
                        : (method_exists($optLabel, 'value')
                            ? $optLabel->value()
                            : $optValue);
                    $labelResolved = method_exists($optLabel, 'label')
                        ? $optLabel->label()
                        : (property_exists($optLabel, 'name')
                            ? $optLabel->name
                            : $optValue);
                } else {
                    $valueResolved = is_string($optValue) ? $optValue : $optLabel;
                    $labelResolved = $optLabel;
                }
                $optId = $id . '_' . $valueResolved;
                $isSelected = (string) $selected === (string) $valueResolved;
            @endphp
            <div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
                <input class="form-check-input" type="radio" id="{{ $optId }}" name="{{ $name }}"
                    value="{{ $valueResolved }}" @if ($isSelected) checked @endif
                    @if ($required) required @endif {{ $attributes }}>
                <label class="form-check-label" for="{{ $optId }}">{{ $labelResolved }}</label>
            </div>
        @endforeach

        @error($name)
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>
