@extends('layouts.app')
@section('title')
    {{ __('Doctor Visits') }}
@endsection
@section('breadcrumb')
    {{ __('Doctor Visits') }}
@endsection
@section('breadcrumbActive')
    {{ __('doctor visit') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Doctor Visits') }}</h5>
                    <x-buttons.back :action="route('doctorVisits.index')" />
                </div>
                <div class="card-body">
                    <x-cards.container>
                        <x-cards.card :value="$doctorVisit->doctor->name ?? '-'" label="{{ __('Doctor') }}" icon="user" roundColor="primary" />
                        <x-cards.card :value="$doctorVisit->representative->name ?? '-'" label="{{ __('Representative') }}" icon="users" roundColor="info" />
                        <x-cards.card :value="$doctorVisit->visit_date->format('Y-m-d H') ?? '-'" label="{{ __('Visit Date') }}" icon="calendar" roundColor="warning" />
                        <x-cards.card :value="$doctorVisit->period->month ?? '-'" label="{{ __('month') }}" icon="calendar" roundColor="secondary" />
                        <x-cards.card :value="$doctorVisit->samples->count()" label="{{ __('Products Number') }}" icon="list" roundColor="dark" />
                        <x-cards.card :value="$doctorMonthCount" label="{{ __('This Month') }}" icon="calendar" roundColor="success" />
                    </x-cards.container>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('Attachment') }}
                                </div>
                                <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 160px;">
                                    @if (!empty($doctorVisit->image_url))
                                        <img src="{{ $doctorVisit->image_url }}" alt="{{ __('Attachment') }}"
                                            style="max-width:100%;max-height:140px;object-fit:cover;border-radius:6px;">
                                    @else
                                        <span class="badge bg-danger rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width:48px;height:48px;">
                                            <i class="fa-solid fa-circle-xmark text-white" style="font-size:22px;"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('Visit Items') }}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Product') }}</th>
                                                    <th>{{ __('Quantity') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($doctorVisit->samples as $index => $sample)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $sample->product->name ?? '-' }}</td>
                                                        <td>{{ $sample->quantity ?? '-' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">{{ __('No products found') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        <strong>{{ __('Note') }}:</strong>
                                        <span>{{ $doctorVisit->notes ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
