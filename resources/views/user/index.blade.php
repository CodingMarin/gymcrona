@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Usuarios</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
