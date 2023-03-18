@extends('adminlte::page')

@section('title', 'Dashboard::usuarios')

@section('content_header')
<h1>Gestion de Usuarios</h1>
@stop

@section('content')

<div class="content container ">
    <div class="col-sm-12">
        <div class="card px-3">
            <div class="card-header">
                <nav class="navbar bg-body-tertiary">
                    <form class="container-fluid justify-content-start">
                        <a href="{{ route('users.showCreate')}}" class="btn btn-outline-primary me-2 btn-sm">{{ __('Create New') }}</a>
                    </form>
                </nav>
            </div>
            <div class="dataTables_length">
            <table class="table" id="usuarios">
                <thead>
                    <tr>
                        <th class="text-center">Creacion</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Doc</th>
                        <th class="text-center">Numero</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-center">{{ date('d/m/Y', strtotime($user->create_time)) }}</td>
                        <td class="text-center">{{ $user->role_name }}</td>
                        <td class="text-center">{{ $user->name }} {{ $user->last_name }}</td>
                        <td class="text-center">{{ $user->phone_number }}</td>
                        <td class="text-center">{{ $user->identification_type }}</td>
                        <td class="text-center">{{ $user->identification_number }}</td>
                        <td class="text-center">
                            <div class="text-center">
                                <a class="btn btn-outline-primary me-2 btn-sm" href="{{ route('users.show', $user->id) }}">
                                    {{ __('Show') }}
                                </a>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="text-center">
                                <a class="btn btn-outline-success me-2 btn-sm" href="{{ route('users.edit', $user->id) }}">
                                    {{ __('Edit') }}
                                </a>
                            </div>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('desactivarUsuario', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-danger me-2 btn-sm" onclick="return confirm('¿Está seguro de que desea desactivar este usuario?')">
                                    {{ __('Active') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@stop
@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#usuarios').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });
    </script>
@stop
