@extends('adminlte::page')

@section('title', 'Gymcrona - Editar Producto')

@section('content_header')
    <!-- Incluir la sección de encabezado de contenido desde producto.partials.content_header -->
    @include('producto.partials.content_header_edit')
@stop

@section('css')
    <!-- Incluir los estilos desde producto.partials.styles -->
    @include('producto.partials.styles')
@endsection

@section('content')
    <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <!-- Mostrar mensjae de error -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3 input-group-sm">
                            <label for="nombre" class="form-label font-sm fw-600">Nombre</label>
                            <input placeholder="Nombre del producto" type="text" class="form-control font-sm"
                                id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                        </div>
                        <div class="col-md-4 mb-3 input-group-sm">
                            <label for="estado" class="form-label font-sm fw-600">Estado</label>
                            <select class="custom-select font-sm" id="estado" name="estado">
                                <option value="1" {{ $producto->estado == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $producto->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="precio" class="form-label font-sm fw-600">Precio</label>
                            <div class="input-group input-group-sm">
                                <input type="number" placeholder="S/ 0.00" step="0.01" class="form-control"
                                    id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 input-group-sm">
                            <label for="stock" class="form-label font-sm fw-600">Stock</label>
                            <input type="number" class="form-control" placeholder="stock" id="stock" name="stock"
                                value="{{ old('stock', $producto->stock) }}" required>
                        </div>
                        <div class="col-md-4 input-group-sm">
                            <label for="marca" class="form-label font-sm fw-600">Marca</label>
                            <input type="text" class="form-control" placeholder="marca" id="marca" name="marca"
                                value="{{ old('marca', $producto->marca) }}" required>
                        </div>
                        <div class="col-md-4 input-group-sm">
                            <label for="descripcion" class="form-label font-sm fw-600">Descripción</label>
                            <textarea class="form-control font-sm" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                        </div>
                        <div class="col-md-4 input-group-sm">
                            <label for="categoria_id" class="form-label fw-600">Categoría</label>
                            <select class="custom-select" id="categoria_id" name="categoria_id" required>
                                <option value="">Seleccionar categoría</option>
                                @foreach ($categoriasProducto as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="form-label">Imagen:</label>
                            <div class="form-group">
                                @if ($producto->foto_url)
                                    <img src="{{ asset('images/productos/' . $producto->foto_url) }}"
                                        alt="Imagen del producto" style="max-width: 200px;">
                                @else
                                    <p>No hay imagen disponible.</p>
                                @endif
                                <input type="file" name="image" id="image" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary font-sm">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
@endsection
