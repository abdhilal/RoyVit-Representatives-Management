@extends('layouts.app')

@section('title', __('User Details'))

@section('breadcrumb', __('Users'))

@section('breadcrumbActive', __('User Details'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            {{-- Header --}}
            <div class="card-header card-no-border pb-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">{{ __('User Details') }}</h3>
                <div>
                    @isset($user)
                        @can('update-users')
                            <x-buttons.edit :action="route('users.edit', $user)" />
                        @endcan
                    @endisset
                    <x-buttons.back :action="route('users.index')" />
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">
                @isset($user)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th width="250">#</th>
                                    <td>{{ $user->id }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>{{ $user->name }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Phone') }}</th>
                                    <td>{{ optional($user->userInformations)->phone ?? __('Not provided') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Address') }}</th>
                                    <td>{{ optional($user->userInformations)->address ?? __('Not provided') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('City') }}</th>
                                    <td>{{ optional($user->userInformations)->city ?? __('Not provided') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('State') }}</th>
                                    <td>{{ optional($user->userInformations)->state ?? __('Not provided') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Country') }}</th>
                                    <td>{{ optional($user->userInformations)->country ?? __('Not provided') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Birth Date') }}</th>
                                    <td>
                                        {{ $user->userInformations?->birth_date?->format('Y-m-d') ?? __('Not provided') }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>{{ __('Roles') }}</th>
                                    <td>
                                        @forelse ($user->roles as $role)
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        @empty
                                            {{ __('No roles assigned') }}
                                        @endforelse
                                    </td>
                                </tr>

                           

                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>{{ $user->is_active ? __('Active') : __('Inactive') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Created At') }}</th>
                                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Updated At') }}</th>
                                    <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">{{ __('No user data to display') }}</p>
                @endisset
            </div>

        </div>
    </div>
</div>
@endsection
