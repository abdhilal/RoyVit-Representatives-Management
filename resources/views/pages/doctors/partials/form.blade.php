@extends('layouts.app')
@php
    $isEdit = isset($doctor) && $doctor->exists;
    $title = $isEdit ? __('Edit Doctor') : __('Add New Doctor');
    $action = $isEdit ? route('doctors.update', $doctor) : route('doctors.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Doctors') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Doctor') : __('Add New Doctor') }}
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
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$doctor" required />
                            <x-forms.input name="phone" label="{{ __('phone') }}" :model="$doctor" required />
                            <x-forms.input name="address" label="{{ __('address') }}" :model="$doctor" required />
                            <x-forms.radio
                                name="gender"
                                label="{{ __('gender') }}"
                                :model="$doctor"
                                :options="$ganders"
                                inline="true"
                                required
                            />
                            <x-forms.select
                                name="area_id"
                                label="{{ __('area') }}"
                                :model="$doctor"
                                :options="$areas->pluck('name', 'id')->toArray()"
                                placeholder="{{ __('Press to select') }}"
                                required
                            />
                            <x-forms.select
                                name="specialization_id"
                                label="{{ __('specialization') }}"
                                :model="$doctor"
                                :options="$specializations->pluck('name', 'id')->toArray()"
                                placeholder="{{ __('Press to select') }}"
                                required
                            />
                            <x-forms.select
                                name="classification_id"
                                label="{{ __('classification') }}"
                                :model="$doctor"
                                :options="$classifications->pluck('name', 'id')->toArray()"
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
