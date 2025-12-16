@extends('layouts.app')
@section('title')
    {{ __('Invoice Details') }}
@endsection
@section('breadcrumb')
    {{ __('Invoices') }}
@endsection
@section('breadcrumbActive')
    {{ __('Invoice Details') }}
@endsection
@section('content')
    <div class="container invoice-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table-wrapper table-responsive table-borderless theme-scrollbar" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table-responsive table-borderless"
                                            style="width: 100%; background-image: url('/assets/images/email-template/invoice-3/bg-0.png'); background-position: center; background-size:cover; background-repeat:no-repeat; border-radius: 10px;">
                                            <tbody>
                                                <tr>


                                                    <td style="padding: 30px 0;">

                                                        <div style="margin-right: 15px">
                                                            <span
                                                                style="display:block; line-height: 1.5; font-size:16px; color: #fff; font-weight:700;">{{ __('Invoice') }}</span>
                                                            <span
                                                                style="display:block; line-height: 1.5; font-size:16px; color: #fff; font-weight:500;">{{ __('Receipt') }} : {{ $invoice->number }}</span>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="table-responsives table-borderless" style="width: 100%;">
                                            <tbody>
                                                <tr style="padding: 28px 0; display: flex; justify-content: space-between;">
                                                    <td>
                                                        <span
                                                            style=" font-size: 16px; font-weight: 500; opacity: 0.8;">{{ __('Sender') }}</span>
                                                        <h4
                                                            style="font-weight:600; margin: 12px 0 5px 0; font-size: 16px; color: rgba(48, 142, 135, 1);">
                                                            {{ $invoice->sender->name ?? '-' }}</h4>
                                                        <span
                                                            style="line-height:2;  font-size: 16px; font-weight: 400;opacity: 0.8;">{{ __('Warehouse') }}:
                                                            {{ $invoice->warehouse->name ?? '-' }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            style="font-size: 16px; font-weight: 500;opacity: 0.8;">{{ __('Receiver') }}</span>
                                                        <h4
                                                            style="font-weight:600; margin: 12px 0 5px 0; font-size: 16px; color: rgba(48, 142, 135, 1);">
                                                            {{ $invoice->receiver->name ?? '-' }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <span
                                            style="display:block; background: rgba(82, 82, 108, 0.3); height:1px; width: 100%; margin-bottom:20px;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="width: 100%;border-spacing:0;">
                                            <thead>
                                                <tr style="background: #308e87;">
                                                    <th style="padding: 18px 15px; "><span
                                                            style="color: #fff; font-size: 16px; font-weight: 600;">{{ __('product') }}</span>
                                                    </th>
                                                    <th style="padding: 18px 15px; "><span
                                                            style="color: #fff; font-size: 16px; font-weight: 600;">{{ __('Qty') }}</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invoice->invoiceItems as $item)
                                                    <tr>
                                                        <td
                                                            style="padding: 18px 15px 18px 0; display:flex; align-items: center; gap: 10px; border-bottom:1px solid #52526C4D;">
                                                            <span
                                                                style="width: 3px; height: 37px; background-color:#308e87;"></span>
                                                            <ul style="padding: 0; margin: 0; list-style: none;">
                                                                <li>
                                                                    <h4
                                                                        style="font-weight:600; margin:4px 0px; font-size: 16px; color: #308e87;">
                                                                        {{ $item->product->name ?? '-' }}</h4>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td
                                                            style="padding: 18px 15px; width: 12%; text-align: center; border-bottom:1px solid #52526C4D;">
                                                            <span style=" opacity: 0.8;">{{ $item->quantity }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    @php $totalQty = $invoice->invoiceItems->sum('quantity'); @endphp
                                    <td>
                                        <table style="width:100%;">
                                            <tbody>
                                                <tr
                                                    style="display:flex; justify-content: space-between; margin:28px 0; align-items: center;">
                                                    <td>
                                                        <span
                                                            style=" font-size: 16px; font-weight: 500; opacity: 0.8; font-weight: 600;">{{ __('Warehouse') }}</span>
                                                        <h4
                                                            style="font-weight:600; margin: 12px 0 5px 0; font-size: 16px; color:#308e87;">
                                                            {{ $invoice->warehouse->name ?? '-' }}</h4>
                                                    </td>
                                                    <td>
                                                        <span
                                                            style=" font-size: 16px; font-weight: 500; opacity: 0.8; font-weight: 600;">{{ __('Total quantity') }}</span>
                                                        <h4
                                                            style="font-weight:600; margin: 12px 0 5px 0; font-size: 26px; color:#308e87;">
                                                            {{ $totalQty }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <span
                                            style="display:block;background: rgba(82, 82, 108, 0.3);height: 1px;width: 100%;margin-bottom:30px;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2 d-print-none">
                                            <x-buttons.print text="Print Invoice" class="btn btn-primary" />
                                            <x-buttons.back :action="route('invoices.index')" text="Back"
                                                class="btn btn-outline-secondary" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
