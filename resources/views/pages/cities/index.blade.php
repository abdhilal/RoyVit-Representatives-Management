@extends('layouts.app')
@section('title')
    {{ __('Cities List') }}
@endsection
@section('breadcrumb')
    {{ __('Cities') }}
@endsection
@section('breadcrumbActive')
    {{ __('Cities List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('create-cities')
                            <x-buttons.create :action="route('cities.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('associated areas') }}</th>

                                    @canany(['show-cities', 'update-cities', 'delete-cities'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cities as $index => $city)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>{{ $city->areas->count() }}</td>

                                        @canany(['show-cities', 'update-cities', 'delete-cities'])
                                            <td>
                                                @can('show-cities')
                                                    <x-buttons.show :action="route('cities.show', $city)" />
                                                @endcan
                                                @can('update-cities')
                                                    <x-buttons.edit :action="route('cities.edit', $city)" />
                                                @endcan
                                                @can('delete-cities')
                                                    <x-buttons.delete-form :action="route('cities.destroy', $city)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-cities') || auth()->user()->can('update-cities') || auth()->user()->can('delete-cities')) ? 5 : 4 }}">
                                            {{ __('No cities found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($cities->count())
                                <x-table.tfoot :page="$cities" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($cities->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $cities])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
