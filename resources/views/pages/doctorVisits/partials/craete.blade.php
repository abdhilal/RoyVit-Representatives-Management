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
                            id="doctorVisitForm" novalidate>



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
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Attachment') }}</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-outline-primary" id="btn-attachment-camera">
                                                <i class="fa-solid fa-camera me-2"></i> {{ __('Open Camera') }}
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" id="btn-attachment-files">
                                                <i class="fa-solid fa-image me-2"></i> {{ __('Select from Gallery') }}
                                            </button>
                                        </div>
                                        <input type="file" name="attachment" accept="image/*" class="d-none" id="attachment_input">
                                        @error('attachment')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                        <div id="attachment_file_name" class="form-text text-muted mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="mb-4">
                                <x-forms.textarea name="note" label="{{ __('Note') }}" rows="4"
                                    placeholder="{{ __('Enter any additional notes...') }}" />
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex flex-row flex-sm-row gap-3 justify-content-center mt-5">
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
        (function(){
            var cameraBtn = document.getElementById('btn-attachment-camera');
            var filesBtn = document.getElementById('btn-attachment-files');
            var attachmentInput = document.getElementById('attachment_input');
            var fileNameEl = document.getElementById('attachment_file_name');
            function readAsDataURL(file){ return new Promise(function(res,rej){ var r=new FileReader(); r.onload=function(){res(r.result)}; r.onerror=rej; r.readAsDataURL(file); }); }
            function loadImg(src){ return new Promise(function(res,rej){ var img=new Image(); img.onload=function(){res(img)}; img.onerror=rej; img.src=src; }); }
            function toBlob(canvas, type, quality){ return new Promise(function(res){ canvas.toBlob(res, type, quality); }); }
            async function compressImage(file, maxDim, quality){
                var dataUrl = await readAsDataURL(file);
                var img = await loadImg(dataUrl);
                var w = img.naturalWidth || img.width, h = img.naturalHeight || img.height;
                var ratio = Math.min(1, maxDim / Math.max(w, h));
                var nw = Math.round(w * ratio), nh = Math.round(h * ratio);
                var canvas = document.createElement('canvas');
                canvas.width = nw; canvas.height = nh;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, nw, nh);
                var blob = await toBlob(canvas, 'image/jpeg', quality);
                var name = (file.name && file.name.toLowerCase().endsWith('.jpg')) ? file.name : 'attachment.jpg';
                return new File([blob], name, { type: 'image/jpeg' });
            }
            function updateName(input){
                if(!fileNameEl) return;
                var f = input && input.files && input.files[0];
                fileNameEl.textContent = f ? f.name : '';
            }
            async function handleAttachmentChange(){
                if(!attachmentInput || !attachmentInput.files || !attachmentInput.files[0]) return;
                var file = attachmentInput.files[0];
                var isCamera = attachmentInput.hasAttribute('capture');
                var need = isCamera || file.size > 600*1024;
                if(!need){ updateName(attachmentInput); return; }
                if(fileNameEl) fileNameEl.textContent = '...';
                try{
                    var compressed = await compressImage(file, isCamera ? 1280 : 1600, isCamera ? 0.7 : 0.8);
                    if(compressed && compressed.size < file.size && typeof DataTransfer === 'function'){
                        var dt = new DataTransfer();
                        dt.items.add(compressed);
                        attachmentInput.files = dt.files;
                    }
                } catch(e){}
                updateName(attachmentInput);
            }
            if(cameraBtn && attachmentInput){
                cameraBtn.addEventListener('click', function(){
                    attachmentInput.value = '';
                    attachmentInput.setAttribute('capture','environment');
                    attachmentInput.click();
                });
                attachmentInput.addEventListener('change', function(){ handleAttachmentChange(); });
            }
            if(filesBtn && attachmentInput){
                filesBtn.addEventListener('click', function(){
                    attachmentInput.value = '';
                    attachmentInput.removeAttribute('capture');
                    attachmentInput.click();
                });
                attachmentInput.addEventListener('change', function(){ handleAttachmentChange(); });
            }
        })();
        (function(){
            var form = document.getElementById('doctorVisitForm');
            if(!form) return;
            var overlay = document.createElement('div');
            overlay.className = 'position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center';
            overlay.style.cssText = 'background:rgba(0,0,0,.25);z-index:3000;display:none;';
            overlay.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">...</span></div>';
            document.body.appendChild(overlay);
            form.addEventListener('submit', function(e){
                var btn = form.querySelector('button[type="submit"]');
                if(btn){ btn.disabled = true; btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' + btn.textContent.trim(); }
                overlay.style.display = 'flex';
            });
        })();
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
