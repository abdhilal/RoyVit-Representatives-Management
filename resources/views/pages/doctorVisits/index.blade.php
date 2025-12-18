@extends('layouts.app')
@section('title')
    {{ __('Doctor Visits') }}
@endsection
@section('breadcrumb')
    {{ __('Doctor Visits') }}
@endsection
@section('breadcrumbActive')
    {{ __('Doctor Visits') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <x-cards.container>
                <x-cards.card :value="$data['totalVisits'] ?? 0" label="{{ __('Total Visits') }}" icon="list" roundColor="primary"
                    onclick="window.location.href='{{ route('doctorVisits.index') }}'" style="cursor:pointer" />
                <x-cards.card :value="$data['totalVisitsIsMonth'] ?? 0" label="{{ __('This Month') }}" icon="calendar" roundColor="warning"
                    onclick="window.location.href='{{ route('doctorVisits.index', ['month' => request('month') ?? now()->format('Y-m')]) }}'"
                    style="cursor:pointer" />
                <x-cards.card :value="$data['totalVisitsIsHasImage'] ?? 0" label="{{ __('With Evidence') }}" icon="image" roundColor="success"
                    onclick="window.location.href='{{ route('doctorVisits.index', ['month' => request('month') ?? now()->format('Y-m'), 'has_image' => 1]) }}'"
                    style="cursor:pointer" />
                <x-cards.card :value="$data['totalVisitsIsNotHasImage'] ?? 0" label="{{ __('Without Evidence') }}" icon="x-circle" roundColor="danger"
                    onclick="window.location.href='{{ route('doctorVisits.index', ['month' => request('month') ?? now()->format('Y-m'), 'has_image' => 0]) }}'"
                    style="cursor:pointer" />
            </x-cards.container>
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px;">
                        <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">

                            <x-forms.form action="{{ route('doctorVisits.index') }}" method="GET"
                                class="d-flex align-items-end flex-wrap gap-2">



                                <div class="me-2">
                                    <label class="form-label mb-0 small ">{{ __('Filter by month') }}</label>
                                    <select id="monthSelect" class="form-select form-select-sm " name="month"
                                        onchange="this.form.submit()">
                                        <option value="" {{ !request('month') ? 'selected' : '' }}>
                                            {{ __('All Months') }}</option>
                                        @foreach ($data['months'] ?? [] as $month)
                                            <option value="{{ $month->month }}"
                                                {{ $month->month == request('month') ? 'selected' : '' }}>
                                                {{ $month->month }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if (auth()->user()->hasRole('super-admin'))
                                    <div class="me-2">
                                        <label class="form-label mb-0 small">{{ __('Filter by representative') }}</label>
                                        <select class="form-select form-select-sm" name="representative_id">
                                            <option value="" {{ !request('representative_id') ? 'selected' : '' }}>
                                                {{ __('All Representatives') }}</option>
                                            @foreach ($data['representatives'] ?? [] as $representative)
                                                <option value="{{ $representative->id }}"
                                                    {{ $representative->id == request('representative_id') ? 'selected' : '' }}>
                                                    {{ $representative->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="me-2">
                                    <label class="form-label mb-0 small">{{ __('Filter by doctor') }}</label>
                                    <select class="form-select form-select-sm" name="doctor_id">
                                        <option value="" {{ !request('doctor_id') ? 'selected' : '' }}>
                                            {{ __('All Doctors') }}</option>
                                        @foreach ($data['doctors'] ?? [] as $doctor)
                                            <option value="{{ $doctor->id }}"
                                                {{ $doctor->id == request('doctor_id') ? 'selected' : '' }}>
                                                {{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <x-forms.submit-button label="{{ __('filtering') }}" class="btn btn-primary btn-sm" />
                                    <a href="{{ route('doctorVisits.index') }}"
                                        class="btn btn-outline-secondary btn-sm">{{ __('Clear Filters') }}</a>
                                </div>
                            </x-forms.form>
                        </div>
                        @can('create-doctor_visits')
                            <x-buttons.create :action="route('doctorVisits.create')" />
                        @endcan
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Attachment') }}</th>
                                    <th>{{ __('Doctor') }}</th>
                                    <th>{{ __('Representative') }}</th>
                                    <th>{{ __('Visit Date') }}</th>
                                    <th>{{ __('month') }}</th>
                                    <th>{{ __('Products Number') }}</th>
                                    <th>{{ __('Note') }}</th>

                                    @canany(['show-doctor_visits'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['visits'] as $index => $visit)
                                    <tr>
                                        <td>{{ ($data['visits']->currentPage() - 1) * $data['visits']->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            @if (!empty($visit->image_url))
                                                <span
                                                    class="badge bg-success rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width:26px;height:26px;">
                                                    <i class="fa-solid fa-check text-white" style="font-size:15px;"></i>
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-danger rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width:26px;height:26px;">
                                                    <i class="fa-solid fa-circle-xmark text-white"
                                                        style="font-size:15px;"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $visit->doctor->name ?? '-' }}</td>
                                        <td>{{ $visit->representative->name ?? '-' }}</td>
                                        <td>{{ $visit->visit_date->format('Y-m-d H') }}</td>
                                        <td>{{ $visit->period->month ?? '-' }}</td>
                                        <td>{{ $visit->total_samples ?? '-' }}</td>
                                        <td>{{ $visit->notes ?? '-' }}</td>

                                        @canany(['show-doctor_visits'])
                                            <td>
                                                @can('show-doctor_visits')
                                                    <x-buttons.show :action="route('doctorVisits.show', $visit)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && auth()->user()->can('show-doctor_visits') ? 9 : 8 }}">
                                            {{ __('No doctors found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($data['visits']->count())
                                <x-table.tfoot :page="$data['visits']" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($data['visits']->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $data['visits']])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
