@extends('adminlte::page')

@section('title', 'Inscripciones')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Inscripciones</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Numero Boleta</th>
                                <th scope="col">Fecha de Emision</th>
                                <th scope="col">Monto de Costo</th>
                                <th scope="col">Monto de Pago</th>
                                <th scope="col">Monto de Deuda</th>
                            </tr>
                        </thead>
                        @foreach ($inscripciones as $inscripcion)
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $inscripcion->id }}</td>
                                    <td>{{ $inscripcion->numero_boleta }}</td>
                                    <td>{{ $inscripcion->fecha_emision }}</td>
                                    <td>{{ $inscripcion->fecha_caducidad }}</td>
                                    <td>{{ $inscripcion->monto_costo }}</td>
                                    <td>{{ $inscripcion->monto_pago }}</td>
                                    <td>{{ $inscripcion->monto_deuda }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
