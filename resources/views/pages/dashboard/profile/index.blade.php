@extends('layouts.app')
@section('title')
    {{ __('Profile') }}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Edit Profile') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3 class="card-title mb-0">{{ __('My Profile') }}</h3>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i
                                class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                            data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="profile-title">
                            <div class="d-flex align-items-center">
                              
                                <div class="flex-grow-1">
                                    <h3 class="mb-1">{{ $user->name }}</h3>
                                    <p class="mb-0">{{ $user->email }}</p>
                                    <div class="mt-2 text-muted small">
                                        <div>{{ __('Phone') }}:
                                            {{ optional($userInformations)->phone ?? __('Not provided') }}</div>
                                        <div>{{ __('Address') }}:
                                            {{ optional($userInformations)->address ?? __('Not provided') }}</div>
                                        <div>{{ __('City') }}:
                                            {{ optional($userInformations)->city ?? __('Not provided') }}</div>
                                        <div>{{ __('State') }}:
                                            {{ optional($userInformations)->state ?? __('Not provided') }}</div>
                                        <div>{{ __('Country') }}:
                                            {{ optional($userInformations)->country ?? __('Not provided') }}</div>
                                        <div>{{ __('Birth Date') }}:
                                            {{ $userInformations && $userInformations->birth_date ? $userInformations->birth_date->format('Y-m-d') : __('Not provided') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3 class="card-title mb-0">{{ __('Change Password') }}</h3>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <x-forms.form :action="route('profile.password.update')" method="PUT" class="needs-validation" novalidate>
                        <div class="row">
                            <x-forms.input name="current_password" label="{{ __('Current Password') }}" type="password" col="12" required />
                            <x-forms.input name="new_password" label="{{ __('New Password') }}" type="password" col="6" required />
                            <x-forms.input name="new_password_confirmation" label="{{ __('Confirm New Password') }}" type="password" col="6" required />
                        </div>
                        <div class="text-end">
                            <x-forms.submit-button label="{{ __('Update Password') }}" class="btn btn-warning" />
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="card">
                <div class="card-header card-no-border pb-0">
                    <h3 class="card-title mb-0">{{ __('Edit Profile') }}</h3>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <x-forms.form :action="route('profile.update')" method="PUT" class="needs-validation" novalidate>
                        <div class="row">
                            <x-forms.input name="name" label="{{ __('Name') }}" :model="$user" col="6"
                                required />
                            <x-forms.input name="email" label="{{ __('Email') }}" type="email" :model="$user"
                                col="6" required />

                        </div>
                        <hr />
                        <h5 class="mb-3">{{ __('User Information') }}</h5>
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
                        <div class="text-end">
                            <x-forms.submit-button label="{{ __('Update Profile') }}" class="btn btn-primary" />
                        </div>
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>
@endsection
