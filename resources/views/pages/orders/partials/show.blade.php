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
                    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap" style="gap: 12px;">
                        <div style="min-width: 220px;">
                            <span
                                style="font-size: 14px; font-weight: 500; opacity: 0.8; color: var(--body-font-color);">{{ __('Sender') }}</span>
                            <h4 style="font-weight:600; margin: 8px 0 0 0; font-size: 14px; color: var(--theme-default);">
                                {{ $order->representative->name ?? '-' }}
                            </h4>
                        </div>
                        <div
                            style="line-height:2; font-size: 12px; opacity: 0.8; color: var(--body-font-color); min-width: 220px;">
                            <div>{{ __('Warehouse') }}: {{ $order->warehouse->name ?? '-' }}</div>
                            <div>{{ __('Created At') }}: {{ $order->created_at->format('Y-m-d') }}</div>
                        </div>
                        <div
                            style="line-height:1.8; font-size: 12px; opacity: 0.8; color: var(--body-font-color); min-width: 260px;">
                            <div>{{ __('Phone') }}:
                                {{ optional($order->representative->userInformations)->phone ?? __('-') }}</div>
                            <div>{{ __('Address') }}:
                                {{ optional($order->representative->userInformations)->state ?? __('-') }}
                                -{{ optional($order->representative->userInformations)->city ?? __('-') }}
                                <span style="display:block; color: var(--body-font-color);">
                                    {{ optional($order->representative->userInformations)->address ?? __('-') }}
                                </span>
                            </div>
                        </div>
                        @php
                            $status = $order->status;
                            $badgeClass = match ($status) {
                                'pending' => 'badge bg-warning text-dark',
                                'accepted' => 'badge bg-success',
                                'cancelled' => 'badge bg-danger',
                                default => 'badge bg-secondary',
                            };
                        @endphp


                    </div>







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
                                            <td>
                                                <span class="{{ $badgeClass }}">
                                                    {{ \App\Enums\OrderStatuses::fromString($status)?->label() ?? __($status) }}
                                                </span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">{{ __('No order data to display') }}</p>
                        @endif
                    @endisset
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        @if ($order->status === 'pending')
                            @can('accept-orders')
                                <form method="POST" action="{{ route('orders.accept', $order) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">{{ __('Accept Order') }}</button>
                                </form>
                            @endcan
                            @can('reject-orders')
                                <form method="POST" action="{{ route('orders.reject', $order) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">{{ __('Reject Order') }}</button>
                                </form>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
