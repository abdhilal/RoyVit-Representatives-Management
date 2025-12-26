@extends('layouts.app')
@section('title')
    {{ __('Classification List') }}
@endsection
@section('breadcrumb')
    {{ __('Classification') }}
@endsection
@section('breadcrumbActive')
    {{ __('Classification List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('super-admin')
                            <x-buttons.create :action="route('classifications.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Classification Name') }}</th>
                                    <th>{{ __('Warehouse') }}</th>

                                    @canany(['super-admin'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classifications as $index => $classification)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $classification->name }}</td>
                                        <td>{{ $classification->warehouse->name ?? __('No warehouse') }}</td>

                                        @canany(['super-admin'])
                                            <td>
                                                @can('show-classifications')
                                                    <x-buttons.show :action="route('classifications.show', $classification)" />
                                                @endcan
                                                @can('update-classifications')
                                                    <x-buttons.edit :action="route('classifications.edit', $classification)" />
                                                @endcan
                                                @can('delete-classifications')
                                                    <x-buttons.delete-form :action="route('classifications.destroy', $classification)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-classifications') || auth()->user()->can('update-classifications') || auth()->user()->can('delete-classifications')) ? 5 : 4 }}">
                                            {{ __('No classifications found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($classifications->count())
                                <x-table.tfoot :page="$classifications" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($classifications->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $classifications])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
