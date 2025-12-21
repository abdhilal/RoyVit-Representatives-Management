@extends('layouts.app')
@section('title')
    {{ __('Plan Details') }}
@endsection
@section('breadcrumb')
    {{ __('Plans') }}
@endsection
@section('breadcrumbActive')
    {{ __('Plan Details') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $plan->name }}</h5>
                    <x-buttons.back :action="route('plans.index')" text="Back" />
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ __('Date') }}:</strong>
                        <span>{{ $plan->visitPeriod->month ?? '-' }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Specialization') }}</th>
                                    <th>{{ __('Product') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plan->planItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->specialization->name ?? '-' }}</td>
                                        <td>{{ $item->product->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">{{ __('No products found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
