@extends('layouts.app')
@php
    $isEdit = isset($representativeStore) && $representativeStore->exists;
    $title = $isEdit ? __('Edit Representative Store') : __('Add New Representative Store');
    $action = $isEdit
        ? route('representativeStores.update', $representativeStore)
        : route('representativeStores.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Representative Stores') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Representative Store') : __('Add New Representative Store') }}
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
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$representativeStore->product" readonly />
                            <x-forms.input name="quantity" label="{{ __('quantity') }}" :model="$representativeStore" required />

                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="representativeStores.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
