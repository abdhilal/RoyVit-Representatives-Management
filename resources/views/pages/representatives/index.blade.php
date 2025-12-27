@extends('layouts.app')
@section('title')
    {{ __('Representatives List') }}
@endsection
@section('breadcrumb')
    {{ __('Representatives') }}
@endsection
@section('breadcrumbActive')
    {{ __('Representatives List') }}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="representatives.index" col="5"
                            placeholder="{{ __('search representatives by name') }}" />
                        @can('create-representatives')
                            <x-buttons.create :action="route('representatives.create')" />
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('Associated doctors') }}</th>
                                    <th>{{ __('Specializations') }}</th>
                                    @canany(['show-representatives', 'update-representatives', 'delete-representatives'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($representatives as $representative)
                                    <tr>
                                        <td>{{ $representative->id }}</td>
                                        <td><a class="text-info" href="{{ route('representatives.show', $representative) }}">{{ $representative->name }}</a></td>
                                        <td>{{ $representative->doctors_count }}</td>
                                        <td>{{ $representative->specializations_count }}</td>


                                        @canany(['show-representatives', 'update-representatives'])
                                            <td>

                                                @can('show-representatives')
                                                    <x-buttons.show :action="route('representatives.show', $representative)" />
                                                @endcan
                                                @can('update-representatives')
                                                    <x-buttons.edit :action="route('users.edit', $representative)" />
                                                @endcan


                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No representatives found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($representatives->count())
                                <x-table.tfoot :page="$representatives" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($representatives->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $representatives])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
