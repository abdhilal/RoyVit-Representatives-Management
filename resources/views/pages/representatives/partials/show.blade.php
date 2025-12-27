@extends('layouts.app')
@section('title')
    {{ __('Representative Details') }}
@endsection
@section('breadcrumb')
    {{ __('Representatives') }}
@endsection
@section('breadcrumbActive')
    {{ __('Representative Details') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $representative->name ?? '-' }}</h5>
                    <x-buttons.back :action="route('representatives.index')" />
                </div>
                <div class="card-body">

                    <x-cards.container>
                        <x-cards.card :value="$representative->name ?? '-'" label="{{ __('Name') }}" icon="user" roundColor="primary" />
                        <x-cards.card :value="$representative->email ?? '-'" label="{{ __('Email') }}" icon="mail" roundColor="info" />
                        <x-cards.card :value="($representative->is_active ?? 0) ? __('Active') : __('Inactive')" label="{{ __('Status') }}" icon="check-circle" roundColor="success" />
                        <x-cards.card :value="$representative->doctors_count ?? 0" label="{{ __('Associated doctors') }}" icon="users" roundColor="secondary" />
                        <x-cards.card :value="$representative->specializations_count ?? 0" label="{{ __('Specializations') }}" icon="list" roundColor="dark" />
                        <x-cards.card :value="$representative->total_visits_count ?? 0" label="{{ __('Total Visits') }}" icon="calendar" roundColor="warning" />
                        <x-cards.card :value="$representative->visited_doctors_count ?? 0" label="{{ __('Visited This Month') }}" icon="calendar" roundColor="primary" />
                        <x-cards.card :value="optional($representative->created_at)->format('Y-m-d') ?? '-'" label="{{ __('Created At') }}" icon="clock" roundColor="info" />
                    </x-cards.container>

                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ __('Specializations') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Associated Specializations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($specs = isset($specializations) ? $specializations : collect())
                                        @forelse($specs as $index => $spec)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $spec->name ?? '-' }}</td>
                                                <td>{{ $spec->doctors_count ?? 0 }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">{{ __('No specializations found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
