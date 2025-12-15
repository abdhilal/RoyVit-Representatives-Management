@extends('layouts.app')
@section('title')
    {{ __('Products List') }}
@endsection
@section('breadcrumb')
    {{ __('Products') }}
@endsection
@section('breadcrumbActive')
    {{ __('Products List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('type') }}</th>

                                    @canany(['show-products', 'update-products', 'delete-products'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ __($product->type) }}</td>

                                        @canany(['show-products', 'update-products', 'delete-products'])
                                            <td>
                                                @can('show-products')
                                                    <x-buttons.show :action="route('products.show', $product)" />
                                                @endcan
                                                @can('update-products')
                                                    <x-buttons.edit :action="route('products.edit', $product)" />
                                                @endcan
                                                @can('delete-products')
                                                    <x-buttons.delete-form :action="route('products.destroy', $product)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-products') || auth()->user()->can('update-products') || auth()->user()->can('delete-products')) ? 5 : 4 }}">
                                            {{ __('No products found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($products->count())
                                <x-table.tfoot :page="$products" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($products->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $products])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
