@extends('layouts.app')
@php
    $isEdit = isset($product) && $product->exists;
    $title = $isEdit ? __('Edit Product') : __('Add New Product');
    $action = $isEdit ? route('products.update', $product) : route('products.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Products') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit Product') : __('Add New Product') }}
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
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$product" required />

                            <x-forms.select name="type" label="{{ __('products type') }}" :model="$product"
                                :options="$productsTypes" placeholder="{{ __('Press to select') }}" required />
                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                {{-- <x-buttons.cancel route="products.type.index" :params="['type' => $product->type]" /> --}}
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
