@extends('adminlte::page')

@section('title', 'Sincrona - Metodos de Pago')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Metodos de pago</h5>
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Metodos de Pago</a></li>
                <li class="breadcrumb-item active">Editar metodo de pago</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Editar Método de Pago</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('metodo-pago.update', $metodoPago->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="brand_id">Marca</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $brand->id == $metodoPago->brand_id ? 'selected' : '' }}>
                                    {{ $brand->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            value="{{ $metodoPago->descripcion }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
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
