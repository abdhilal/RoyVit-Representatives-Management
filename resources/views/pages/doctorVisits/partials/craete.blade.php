@extends('layouts.app')

@php
    $title = __('Add New Doctor Visit');
@endphp

@section('title', $title)
@section('breadcrumb', __('Doctor Visits'))
@section('breadcrumbActive', $title)

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0">{{ $title }}</h5>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <x-forms.form :action="route('doctorVisits.store')" method="POST" enctype="multipart/form-data" class="needs-validation"
                            novalidate>



                            <!-- Doctor Selection -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <x-forms.choices-select name="doctor_id" label="{{ __('Doctor') }}" :options="$data['doctorOptions'] ?? []"
                                        placeholder="{{ __('Select Doctor') }}"
                                        searchPlaceholder="{{ __('Search Doctor') }}"
                                        noResultsText="{{ __('No results found') }}"
                                        itemSelectText="{{ __('Press to select') }}" required col="12" />
                                </div>
                            </div>

                            <!-- Visit Items Table -->
                            <div class="mb-5">
                                <h6 class="text-primary mb-3">{{ __('Visit Items') }}</h6>

                                @php
                                    $oldProductIds = old('product_id', []);
                                    $oldQuantities = old('quantity', []);
                                    $initialRows = max(1, is_array($oldProductIds) ? count($oldProductIds) : 0);
                                @endphp
                                <div>
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="text-center" style="width: 50%;">
                                                    {{ __('Product') }}</th>
                                                <th scope="col" class="text-center" style="width: 30%;">
                                                    {{ __('Quantity') }}</th>
                                                <th scope="col" class="text-center" style="width: 20%;">
                                                    {{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="items-container">
                                            @for ($i = 0; $i < $initialRows; $i++)
                                                <tr class="visit-item">
                                                    <td class="p-3">
                                                        <x-forms.choices-select name="product_id[]" :options="$data['productOptions'] ?? []"
                                                            :value="$oldProductIds[$i] ?? null" placeholder="{{ __('Select Product') }}"
                                                            searchPlaceholder="{{ __('Search Product') }}"
                                                            noResultsText="{{ __('No results found') }}"
                                                            itemSelectText="{{ __('Press to select') }}" required
                                                            col="12" />
                                                        @if ($errors->has('product_id.' . $i))
                                                            <div class="text-danger small">
                                                                {{ $errors->first('product_id.' . $i) }}</div>
                                                        @elseif($i === 0 && $errors->has('product_id'))
                                                            <div class="text-danger small">
                                                                {{ $errors->first('product_id') }}</div>
                                                        @endif
                                                    </td>
                                                    <td class="p-3">
                                                        <x-forms.input name="quantity[]" type="number"
                                                            value="{{ $oldQuantities[$i] ?? 1 }}" min="1" required
                                                            col="12" />
                                                        @if ($errors->has('quantity.' . $i))
                                                            <div class="text-danger small">
                                                                {{ $errors->first('quantity.' . $i) }}</div>
                                                        @elseif($i === 0 && $errors->has('quantity'))
                                                            <div class="text-danger small">{{ $errors->first('quantity') }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="p-3 text-center">
                                                        <button type="button"
                                                            class="btn btn-outline-danger remove-item-btn">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span
                                                                class="d-none d-md-inline ms-2">{{ __('Delete') }}</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <template id="visit-item-template">
                                    <tr class="visit-item">
                                        <td class="p-3">
                                            <x-forms.choices-select name="product_id[]" :options="$data['productOptions'] ?? []"
                                                placeholder="{{ __('Select Product') }}"
                                                searchPlaceholder="{{ __('Search Product') }}"
                                                noResultsText="{{ __('No results found') }}"
                                                itemSelectText="{{ __('Press to select') }}" required col="12" />
                                        </td>
                                        <td class="p-3">
                                            <x-forms.input name="quantity[]" type="number" value="1" min="1"
                                                required col="12" />
                                        </td>
                                        <td class="p-3 text-center">
                                            <button type="button" class="btn btn-outline-danger remove-item-btn">
                                                <i class="fas fa-trash-alt"></i>
                                                <span class="d-none d-md-inline ms-2">{{ __('Delete') }}</span>
                                            </button>
                                        </td>
                                    </tr>
                                </template>

                                <!-- Add New Row Button -->
                                <div class="mt-3 text-end">
                                    <button type="button" class="btn btn-outline-primary" id="add-item-btn">
                                        <i class="fas fa-plus me-2"></i>{{ __('Add New Item') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-12 col-md-6">
                                    <x-forms.input name="visit_date" type="date" label="{{ __('Visit Date') }}"
                                        value="{{ now()->format('Y-m-d') }}" required col="12" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <x-forms.input name="attachment" type="file" label="{{ __('Attachment') }}"
                                        accept="image/*" col="12" />
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="mb-4">
                                <x-forms.textarea name="note" label="{{ __('Note') }}" rows="4"
                                    placeholder="{{ __('Enter any additional notes...') }}" />
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-end mt-5">
                                <x-forms.submit-button label="{{ __('Save') }}" class="btn-lg px-5" />
                                <x-buttons.cancel route="doctorVisits.index" label="{{ __('Cancel') }}"
                                    class="btn-lg btn-outline-secondary px-5" />
                            </div>

                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('items-container');
            const addBtn = document.getElementById('add-item-btn');
            const tpl = document.getElementById('visit-item-template');
            if (!container || !addBtn || !tpl) return;

            const createRow = () => {
                const node = tpl.content.firstElementChild.cloneNode(true);
                const productSelect = node.querySelector('select[name="product_id[]"]');
                const quantityInput = node.querySelector('input[name="quantity[]"]');
                if (productSelect) {
                    productSelect.removeAttribute('id');
                    productSelect.value = '';
                }
                if (quantityInput) {
                    quantityInput.value = '1';
                }
                return node;
            };

            addBtn.addEventListener('click', function() {
                const row = createRow();
                if (!row) return;
                container.appendChild(row);
            });

            // حذف أو إعادة تعيين الصف
            container.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-item-btn');
                if (!btn) return;

                const row = btn.closest('.visit-item');
                if (!row) return;

                const rows = container.querySelectorAll('.visit-item');
                if (rows.length > 1) {
                    row.remove();
                } else {
                    const newRow = createRow();
                    row.replaceWith(newRow);
                }
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .table-responsive {
            overflow-y: visible;
        }

        .card-body {
            overflow: visible;
        }

        .choices__list--dropdown {
            z-index: 2000;
        }

        @media (max-width: 576px) {
            .table thead {
                display: none;
            }

            .table tbody tr.visit-item td {
                display: block;
                width: 100% !important;
                border: none;
                border-bottom: 1px solid var(--bs-border-color);
                padding: .75rem 0;
            }

            .table tbody tr.visit-item td:last-child {
                border-bottom: none;
            }

            .remove-item-btn {
                width: 100%;
            }
        }
    </style>
@endpush
