@extends('layouts.app')
@section('title')
    {{ __('Order Details') }}
@endsection
@section('breadcrumb')
    {{ __('Orders') }}
@endsection
@section('breadcrumbActive')
    {{ __('Order Details') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end align-items-center">
                    <div>
                        @can('update-orders')
                            @isset($order)
                                <x-buttons.edit :action="route('orders.edit', $order)" />
                            @endisset
                        @endcan

                        <x-buttons.back :action="route('orders.index')" />
                    </div>
                </div>

                <div class="card-body">

                    <div>{{ __('sender') }}</div>
                    <div>{{ $order->representative->name }}</div>







                    @isset($order)
                        @if ($order->exists)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 200px">#</th>
                                            <td>{{ $order->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('title') }}</th>
                                            <td>{{ $order->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('description') }}</th>
                                            <td>{{ $order->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('created at') }}</th>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('status') }}</th>
                                            <td>{{ $order->status }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">{{ __('No order data to display') }}</p>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
