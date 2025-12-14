@extends('layouts.app')
@section('title')
    {{ __('Warehouses List') }}
@endsection
@section('breadcrumb')
    {{ __('Warehouses') }}
@endsection
@section('breadcrumbActive')
    {{ __('Warehouses List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('create-warehouses')
                            <x-buttons.create :action="route('warehouses.create')" />
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
                                    <th>{{ __('location') }}</th>
                                    <th>{{ __('associated users') }}</th>

                                    @canany(['show-warehouses', 'update-warehouses', 'delete-warehouses'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouses as $warehouse)
                                    <tr>
                                        <td>{{ $warehouse->id }}</td>
                                        <td>{{ $warehouse->name }}</td>
                                        <td>{{ $warehouse->location }}</td>
                                        <td>
                                            @if ($warehouse->users)
                                                {{ $warehouse->users->count() }}
                                            @else
                                                <span class="badge bg-secondary">{{ __('No user assigned') }}</span>
                                            @endif
                                        </td>
                                        @canany(['show-warehouses', 'update-warehouses', 'delete-warehouses'])
                                            <td>
                                                @can('show-warehouses')
                                                    <x-buttons.show :action="route('warehouses.show', $warehouse)" />
                                                @endcan
                                                @can('update-warehouses')
                                                    <x-buttons.edit :action="route('warehouses.edit', $warehouse)" />
                                                @endcan
                                                @can('delete-warehouses')
                                                    <x-buttons.delete-form :action="route('warehouses.destroy', $warehouse)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ (auth()->user() && (auth()->user()->can('show-warehouses') || auth()->user()->can('update-warehouses') || auth()->user()->can('delete-warehouses'))) ? 5 : 4 }}">{{ __('No warehouses found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                                @if ($warehouses->count())
                                    <x-table.tfoot :page="$warehouses" />
                                @endif
                            </table>
                        </div>
                    </div>
                    @if ($warehouses->count())
                        <div class="card-footer">
                            @include('layouts.partials.pagination', ['page' => $warehouses])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
