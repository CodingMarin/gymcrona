@extends('adminlte::page')

@section('title', 'Sincrona - Promociones')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Promociones</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('promocion.index') }}">Promociones</a></li>
                    <li class="breadcrumb-item active">Editar Promoción</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <form id="formPromocion" action="{{ route('promocion.update', $promocion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group input-group-sm col-md-6">
                            <label for="nombre" class="font-sm fw-600">Nombre (promoción)</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ $promocion->nombre }}" required>
                        </div>
                        <div class="form-group input-group-sm col-md-3">
                            <label for="precio" class="font-sm fw-600">Precio</label>
                            <input class="form-control" id="precio" name="precio" type="number" min="0.00"
                                max="10000.00" step="0.01" value="{{ $promocion->precio }}" required />
                            @error('precio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group input-group-sm col-md-3">
                            <label for="duracion" class="font-sm fw-600">Duración</label>
                            <input class="form-control" id="duracion" name="duracion" type="date" value=""
                                readonly>
                        </div>
                    </div>
                    <div class="form-group input-group-sm">
                        <label for="descripcion" class="font-sm fw-600">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $promocion->descripcion }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary font-sm btn-sm">Actualizar registro</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .font-sm {
            font-size: 0.938rem !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }
    </style>
@endsection
