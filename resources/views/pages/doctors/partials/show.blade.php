@extends('layouts.app')
@section('title')
    {{ __('Doctor Details') }}
@endsection
@section('breadcrumb')
    {{ __('Doctors') }}
@endsection
@section('breadcrumbActive')
    {{ __('Doctor Details') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end align-items-center">
                    <div>
                        @can('update-doctors')
                            @isset($doctor)
                                <x-buttons.edit :action="route('doctors.edit', $doctor)" />
                            @endisset
                        @endcan

                        <x-buttons.back :action="route('doctors.index')" />
                    </div>
                </div>
                <div class="card-body">
                    @isset($doctor)
                        @if ($doctor->exists)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 200px">#</th>
                                            <td>{{ $doctor->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('name') }}</th>
                                            <td>{{ $doctor->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('phone') }}</th>
                                            <td>{{ $doctor->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('address') }}</th>
                                            <td>{{ $doctor->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('gender') }}</th>
                                            <td>{{ $genderLabel ?? $doctor->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('area') }}</th>
                                            <td>{{ $doctor->area->name ?? __('No area') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('warehouse') }}</th>
                                            <td>{{ $doctor->warehouse->name ?? __('No warehouse') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('classification') }}</th>
                                            <td>{{ $doctor->classification->name ?? __('No classification') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('specialization') }}</th>
                                            <td>{{ $doctor->specialization->name ?? __('No specialization') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('representative') }}</th>
                                            <td>{{ $doctor->representative->name ?? __('No representative') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('created at') }}</th>
                                            <td>{{ \Illuminate\Support\Carbon::parse($doctor->created_at)->format('Y-m-d H:i') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('updated at') }}</th>
                                            <td>{{ \Illuminate\Support\Carbon::parse($doctor->updated_at)->format('Y-m-d H:i') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">{{ __('No doctor data to display') }}</p>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
