@extends('layouts.app')
@section('title')
    {{ __('Representative Stores List') }}
@endsection
@section('breadcrumb')
    {{ __('Representative Stores') }}
@endsection
@section('breadcrumbActive')
    {{ __('Representative Stores List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('create-representative_stores')
                            <x-buttons.create :action="route('representativeStores.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Representative') }}</th>

                                    @canany(['show-representative_stores', 'update-representative_stores', 'delete-representative_stores'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($representativeStores as $index => $representativeStore)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td><a href="{{ route('representativeStores.show', $representativeStore->id) }}">{{ $representativeStore->name }}</a></td>


                                        @canany(['show-representative_stores', 'update-representative_stores', 'delete-representative_stores'])
                                            <td>
                                                @can('show-representative_stores')
                                                    <x-buttons.show :action="route('representativeStores.show', $representativeStore)" />
                                                @endcan
                                                @can('update-representative_stores')
                                                    <x-buttons.edit :action="route('representativeStores.edit', $representativeStore)" />
                                                @endcan
                                                @can('delete-representative_stores')
                                                    <x-buttons.delete-form :action="route('representativeStores.destroy', $representativeStore)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-representative_stores') || auth()->user()->can('update-representative_stores') || auth()->user()->can('delete-representative_stores')) ? 9 : 8 }}">
                                            {{ __('No representative stores found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($representativeStores->count())
                                <x-table.tfoot :page="$representativeStores" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($representativeStores->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $representativeStores])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
