@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'model' => null,
    'id' => null,
    'placeholder' => null,
    'col' => 12,
    'required' => false,
])

@php
    $baseId = str_replace(['[',']'], '_', $name) . '_select2';
    $id = $id ?? (str_contains($name, '[]') ? ($baseId . '_' . uniqid()) : $baseId);
    $selected = old($name, $value ?? ($model ? data_get($model, trim($name, '[]')) : null));
@endphp

<div class="col-md-{{ $col }}">
    <div class="mb-3">
        @if($label)
            <label class="form-label" for="{{ $id }}">{{ $label }}</label>
        @endif
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            @if($required) required @endif
            class="form-select js-select2-local @error($name) is-invalid @enderror"
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @foreach($options as $optValue => $optLabel)
                @php $isSelected = ((string)$selected === (string)$optValue); @endphp
                <option value="{{ $optValue }}" @if($isSelected) selected @endif>{{ $optLabel }}</option>
            @endforeach
        </select>
        @error($name)
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/vendors/select2.css') }}">
        <style>
            .select2-container { width: 100% !important; }
            .select2-container .select2-selection--single {
                height: calc(1.5em + .75rem + 2px);
                border: 1px solid var(--bs-border-color, #ced4da);
                border-radius: .375rem;
                background-color: var(--bs-body-bg, #fff);
                font-family: inherit;
                font-weight: inherit;
                font-size: inherit;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: calc(1.5em + .75rem);
                padding-left: .75rem;
                padding-right: 2rem;
                color: var(--bs-body-color, #212529);
                font-family: inherit;
                font-weight: inherit;
                font-size: inherit;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: calc(1.5em + .75rem);
                right: .5rem;
            }
            .select2-dropdown {
                border-color: var(--bs-border-color, #ced4da);
                border-radius: .375rem;
                box-shadow: 0 2px 8px rgba(0,0,0,.08);
                background-color: var(--bs-body-bg, #fff);
                font-family: inherit;
                font-weight: inherit;
                font-size: inherit;
            }
            .select2-search--dropdown .select2-search__field {
                border: 1px solid var(--bs-border-color, #ced4da);
                border-radius: .375rem;
                padding: .375rem .75rem;
                outline: none;
                background-color: var(--bs-body-bg, #fff);
                color: var(--bs-body-color, #212529);
                font-family: inherit;
                font-weight: inherit;
                font-size: inherit;
            }
            .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
                background-color: var(--theme-default, #7366ff);
                color: #fff;
            }
            .select2-results__option {
                color: var(--bs-body-color, #212529);
                font-family: inherit;
                font-weight: inherit;
                font-size: inherit;
            }
            .select2-container--default.select2-container--focus .select2-selection--single {
                border-color: var(--theme-default, #7366ff);
                box-shadow: 0 0 0 .25rem rgba(115, 102, 255, 0.15);
            }
            [dir="rtl"] .select2-container--default .select2-selection--single .select2-selection__rendered {
                padding-left: 2rem;
                padding-right: .75rem;
            }
            @media (max-width: 576px) {
                .select2-container .select2-selection--single {
                    height: calc(1.5em + .5rem + 2px);
                }
                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    line-height: calc(1.5em + .5rem);
                }
                .select2-container--default .select2-selection--single .select2-selection__arrow {
                    height: calc(1.5em + .5rem);
                }
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script>
            (function() {
                function initSelects(scope) {
                    if (!window.jQuery || typeof jQuery.fn.select2 !== 'function') return;
                    var $ = jQuery;
                    $(scope).find('.js-select2-local').each(function() {
                        var $el = $(this);
                        if ($el.data('select2')) return;
                        $el.select2({
                            width: '100%',
                            minimumResultsForSearch: 0,
                            minimumInputLength: 0,
                            placeholder: $el.find('option[value=""]').length ? $el.find('option[value=""]').text() : undefined,
                            allowClear: !!$el.find('option[value=""]').length,
                            dir: document.documentElement.getAttribute('dir') || 'ltr'
                        });
                    });
                }
                document.addEventListener('DOMContentLoaded', function() { initSelects(document); });
                var mo = new MutationObserver(function() { initSelects(document); });
                mo.observe(document.body, { childList: true, subtree: true });
            })();
        </script>
    @endpush
@endonce
