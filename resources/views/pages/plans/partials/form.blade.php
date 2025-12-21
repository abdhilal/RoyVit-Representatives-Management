@extends('layouts.app')
@php
    $isEdit = isset($plan) && $plan->exists;
    $title = $isEdit ? __('Edit Plan') : __('Add New Plan');
    $action = $isEdit ? route('plans.update', $plan) : route('plans.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Plans') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Plan') : __('Add New Plan') }}
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
                            <x-forms.input name="name" label="{{ __('Plan name') }}" :model="$plan" required />

                            @foreach ($data['specializations'] as $index => $specialization)

                                <span class="text-success">{{ $index + 1 }}</span>
                                <x-forms.input class="border-2 text-center bg-secondary text-white" name="specializations_name[]" value="{{ $specialization->name }}"
                                    label="{{ __('Specialization') }}" :model="$plan" readonly col="6" />
                                <input type="hidden" name="specializations_id[]" value="{{ $specialization->id }}">
                                <x-forms.select class="border-2 text-center"  name="product_id[]" label="{{ __('product') }}" :model="$plan"
                                    :options="$data['products']->pluck('name', 'id')->toArray()" placeholder="{{ __('Press to select') }}" required col="6" />
                                <hr class="my-4 border-2 ">
                            @endforeach


                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="plans.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
