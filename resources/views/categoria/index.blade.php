@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Categorias</h2>
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
                        @foreach ($categorias as $categoria)
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $categoria->id }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->descripcion }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
