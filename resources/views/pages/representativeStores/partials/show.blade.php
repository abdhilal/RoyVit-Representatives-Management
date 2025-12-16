@extends('layouts.app')
@section('title')
    {{ __('My storehouse') }}
@endsection
@section('breadcrumb')
    {{ __('My storehouse') }}
@endsection
@section('breadcrumbActive')
    {{ __('My storehouse') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (!isset($id))
                        <x-search-form route="representativeStores.onlyshow"
                            placeholder="{{ __('search products by name or type') }}" col="7" />
                    @else
                        <x-search-form route="representativeStores.show" params="{{ $id }}"
                            placeholder="{{ __('search products by name or type') }}" col="7" />
                    @endif
                </div>
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped">


                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Type') }}</th>

                                    @canany(['update-representative_stores', 'delete-representative_stores'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($representativeStores as $index => $representativeStore)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>{{ $representativeStore->product->name }}</td>
                                        <td>{{ $representativeStore->quantity }}</td>
                                        <td>{{ __($representativeStore->product->type) }}</td>




                                        @canany(['update-representative_stores', 'delete-representative_stores'])
                                            <td>

                                                @can('update-representative_stores')
                                                    <x-buttons.edit :action="route('representativeStores.edit', $representativeStore)" />
                                                @endcan
                                                @can('delete-representative_stores')
                                                    <x-buttons.delete-form :action="route(
                                                        'representativeStores.destroy',
                                                        $representativeStore,
                                                    )" />
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
