@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Clientes</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Dni</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Telefono</th>
                            </tr>
                        </thead>
                        @foreach ($clientes as $cliente)
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $cliente->id }}</td>
                                    <td>{{ $cliente->dni }}</td>
                                    <td>{{ $cliente->nombres }}</td>
                                    <td>{{ $cliente->ap_paterno }}</td>
                                    <td>{{ $cliente->ap_materno }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
