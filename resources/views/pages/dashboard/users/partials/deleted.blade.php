@extends('layouts.app')
@section('title')
    {{__('Deleted Users')}}
@endsection
@section('breadcrumb')
    {{ __('Users') }}
@endsection
@section('breadcrumbActive')
    {{ __('Deleted Users') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-end align-items-center">
          <x-buttons.back :action="route('users.index')" />
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
                <th>{{ __('deleted_at') }}</th>
                @canany(['restore-users', 'force-delete-users'])
                <th>{{ __('actions') }}</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ optional($user->deleted_at)->format('Y-m-d H:i') }}</td>
                  @canany(['restore-users', 'force-delete-users'])
                  <td>
                    @can('restore-users')
                    <x-buttons.restore-form :action="route('users.restore', $user)" />
                    @endcan
                    @can('force-delete-users')
                    <x-buttons.delete-form :action="route('users.forceDelete', $user)" />
                    @endcan 
                  </td>
                  @endcan
                </tr>
              @empty
                <tr>
                  <td colspan="6">{{ __('No deleted users found') }}</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->count())
          <div class="card-footer">
              @include('layouts.partials.pagination', ['page' => $users])
          </div>
      @endif
    </div>
  </div>
</div>
@endsection