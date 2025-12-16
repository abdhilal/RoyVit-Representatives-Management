@extends('layouts.app')
@section('title')
    {{ __('Invoices List') }}
@endsection
@section('breadcrumb')
    {{ __('Invoices') }}
@endsection
@section('breadcrumbActive')
    {{ __('Invoices List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @can('create-invoices')
                            <x-buttons.create :action="route('invoices.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Invoice Number') }}</th>
                                    <th>{{ __('Sender') }}</th>
                                    <th>{{ __('Receiver') }}</th>
                                    <th>{{ __('Products Number') }}</th>
                                    <th>{{ __('Note') }}</th>
                                    @canany(['show-invoices', 'update-invoices', 'delete-invoices'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $index => $invoice)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->number }}</a></td>
                                        <td>{{ $invoice->sender->name }}</td>
                                        <td>{{ $invoice->receiver->name }}</td>
                                        <td>{{ $invoice->invoice_items_count }}</td>
                                        <td>{{ $invoice->note ?? '-' }}</td>


                                        @canany(['show-invoices', 'update-invoices', 'delete-invoices'])
                                            <td>
                                                @can('show-invoices')
                                                    <x-buttons.show :action="route('invoices.show', $invoice)" />
                                                @endcan
                                                @can('update-invoices')
                                                    <x-buttons.edit :action="route('invoices.edit', $invoice)" />
                                                @endcan
                                                @can('delete-invoices')
                                                    <x-buttons.delete-form :action="route('invoices.destroy', $invoice)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-invoices') || auth()->user()->can('update-invoices') || auth()->user()->can('delete-invoices')) ? 9 : 8 }}">
                                            {{ __('No invoices found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($invoices->count())
                                <x-table.tfoot :page="$invoices" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($invoices->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $invoices])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
