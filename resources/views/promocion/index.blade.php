@extends('adminlte::page')

@section('title', 'Promociones')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Promociones</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        @foreach ($promociones as $promocion)
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $promocion->id }}</td>
                                    <td>{{ $promocion->nombre }}</td>
                                    <td>{{ $promocion->descripcion }}</td>
                                    <td>{{ $promocion->precio }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
