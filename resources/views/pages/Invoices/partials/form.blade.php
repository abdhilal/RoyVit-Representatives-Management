@extends('layouts.app')
@php
    $isEdit = isset($invoice) && $invoice->exists;
    $title = $isEdit ? __('Edit Invoice') : __('Add New Invoice');
    $action = $isEdit ? route('invoices.update', $invoice) : route('invoices.store');
    $method = $isEdit ? 'PUT' : 'POST';
    
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Invoices') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Invoice') : __('Add New Invoice') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end align-items-center">
                    </div>
                    <div class="card-body">
                        <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                            <x-forms.select
                                name="representative_id"
                                label="{{ __('representative') }}"
                                :model="$invoice"
                                :value="$invoice->receiver_id ?? null"
                                :options="$representatives->pluck('name', 'id')->toArray()"
                                placeholder="{{ __('Press to select') }}"
                                required
                                col="6"
                            />

                            <div class="col-12">
                                <div id="items-container" class="row g-3">
                                    @php
                                        $items = ($isEdit && isset($invoice) && $invoice->relationLoaded('invoiceItems'))
                                            ? $invoice->invoiceItems
                                            : collect([null]);
                                    @endphp
                                    @foreach($items as $item)
                                        <div class="invoice-item row g-3">
                                            <x-forms.select
                                                name="product_id[]"
                                                label="{{ __('product') }}"
                                                :model="$invoice"
                                                :value="$item?->product_id"
                                                :options="$products->pluck('name', 'id')->toArray()"
                                                placeholder="{{ __('Press to select') }}"
                                                required
                                                col="6"
                                            />
                                            <x-forms.input
                                                name="quantity[]"
                                                label="{{ __('quantity') }}"
                                                :model="$invoice"
                                                :value="$item?->quantity"
                                                required
                                                col="6"
                                            />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-secondary" id="add-item-btn">{{ __('add new') }}</button>
                                </div>
                            </div>

                            <x-forms.textarea name="note" label="{{ __('note') }}" :model="$invoice" required />




                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="invoices.index" />
                            </div>
                        </x-forms.form>
                        <script>
                            (function () {
                                const container = document.getElementById('items-container');
                                const addBtn = document.getElementById('add-item-btn');
                                addBtn.addEventListener('click', function () {
                                    const items = container.querySelectorAll('.invoice-item');
                                    const last = items[items.length - 1];
                                    const clone = last.cloneNode(true);
                                    const inputs = clone.querySelectorAll('input, select, textarea');
                                    inputs.forEach(function (el) {
                                        if (el.tagName.toLowerCase() === 'select') {
                                            el.selectedIndex = 0;
                                        } else {
                                            el.value = '';
                                        }
                                    });
                                    container.appendChild(clone);
                                });
                            })();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
