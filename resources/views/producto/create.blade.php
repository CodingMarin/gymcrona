@extends('adminlte::page')

@section('title', 'GYM System - Registrar Producto')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Producto</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('producto.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Registrar producto</li>
                </ol>
            </div>
        </div>
    </div>
@stop


@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="d-flex col-md-7">
                    <div class="card flex-grow-1 elevation-0 border rounded">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nombre" class="form-label font-sm">Nombre</label>
                                <input placeholder="Nombre del producto" type="text" class="form-control font-sm"
                                    id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label font-sm">Descripción</label>
                                <textarea class="form-control font-sm" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label font-sm">Imagen</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control-file" id="image" name="image"
                                        onchange="previewImage(this)">
                                </div>
                                <div id="imagePreview" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex col-md-5">
                    <div class="card flex-grow-1 elevation-0 border rounded">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="estado" class="form-label font-sm">Estado</label>
                                <select class="custom-select font-sm" id="estado" name="estado">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="mb-3 input-group-sm">
                                <label for="precio" class="form-label font-sm">Precio</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                                        value="{{ old('precio') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label font-sm">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                    value="{{ old('stock') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label font-sm">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca"
                                    value="{{ old('marca') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select class="custom-select" id="categoria_id" name="categoria_id" required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categoriasProducto as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary font-sm">Guardar producto</button>
        </form>
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

@section('js')
    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '150px';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
