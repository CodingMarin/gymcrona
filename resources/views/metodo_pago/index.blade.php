@extends('adminlte::page')

@section('title', 'Metodos de Pago')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Metodos de Pago</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                            </tr>
                        </thead>
                        @foreach ($metodosPago as $metodoPago)
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $metodoPago->id }}</td>
                                    <td>{{ $metodoPago->nombre }}</td>
                                    <td>{{ $metodoPago->descripcion }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
