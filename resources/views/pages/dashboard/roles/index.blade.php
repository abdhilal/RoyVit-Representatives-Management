@extends('layouts.app')
@section('title')
    {{ __('Roles List') }}
@endsection
@section('breadcrumb')
    {{ __('Roles') }}
@endsection
@section('breadcrumbActive')
    {{ __('Roles List') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="roles.index" placeholder="{{ __('search roles') }}" />
                        @can('create-roles')
                            <x-buttons.create :action="route('roles.create')" />
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
                                    <th>{{ __('description') }}</th>
                                    <th>{{ __('permissions') }}</th>
                                    @canany(['show-roles', 'update-roles', 'delete-roles'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role->permissions->count() }}</td>
                                        @canany(['show-roles', 'update-roles', 'delete-roles'])
                                            <td>
                                                @can('show-roles')
                                                    <x-buttons.show :action="route('roles.show', $role)" />
                                                @endcan
                                                @can('update-roles')
                                                    <x-buttons.edit :action="route('roles.edit', $role)" />
                                                @endcan
                                                @can('delete-roles')
                                                    <x-buttons.delete-form :action="route('roles.destroy', $role)" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No roles found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($roles->count())
                                <x-table.tfoot :page="$roles" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($roles->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $roles])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
