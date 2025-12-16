@extends('layouts.app')
@section('title')
    {{ __('Monthly Periods List') }}
@endsection
@section('breadcrumb')
    {{ __('Monthly Periods') }}
@endsection
@section('breadcrumbActive')
    {{ __('Monthly Periods List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">


                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('month') }}</th>
                                    <th>{{ __('max visits') }}</th>

                                    @canany(['show-visit_periods', 'update-visit_periods'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visitPeriods as $index => $visitPeriod)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $visitPeriod->month }}</td>
                                        <td>{{ $visitPeriod->max_visits }}</td>

                                        @canany(['show-visit_periods', 'update-visit_periods'])
                                            <td>
                                                @can('show-visit_periods')
                                                    <x-buttons.show :action="route('visitPeriods.show', $visitPeriod)" />
                                                @endcan
                                                @can('update-visit_periods')
                                                    <x-buttons.edit :action="route('visitPeriods.edit', $visitPeriod)" />
                                                @endcan
                                               
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-visit_periods') || auth()->user()->can('update-visit_periods') || auth()->user()->can('delete-visit_periods')) ? 5 : 4 }}">
                                            {{ __('No visit periods found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($visitPeriods->count())
                                <x-table.tfoot :page="$visitPeriods" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($visitPeriods->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $visitPeriods])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
