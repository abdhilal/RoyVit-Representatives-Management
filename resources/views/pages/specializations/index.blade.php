@extends('layouts.app')
@section('title')
    {{ __('Specialization List') }}
@endsection
@section('breadcrumb')
    {{ __('Specialization') }}
@endsection
@section('breadcrumbActive')
    {{ __('Specialization List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('create-specializations')
                            <x-buttons.create :action="route('specializations.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Specialization Name') }}</th>
                                    <th>{{ __('Warehouse') }}</th>

                                    @canany(['show-specializations', 'update-specializations', 'delete-specializations'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($specializations as $index => $specialization)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $specialization->name }}</td>
                                        <td>{{ $specialization->warehouse->name??__('No warehouse') }}</td>

                                        @canany(['show-specializations', 'update-specializations', 'delete-specializations'])
                                            <td>
                                                @can('show-specializations')
                                                    <x-buttons.show :action="route('specializations.show', $specialization)" />
                                                @endcan
                                                @can('update-specializations')
                                                    <x-buttons.edit :action="route('specializations.edit', $specialization)" />
                                                @endcan
                                                @can('delete-specializations')
                                                    <x-buttons.delete-form :action="route('specializations.destroy', $specialization)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-specializations') || auth()->user()->can('update-specializations') || auth()->user()->can('delete-specializations')) ? 5 : 4 }}">
                                            {{ __('No specializations found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($specializations->count())
                                <x-table.tfoot :page="$specializations" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($specializations->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $specializations])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
