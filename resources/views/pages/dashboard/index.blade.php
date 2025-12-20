@extends('layouts.app')
@section('title')
    {{ __('dashboard') }}
@endsection
@section('breadcrumb')
    {{ __('dashboard') }}
@endsection
@section('breadcrumbActive')
    {{ __('dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-cards.container>
                <x-cards.card :value="$stats['users_total'] ?? 0" label="{{ __('Users') }}" icon="users" roundColor="primary" />
                <x-cards.card :value="$stats['doctors_total'] ?? 0" label="{{ __('Doctors') }}" icon="user" roundColor="info" />
                <x-cards.card :value="$stats['products_total'] ?? 0" label="{{ __('Products') }}" icon="package" roundColor="secondary" />
                <x-cards.card :value="$stats['files_total'] ?? 0" label="{{ __('Files') }}" icon="file-text" roundColor="dark" />
            </x-cards.container>

            <x-cards.container>
                <x-cards.card :value="$stats['orders_total'] ?? 0" label="{{ __('Orders') }}" icon="shopping-cart" roundColor="primary" />
                <x-cards.card :value="$stats['orders_pending'] ?? 0" label="{{ __('Pending Orders') }}" icon="clock" roundColor="warning" />
                <x-cards.card :value="$stats['orders_accepted'] ?? 0" label="{{ __('Accepted Orders') }}" icon="check-circle" roundColor="success" />
                <x-cards.card :value="$stats['orders_cancelled'] ?? 0" label="{{ __('Cancelled Orders') }}" icon="x-circle" roundColor="danger" />
            </x-cards.container>

            <x-cards.container>
                <x-cards.card :value="$stats['visits_total'] ?? 0" label="{{ __('Doctor Visits') }}" icon="list" roundColor="primary" />
                <x-cards.card :value="$stats['visits_month'] ?? 0" label="{{ __('This Month') }}" icon="calendar" roundColor="warning" />
                <x-cards.card :value="$stats['visits_with_evidence'] ?? 0" label="{{ __('With Evidence') }}" icon="image" roundColor="success" />
                <x-cards.card :value="$stats['visits_without_evidence'] ?? 0" label="{{ __('Without Evidence') }}" icon="x-circle" roundColor="danger" />
            </x-cards.container>

            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Operations') }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @can('create-doctor_visits')
                            <a href="{{ route('doctorVisits.create') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-stethoscope me-1"></i>{{ __('Add New Doctor Visit') }}
                            </a>
                        @endcan
                        @can('create-doctors')
                            <a href="{{ route('doctors.create') }}" class="btn btn-outline-success btn-sm">
                                <i class="fa-solid fa-user-doctor me-1"></i>{{ __('Add New Doctor') }}
                            </a>
                        @endcan
                        @can('create-orders')
                            <a href="{{ route('orders.create') }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa-solid fa-cart-plus me-1"></i>{{ __('Add New Order') }}
                            </a>
                        @endcan
                        @can('create-files')
                            <a href="{{ route('files.create') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa-solid fa-upload me-1"></i>{{ __('Upload File') }}
                            </a>
                        @endcan
                        <a href="{{ route('representativeStores.onlyshow') }}" class="btn btn-outline-info btn-sm">
                            <i class="fa-solid fa-warehouse me-1"></i>{{ __('My storehouse') }}
                        </a>
                        <a href="{{ route('doctorVisits.index') }}" class="btn btn-outline-dark btn-sm">
                            <i class="fa-solid fa-list me-1"></i>{{ __('Doctor Visits') }}
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-dark btn-sm">
                            <i class="fa-solid fa-truck me-1"></i>{{ __('Orders') }}
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-dark btn-sm">
                            <i class="fa-solid fa-users me-1"></i>{{ __('Users') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
