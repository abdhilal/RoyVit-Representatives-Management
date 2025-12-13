@props([
    'name',
    'label' => null,
    'options' => [], // [value => text]
    'value' => [], // array of selected values
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'help' => null,
    'id' => null,
    'col' => 12,
    'selectClass' => 'form-control',
])
@php
    // Use requested identifiers for styling integrations (Choices.js, etc.)
    $id = $id ?? 'choices-multiple-remove-button';
    $colClass = 'col-md-' . (int) $col;
    $selectedValues = collect(old($name, $value ?? []))->map(fn($v) => (string) $v)->all();
    $hasError = $errors->has($name);
    $selectName = $name . '[]';
    $placeholderText = $placeholder ?? __('select options');
@endphp
<div class="{{ $colClass }}">
    @if($label)
        <label class="form-label" for="{{ $id }}">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    @endif
    <select
        id="{{ $id }}"
        name="{{ $selectName }}"
        class="{{ $selectClass }} {{ $hasError ? 'is-invalid' : '' }}"
        multiple
        @if($disabled) disabled @endif
        @if($required) required @endif
        data-multiple="true"
        @if($placeholder) data-placeholder="{{ $placeholderText }}" @endif
    >
        @if($placeholder)
            <option value="" disabled hidden>{{ $placeholderText }}</option>
        @endif
        @foreach($options as $optValue => $optLabel)
            @php $isSelected = in_array((string) $optValue, $selectedValues, true); @endphp
            <option value="{{ $optValue }}"  @if($isSelected) selected @endif>{{ $optLabel }}</option>
        @endforeach
    </select>
    @if($help)
        <small class="form-text text-muted">{{ $help }}</small>
    @endif
    @if($hasError)
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>
