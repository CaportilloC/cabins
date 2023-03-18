@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user->id) }}" id="edit-user-form">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('name') }}:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('last_name') }}:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('phone_number') }}:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="identification_type" class="col-md-4 col-form-label text-md-right">{{ __('identification_type') }}:</label>
                    <div class="col-md-6">
                        <select id="identification_type" class="form-control @error('identification_type') is-invalid @enderror" name="identification_type" required autofocus>
                            <option value="">Seleccione un tipo de identificación</option>
                            <option value="cedula de ciudadania" {{ $user->identification_type == 'cedula de ciudadania' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                            <option value="cedula de extrangeria" {{ $user->identification_type == 'cedula de extrangeria' ? 'selected' : '' }}>Cédula de extranjería</option>
                            <option value="pasaporte" {{ $user->identification_type == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                            <option value="tarjeta de identidad" {{ $user->identification_type == 'tarjeta de identidad' ? 'selected' : '' }}>Tarjeta de identidad</option>
                        </select>
                        @error('identification_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="identification_number" class="col-md-4 col-form-label text-md-right">{{ __('identification_number') }}:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="identification_number" name="identification_number" value="{{ $user->identification_number }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('confirm_password') }}</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('age') }}</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" form="edit-user-form" onclick="return confirm('Are you sure you want to update this user?')">{{ __('Update') }}</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary" onclick="return confirm('Are you sure you want to cancel?')">{{ __('Cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
