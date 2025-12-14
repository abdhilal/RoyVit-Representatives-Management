@extends('layouts.app')
@php
    $isEdit = isset($classification) && $classification->exists;
    $title = $isEdit ? __('Edit Classification') : __('Add New Classification');
    $action = $isEdit ? route('classifications.update', $classification) : route('classifications.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Classifications') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Classification') : __('Add New Classification') }}
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
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$classification" required />
                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="classifications.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
