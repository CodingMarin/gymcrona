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
                    <li class="breadcrumb-item active">Editar Promocion</li>
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
                    <div class="form-group">
                        <label for="nombre" class="font-sm">Nombre (promoción)</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $promocion->nombre }}" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="font-sm">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $promocion->descripcion }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="precio" class="font-sm">Precio</label>
                        <input class="form-control" id="precio" name="precio" type="number" min="0.00"
                            max="10000.00" step="0.01" value="{{ $promocion->precio }}" required />
                        @error('precio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary font-sm">Actualizar</button>
                </div>
            </form>
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
