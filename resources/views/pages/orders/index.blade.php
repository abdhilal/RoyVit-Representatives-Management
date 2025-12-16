@extends('layouts.app')
@section('title')
    {{ __('Orders List') }}
@endsection
@section('breadcrumb')
    {{ __('Orders') }}
@endsection
@section('breadcrumbActive')
    {{ __('Orders List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('create-orders')
                            <x-buttons.create :action="route('orders.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('representative') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('created at') }}</th>

                                    @canany(['show-orders', 'update-orders', 'delete-orders'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->title }}</td>
                                        <td>{{ $order->representative->name }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                        @canany(['show-orders', 'update-orders', 'delete-orders'])
                                            <td>
                                                @can('show-orders')
                                                    <x-buttons.show :action="route('orders.show', $order)" />
                                                @endcan
                                                @can('update-orders')
                                                    <x-buttons.edit :action="route('orders.edit', $order)" />
                                                @endcan
                                                @can('delete-orders')
                                                    <x-buttons.delete-form :action="route('orders.destroy', $order)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user() && (auth()->user()->can('show-orders') || auth()->user()->can('update-orders') || auth()->user()->can('delete-orders')) ? 5 : 4 }}">
                                            {{ __('No orders found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($orders->count())
                                <x-table.tfoot :page="$orders" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($orders->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $orders])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
