@extends('layouts.app')

@php
    $isEdit = isset($doctorVisit) && $doctorVisit->exists;
    $title = $isEdit ? __('Edit Doctor Visit') : __('Add New Doctor Visit');
    $action = $isEdit ? route('doctorVisits.update', $doctorVisit) : route('doctorVisits.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp

@section('title')
    {{ $title }}
@endsection



@section('breadcrumb')
    {{ __('Doctor Visits') }}
@endsection
@section('breadcrumbActive')
    {{ $title }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ __('doctor visit') }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                            <h6 class="mb-2 f-w-700">{{ __('the information') }}</h6>
                            <x-forms.select2-local name="doctor_id" label="{{ __('Select doctor') }}" :model="$doctorVisit"
                                :value="$doctorVisit->doctor_id ?? null" :options="$data['doctors']->pluck('name', 'id')->toArray()" required col="6" />

                            <div class="col-12">
                                <h6 class="mb-2 f-w-700">{{ __('Visit Items') }}</h6>
                                <div id="items-container" class="row g-3">
                                    @php
                                        $items =
                                            $isEdit && $doctorVisit->relationLoaded('doctorVisitItems')
                                                ? $doctorVisit->doctorVisitItems
                                                : [null]; // عرض حقل واحد فارغ عند الإنشاء
                                    @endphp

                                    @php
                                        $productOptions = collect($data['RepresentativeStores'] ?? [])
                                            ->filter(function ($store) {
                                                return $store->product && $store->product->id;
                                            })
                                            ->sortBy(function ($store) {
                                                return $store->product->name ?? '';
                                            })
                                            ->mapWithKeys(function ($store) {
                                                $id = $store->product->id;
                                                $name = $store->product->name ?? '';
                                                $typeKey = $store->product->type ?? '';
                                                $typeLabel = __($typeKey);
                                                $qtyLabel = __('Quantity');
                                                $quantity = $store->quantity ?? 0;
                                                return [$id => "{$name} - {$typeLabel} - {$qtyLabel}: {$quantity}"];
                                            })
                                            ->toArray();
                                    @endphp

                                    @foreach ($items as $item)
                                        <div class="doctor-visit-item row g-3">
                                            <x-forms.select2-local name="product_id[]" label="{{ __('product') }}"
                                                :value="$item->product_id ?? null" :options="$productOptions" required col="6" />

                                            <x-forms.input name="quantity[]" label="{{ __('quantity') }}" :value="$item->quantity ?? 1"
                                                required col="6" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-secondary" id="add-item-btn">
                                        {{ __('add new') }}
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('File') }}</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('visit date') }}</label>
                                <input type="date" name="visit_date" class="form-control"
                                    value="{{ $isEdit ? $doctorVisit->date->format('Y-m-d') : date('Y-m-d') }}" required>
                            </div>

                            <x-forms.textarea name="note" label="{{ __('note') }}" :model="$doctorVisit" />

                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="doctorVisits.index" />
                            </div>
                        </x-forms.form>

                        @push('scripts')
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var container = document.getElementById('items-container');
                                    var addBtn = document.getElementById('add-item-btn');
                                    if (!container || !addBtn) return;
                                    addBtn.addEventListener('click', function() {
                                        var items = container.querySelectorAll('.doctor-visit-item');
                                        if (!items.length) return;
                                        var last = items[items.length - 1];
                                        var clone = last.cloneNode(true);
                                        clone.querySelectorAll('.select2').forEach(function(el) {
                                            el.remove();
                                        });
                                        clone.querySelectorAll('input, select, textarea').forEach(function(el) {
                                            var tag = el.tagName.toLowerCase();
                                            if (tag === 'select') {
                                                if (!el.querySelector('option[value=""]')) {
                                                    var opt = document.createElement('option');
                                                    opt.value = '';
                                                    opt.text = '';
                                                    el.insertBefore(opt, el.firstChild);
                                                }
                                                el.removeAttribute('data-select2-id');
                                                el.removeAttribute('aria-hidden');
                                                el.removeAttribute('tabindex');
                                                var newId = el.name.replace(/\[|\]/g, '_') + '_select2_' + Date.now() +
                                                    '_' + Math.floor(Math.random() * 1000);
                                                el.id = newId;
                                                var lblContainer = el.closest('.mb-3');
                                                if (lblContainer) {
                                                    var lbl = lblContainer.querySelector('label.form-label');
                                                    if (lbl) lbl.setAttribute('for', newId);
                                                }
                                                el.value = '';
                                            } else {
                                                el.value = (el.name === 'quantity[]') ? '1' : '';
                                            }
                                        });
                                        container.appendChild(clone);
                                    });
                                });
                            </script>
                        @endpush

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
