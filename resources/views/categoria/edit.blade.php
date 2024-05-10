@extends('adminlte::page')

@section('title', 'Gymcrona - Categorias')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Categorias</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('categoria.index') }}">Categorias</a></li>
                    <li class="breadcrumb-item active">Editar categoria</li>
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
                        <form action="{{ route('categoria.update', $categoria->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Nombre -->
                                <div class="col-md-6 mb-3 input-group-sm">
                                    <label for="nombre" class="form-label font-sm fw-600">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre" value="{{ $categoria->nombre }}" required />
                                </div>
                                <!-- Descripcion -->
                                <div class="col-md-6 mb-3 input-group-sm">
                                    <label for="descripcion" class="form-label font-sm fw-600">Descripcion:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        placeholder="Descripcion" value="{{ $categoria->descripcion }}" required />
                                </div>
                            </div>
                            <div class="text-end modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    Actualizar registro
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
            font-size: 0.938rem !important;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        .text-light-dark {
            color: #172B4D;
        }
    </style>
@endsection
