  {{-- @php
      $doctorOptions = collect($data['doctors'] ?? [])
          ->mapWithKeys(function ($d) {
              $name = $d->name ?? '';
              $className = optional($d->classification)->name ?? __('No classification');
              return [$d->id => "{$name} - {$className}"];
          })
          ->toArray();
  @endphp

  <x-forms.choices-select name="doctor_id" label="{{ __('Doctor') }}" :options="$doctorOptions"
      placeholder="{{ __('Select Doctor') }}" searchPlaceholder="{{ __('Search Doctor') }}"
      noResultsText="{{ __('No results found') }}" itemSelectText="{{ __('Press to select') }}" required col="4" /> --}}

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
      'selectClass' => 'form-select',
      'searchPlaceholder' => null,
      'noResultsText' => null,
      'itemSelectText' => null,
  ])
  @php
      $baseId = str_replace(['[', ']'], '_', $name) . '_choices';
      $id = $id ?? (str_contains($name, '[]') ? $baseId . '_' . uniqid() : $baseId);
      $selected = old($name, $value ?? ($model ? data_get($model, trim($name, '[]')) : null));
  @endphp
  <div class="col-md-{{ $col }}">
      <div class="mb-3">
          @if ($label)
              <label class="form-label" for="{{ $id }}">{{ $label }}</label>
          @endif
          <select id="{{ $id }}" name="{{ $name }}" @if ($required) required @endif
              class="{{ $selectClass }} js-choices @error($name) is-invalid @enderror"
              @if ($searchPlaceholder) data-search-placeholder="{{ $searchPlaceholder }}" @endif
              @if ($noResultsText) data-no-results-text="{{ $noResultsText }}" @endif
              @if ($itemSelectText) data-item-select-text="{{ $itemSelectText }}" @endif>
              @if ($placeholder)
                  <option value="">{{ $placeholder }}</option>
              @endif
              @foreach ($options as $optValue => $optLabel)
                  @php $isSelected = ((string)$selected === (string)$optValue); @endphp
                  <option value="{{ $optValue }}" @if ($isSelected) selected @endif>
                      {{ $optLabel }}</option>
              @endforeach
          </select>
          @error($name)
              <div class="text-danger small">{{ $message }}</div>
          @enderror
      </div>
  </div>
  @once
      @push('scripts')
          <script>
              (function() {
                  function initChoices(scope) {
                      if (typeof Choices !== 'function') return;
                      var els = scope.querySelectorAll('.js-choices');
                      els.forEach(function(el) {
                          if (el._choicesInstance) return;
                          var opts = {
                              searchEnabled: true,
                              searchPlaceholderValue: el.getAttribute('data-search-placeholder') || '',
                              noResultsText: el.getAttribute('data-no-results-text') || '',
                              itemSelectText: el.getAttribute('data-item-select-text') || '',
                              shouldSort: false
                          };
                          el._choicesInstance = new Choices(el, opts);
                      });
                  }
                  document.addEventListener('DOMContentLoaded', function() {
                      initChoices(document);
                  });
                  var mo = new MutationObserver(function() {
                      initChoices(document);
                  });
                  mo.observe(document.body, {
                      childList: true,
                      subtree: true
                  });
              })
              ();
          </script>
      @endpush
  @endonce
