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
    $baseId = str_replace(['[', ']'], '_', $name) . '_choices_multi';
    $id = $id ?? (str_contains($name, '[]') ? $baseId . '_' . uniqid() : $baseId);
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
        class="{{ $selectClass }} js-choices {{ $hasError ? 'is-invalid' : '' }}"
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
@once
    @push('scripts')
        <script>
            (function() {
                function initChoicesMulti(scope) {
                    if (typeof Choices !== 'function') return;
                    var els = scope.querySelectorAll('.js-choices[multiple]');
                    els.forEach(function(el) {
                        if (el._choicesInstance) return;
                        var opts = {
                            searchEnabled: true,
                            removeItemButton: true,
                            shouldSort: false
                        };
                        try {
                            el._choicesInstance = new Choices(el, opts);
                        } catch (e) {}
                    });
                }
                document.addEventListener('DOMContentLoaded', function() {
                    initChoicesMulti(document);
                });
                var mo = new MutationObserver(function() {
                    initChoicesMulti(document);
                });
                mo.observe(document.body, { childList: true, subtree: true });
            })();
        </script>
    @endpush
@endonce
