@extends('layouts.app')
@section('title')
    {{ __('Users List') }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Users List') }}
@endsection
@section('content')
    <x-cards.container>
        <x-cards.card :value="$usersCount" label="{{ __('Total Users') }}" icon="users" roundColor="primary" trendText="+0%"
            trendClass="font-primary" />
        <x-cards.card :value="$usersCountActive" label="{{ __('Active Users') }}" icon="users" roundColor="success" />
        <x-cards.card :value="$usersCountInactive" label="{{ __('Inactive Users') }}" icon="users" roundColor="danger" />
    </x-cards.container>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <x-search-form route="users.index" placeholder="{{ __('search users') }}" />
                        @can('create-users')
                            <x-buttons.create :action="route('users.create')" />
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
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('roles') }}</th>
                                    <th>{{ __('status') }}</th>
                                    @canany(['show-users', 'update-users', 'delete-users'])
                                        <th>{{ __('actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->roles->count() > 0)
                                                @foreach ($user->roles as $role)
                                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">{{ __('No roles assigned') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('update-users')
                                                <x-buttons.toggle-active :model="$user" action="users.toggleActive" />
                                            @else
                                                <span
                                                    class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">{{ $user->is_active ? __('active') : __('inactive') }}</span>
                                            @endcan
                                        </td>
                                        @canany(['show-users', 'update-users', 'delete-users'])
                                            <td>
                                                @can('update-users')
                                                    <form action="{{ route('users.impersonate', $user) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-primary btn-sm">{{ __('Sign in') }}</button>
                                                    </form>
                                                @endcan
                                                @can('show-users')
                                                    <x-buttons.show :action="route('users.show', $user)" />
                                                @endcan
                                                @can('update-users')
                                                    <x-buttons.edit :action="route('users.edit', $user)" />
                                                @endcan
                                                @can('delete-users')
                                                    <x-buttons.delete-form :action="route('users.destroy', $user)" />
                                                @endcan

                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No users found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($users->count())
                                <x-table.tfoot :page="$users" />
                            @endif
                        </table>
                    </div>
                </div>
                @if ($users->count())
                    <div class="card-footer">
                        @include('layouts.partials.pagination', ['page' => $users])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
