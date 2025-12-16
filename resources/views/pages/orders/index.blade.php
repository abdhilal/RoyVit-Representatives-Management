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
            <x-cards.container>
                <x-cards.card
                    :value="$ordersCount"
                    label="{{ __('Total Orders') }}"
                    icon="list"
                    roundColor="primary"
                    onclick="window.location.href='{{ route('orders.index') }}'"
                    style="cursor:pointer"
                />
                <x-cards.card
                    :value="$ordersCountPending"
                    label="{{ __('Pending Orders') }}"
                    icon="clock"
                    roundColor="warning"
                    onclick="window.location.href='{{ route('orders.index', ['status' => \App\Enums\OrderStatuses::PENDING->value]) }}'"
                    style="cursor:pointer"
                />
                <x-cards.card
                    :value="$ordersCountAccepted"
                    label="{{ __('Accepted Orders') }}"
                    icon="check-circle"
                    roundColor="success"
                    onclick="window.location.href='{{ route('orders.index', ['status' => \App\Enums\OrderStatuses::ACCEPTED->value]) }}'"
                    style="cursor:pointer"
                />
                <x-cards.card
                    :value="$ordersCountCancelled"
                    label="{{ __('Cancelled Orders') }}"
                    icon="x-circle"
                    roundColor="danger"
                    onclick="window.location.href='{{ route('orders.index', ['status' => \App\Enums\OrderStatuses::CANCELLED->value]) }}'"
                    style="cursor:pointer"
                />
            </x-cards.container>
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
                                        <td>
                                            @php
                                                $status = $order->status;
                                                $badgeClass = match ($status) {
                                                    'pending' => 'badge bg-warning text-dark',
                                                    'accepted' => 'badge bg-success',
                                                    'cancelled' => 'badge bg-danger',
                                                    default => 'badge bg-secondary',
                                                };
                                            @endphp
                                            <span class="{{ $badgeClass }}">
                                                {{ \App\Enums\OrderStatuses::fromString($status)?->label() ?? __($status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                        @canany(['show-orders', 'update-orders', 'delete-orders'])
                                            <td>
                                                @can('show-orders')
                                                    <x-buttons.show :action="route('orders.show', $order)" />
                                                @endcan
                                                @if ($order->status === \App\Enums\OrderStatuses::PENDING->value or auth()->user()->hasRole('super-admin'))
                                                    @can('update-orders')
                                                        <x-buttons.edit :action="route('orders.edit', $order)" />
                                                    @endcan
                                                    @can('delete-orders')
                                                        <x-buttons.delete-form :action="route('orders.destroy', $order)" />
                                                    @endcan
                                                @endif

                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-orders') || auth()->user()->can('update-orders') || auth()->user()->can('delete-orders')) ? 5 : 4 }}">
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
