@extends('layouts.app')
@section('title')
    {{ __('Areas List') }}
@endsection
@section('breadcrumb')
    {{ __('Areas') }}
@endsection
@section('breadcrumbActive')
    {{ __('Areas List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="areas.index" placeholder="{{ __('search areas by name or city') }}"
                            col="4" />
                        @can('create-areas')
                            <x-buttons.create :action="route('areas.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('City') }}</th>
                                    <th>{{ __('Associated doctors') }}</th>

                                    @canany(['show-areas', 'update-areas', 'delete-areas'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($areas as $index => $area)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $area->name }}</td>
                                        <td>{{ $area->city->name??__('No city') }}</td>
                                        <td>{{ $area->doctors_count }}</td>

                                        @canany(['show-areas', 'update-areas', 'delete-areas'])
                                            <td>
                                                @can('show-areas')
                                                    <x-buttons.show :action="route('areas.show', $area)" />
                                                @endcan
                                                @can('update-areas')
                                                    <x-buttons.edit :action="route('areas.edit', $area)" />
                                                @endcan
                                                @can('delete-areas')
                                                    <x-buttons.delete-form :action="route('areas.destroy', $area)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-areas') || auth()->user()->can('update-areas') || auth()->user()->can('delete-areas')) ? 5 : 4 }}">
                                            {{ __('No areas found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($areas->count())
                                <x-table.tfoot :page="$areas" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($areas->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $areas])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
