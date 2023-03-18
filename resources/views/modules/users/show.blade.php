@extends('adminlte::page')

@section('title', 'Dashboard::usuarios')

@section('content_header')
<h1>Detalles de Usuarios</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('User Details') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('role') }}:</label>
                            <span>{{ $user->role_name }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('name') }}:</label>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('last_name') }}:</label>
                            <span>{{ $user->last_name }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('phone_number') }}:</label>
                            <span>{{ $user->phone_number }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('identification_type') }}:</label>
                            <span>{{ $user->identification_type }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('identification_number') }}:</label>
                            <span>{{ $user->identification_number }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('email') }}:</label>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('age') }}:</label>
                            <span>{{ $user->age }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('create_time') }}:</label>
                            <span>{{ $user->create_time }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('last_update') }}:</label>
                            <span>{{ $user->update_time }}</span>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-success me-2 btn">{{ __('Edit') }}</a>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary me-2 btn" onclick="return confirm('Are you sure you want to cancel?')">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
