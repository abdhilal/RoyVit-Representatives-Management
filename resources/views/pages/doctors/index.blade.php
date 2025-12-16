@extends('layouts.app')
@section('title')
    {{ __('Doctors List') }}
@endsection
@section('breadcrumb')
    {{ __('Doctors') }}
@endsection
@section('breadcrumbActive')
    {{ __('Doctors List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="doctors.index" placeholder="{{ __('search doctors by name or address') }}"
                            col="5" />
                        @can('create-doctors')
                            <x-buttons.create :action="route('doctors.create')" />
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
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Area') }}</th>
                                    <th>{{ __('Classification') }}</th>
                                    <th>{{ __('Representative') }}</th>

                                    @canany(['show-doctors', 'update-doctors', 'delete-doctors'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($doctors as $index => $doctor)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->address }}</td>
                                        <td>{{ $doctor->area->name ?? __('No area') }}</td>
                                        <td>{{ $doctor->classification->name ?? __('No classification') }}</td>
                                        <td>{{ $doctor->representative->name ?? __('No representative') }}</td>

                                        @canany(['show-doctors', 'update-doctors', 'delete-doctors'])
                                            <td>
                                                @can('show-doctors')
                                                    <x-buttons.show :action="route('doctors.show', $doctor)" />
                                                @endcan
                                                @can('update-doctors')
                                                    <x-buttons.edit :action="route('doctors.edit', $doctor)" />
                                                @endcan
                                                @can('delete-doctors')
                                                    <x-buttons.delete-form :action="route('doctors.destroy', $doctor)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-doctors') || auth()->user()->can('update-doctors') || auth()->user()->can('delete-doctors')) ? 9 : 8 }}">
                                            {{ __('No doctors found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($doctors->count())
                                <x-table.tfoot :page="$doctors" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($doctors->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $doctors])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
