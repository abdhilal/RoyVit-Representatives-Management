@extends('layouts.app')
@php
    $isEdit = isset($area) && $area->exists;
    $title = $isEdit ? __('Edit Area') : __('Add New Area');
    $action = $isEdit ? route('areas.update', $area) : route('areas.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Areas') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Area') : __('Add New Area') }}
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
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$area" required />
                            <x-forms.select
                                name="city_id"
                                label="{{ __('State') }}"
                                :model="$area"
                                :options="$cities->pluck('name', 'id')->toArray()"
                                placeholder="{{ __('Press to select') }}"
                                required
                            />

                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="areas.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
