@extends('layouts.app')
@section('title')
    {{ __('Upload Tree Products') }}
@endsection

@section('breadcrumb')
    {{ __('Files') }}
@endsection
@section('breadcrumbActive')
    {{ __('add new') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Upload Tree Products') }}</h5>
                    </div>
                    <div class="card-body">
                        <x-forms.form :action="route('TreeProducts.store')" method="POST" enctype="multipart/form-data" class="row g-3"
                            novalidate>

                            <x-forms.input name="name" label="{{ __('name') }}" :model="$file" required />

                            <x-forms.input name="file" type="file" label="{{ __('File') }}" required col="12"
                                accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                            </div>
                        </x-forms.form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
