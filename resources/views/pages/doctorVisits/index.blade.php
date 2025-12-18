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
                            <x-search-form route="doctorVisits.index"
                                placeholder="{{ __('search doctors by name or address') }}" col="5" />
                            <x-forms.form action="{{ route('doctorVisits.index') }}" method="GET"
                                class="d-flex align-items-center">
                                <x-forms.select name="month" :options="$data['months'] ?? []" :value="request('month')"
                                    placeholder="{{ __('month') }}" style="min-width:200px;" />
                                <button type="submit" class="btn btn-outline-secondary ms-2">{{ __('search') }}</button>
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
                                                <img src="{{ $visit->image_url }}" alt="{{ __('Attachment') }}"
                                                    style="width:34px;height:34px;object-fit:cover;border-radius:6px;">
                                            @else
                                                <span class="text-muted">{{ __('No files found') }}</span>
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
