@extends('layouts.app')
@php
    $isEdit = isset($order) && $order->exists;
    $title = $isEdit ? __('Edit Order') : __('Add New Order');
    $action = $isEdit ? route('orders.update', $order) : route('orders.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Orders') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Order') : __('Add New Order') }}
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
                            <x-forms.input name="title" label="{{ __('title') }}" :model="$order" required />
                            <x-forms.textarea name="description" label="{{ __('description') }}" :model="$order"
                                required />

                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="orders.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
