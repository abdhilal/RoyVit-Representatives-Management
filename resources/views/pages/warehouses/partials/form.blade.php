@extends('layouts.app')
@php
    $isEdit = isset($warehouse) && $warehouse->exists;
    $title = $isEdit ? __('Edit Warehouse') : __('Add New Warehouse');
    $action = $isEdit ? route('warehouses.update', $warehouse) : route('warehouses.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Warehouses') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Warehouse') : __('Add New Warehouse') }}
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

                            <x-forms.input name="name" label="{{ __('name') }}" :model="$warehouse" required />

                            <x-forms.input name="location" label="{{ __('location') }}" :model="$warehouse"  />
                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="warehouses.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
