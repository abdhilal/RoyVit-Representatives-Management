@extends('layouts.app')
@php
    $isEdit = isset($visitPeriod) && $visitPeriod->exists;
    $title = $isEdit ? __('Edit Visit Period') : __('Add New Visit Period');
    $action = $isEdit ? route('visitPeriods.update', $visitPeriod) : route('visitPeriods.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Monthly Periods') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Visit Period') : __('Add New Visit Period') }}
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
                            <x-forms.input name="max_visits" label="{{ __('max visits') }}" :model="$visitPeriod" required />

                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="visitPeriods.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
