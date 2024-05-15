<div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 mb-3 input-group-sm">
                                <label for="nombre" class="form-label font-sm fw-600">Nombre</label>
                                <input placeholder="Nombre del producto" type="text" class="form-control font-sm"
                                    id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            </div>
                            <div class="col-md-4 mb-3 input-group-sm">
                                <label for="estado" class="form-label font-sm fw-600">Estado</label>
                                <select class="custom-select font-sm" id="estado" name="estado">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio" class="form-label font-sm fw-600">Precio</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" placeholder="S/ 0.00" step="0.01" class="form-control"
                                        id="precio" name="precio" value="{{ old('precio') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 input-group-sm">
                                <label for="stock" class="form-label font-sm fw-600">Stock</label>
                                <input type="number" class="form-control" placeholder="stock" id="stock"
                                    name="stock" value="{{ old('stock') }}" required>
                            </div>
                            <div class="col-md-4 mb-3 input-group-sm">
                                <label for="marca" class="form-label font-sm fw-600">Marca</label>
                                <input type="text" class="form-control" placeholder="marca" id="marca"
                                    name="marca" value="{{ old('marca') }}" required>
                            </div>
                            <div class="col-md-4 mb-3 input-group-sm">
                                <label for="categoria_id" class="form-label fw-600">Categoría</label>
                                <select class="custom-select" id="categoria_id" name="categoria_id" required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categoriasProducto as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3 input-group-sm">
                                <label for="descripcion" class="form-label font-sm fw-600">Descripción</label>
                                <textarea class="form-control font-sm" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="image" class="form-label font-sm fw-600">Imagen</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control-file" id="image" name="image"
                                        onchange="previewImage(this)">
                                </div>
                                <div id="imagePreview" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary font-sm">Guardar producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
