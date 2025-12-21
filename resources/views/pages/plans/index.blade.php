@extends('layouts.app')
@section('title')
    {{ __('Plans List') }}
@endsection
@section('breadcrumb')
    {{ __('Plans') }}
@endsection
@section('breadcrumbActive')
    {{ __('Plans List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="plans.index" placeholder="{{ __('search plans by name') }}" col="4" />
                        @can('create-plans')
                            <x-buttons.create :action="route('plans.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Date') }}</th>


                                    @canany(['show-plans', 'update-plans', 'delete-plans'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $index => $plan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->visitPeriod->month }}</td>



                                        @canany(['show-plans', 'update-plans', 'delete-plans'])
                                            <td>
                                                @can('show-plans')
                                                    <x-buttons.show :action="route('plans.show', $plan)" />
                                                @endcan
                                            
                                                @can('delete-plans')
                                                    <x-buttons.delete-form :action="route('plans.destroy', $plan)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ auth()->user() && (auth()->user()->can('show-plans') || auth()->user()->can('update-plans') || auth()->user()->can('delete-plans')) ? 5 : 4 }}">
                                            {{ __('No plans found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($plans->count())
                                <x-table.tfoot :page="$plans" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($plans->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $plans])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
