@extends('layouts.app')
@php
    $isEdit = isset($user) && $user->exists;
    $title = $isEdit ? __('Edit User') : __('Add New User');
    $action = $isEdit ? route('users.update', $user) : route('users.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp
@section('title')
    {{ $title }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ $isEdit ? __('Edit User') : __('Add New User') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end align-items-center">
                    </div>
                    <div class="card-body">
                        <x-forms.form :action="$action" :method="$method" class="row g-3" novalidate>
                            <x-forms.input name="name" label="{{ __('name') }}" :model="$user" required />

                            <x-forms.input name="email" type="email" label="{{ __('email') }}" :model="$user"
                                required />

                            @if (!$isEdit)
                                <x-forms.input name="password" type="password" label="{{ __('password') }}" required
                                    help="{{ __('min 8 chars') }}" />
                                <x-forms.input name="password_confirmation" type="password"
                                    label="{{ __('confirm password') }}" required />
                            @endif
                            <x-forms.multiple-select name="roles" label="{{ __('roles') }}" :options="$roles"
                                :value="$userRoles" placeholder="{{ __('select roles') }}" required />
                            <x-forms.switch-checkbox name="is_active" label="{{ __('status') }}" :model="$user" />

                            <hr />
                            <h5 class="mb-3">{{ __('User Information') }}</h5>
                            @php($userInformations = $userInformations ?? null)
                            <div class="row">
                                <x-forms.input name="birth_date" label="{{ __('Birth Date') }}" type="date"
                                    :model="$userInformations" col="6" placeholder="{{ __('Not provided') }}" />
                                <x-forms.input name="phone" label="{{ __('Phone') }}" type="tel" :model="$userInformations"
                                    col="6" placeholder="{{ __('Not provided') }}" />
                                <x-forms.input name="address" label="{{ __('Address') }}" :model="$userInformations" col="12"
                                    placeholder="{{ __('Not provided') }}" />
                                <x-forms.input name="city" label="{{ __('City') }}" :model="$userInformations" col="4"
                                    placeholder="{{ __('Not provided') }}" />
                                <x-forms.input name="state" label="{{ __('State') }}" :model="$userInformations" col="4"
                                    placeholder="{{ __('Not provided') }}" />
                                <x-forms.input name="country" label="{{ __('Country') }}" :model="$userInformations" col="4"
                                    placeholder="{{ __('Not provided') }}" />
                            </div>

                            <div class="col-12 d-flex gap-2">
                                <x-forms.submit-button label="{{ __('save') }}" />
                                <x-buttons.cancel route="users.index" />
                            </div>
                        </x-forms.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
