@extends('adminlte::page')

@section('title', 'Sincrona - Clientes')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Clientes</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('cliente.index') }}">Cliente</a></li>
                    <li class="breadcrumb-item active">Editar cliente</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- DNI -->
                                <div class="col-md-4 mb-3">
                                    <label for="dni" class="form-label font-sm">DNI:</label>
                                    <input type="text" class="form-control" name="dni" maxlength="8"
                                        value="{{ $cliente->dni }}" />
                                </div>
                                <!-- Nombres -->
                                <div class="col-md-4 mb-3">
                                    <label for="nombres" class="form-label font-sm">Nombres:</label>
                                    <input type="text" class="form-control" name="nombres" maxlength="50"
                                        value="{{ $cliente->nombres }}" />
                                </div>
                                <!-- Apellido paterno -->
                                <div class="col-md-4 mb-3">
                                    <label for="ap_paterno" class="form-label font-sm">A. Paterno:</label>
                                    <input type="text" class="form-control" name="ap_paterno" maxlength="50"
                                        value="{{ $cliente->ap_paterno }}" />
                                </div>
                                <!-- Apellido materno -->
                                <div class="col-md-4 mb-3">
                                    <label for="ap_materno" class="form-label font-sm">A. Materno:</label>
                                    <input type="text" class="form-control" name="ap_materno" maxlength="50"
                                        value="{{ $cliente->ap_materno }}" />
                                </div>
                                <!-- Teléfono -->
                                <div class="col-md-4 mb-3">
                                    <label for="telefono" class="form-label font-sm">Teléfono (opcional):</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="11"
                                        value="{{ $cliente->telefono }}" />
                                </div>
                                <!-- Correo -->
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label font-sm">Email (opcional):</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ $cliente->email }}" />
                                </div>
                            </div>
                            <div class="text-end modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    Actualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .font-sm {
            font-size: 0.938rem;
        }

        .fw-600 {
            font-weight: 600;
        }

        .text-light-dark {
            color: #172B4D;
        }
    </style>
@endsection
