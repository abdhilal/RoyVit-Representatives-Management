@extends('layouts.app')
@php
    $isEdit = isset($specialization) && $specialization->exists;
    $title = $isEdit ? __('Edit Specialization') : __('Add New Specialization');
    $action = $isEdit ? route('specializations.update', $specialization) : route('specializations.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Specializations') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Specialization') : __('Add New Specialization') }}
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
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$specialization" required />
                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="specializations.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
