<form action="{{ route('venta.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @method('POST')
    <div class="row">
        <!-- Cliente -->
        <div class="input-group-sm col-md-8 mb-3">
            <label for="cliente_id" class="form-label font-sm fw-600">Cliente:</label>
            <input type="hidden" name="cliente_id" id="cliente_id">
            <input list="clientes" placeholder="cliente" value="" class="form-control"
                onchange="filtrarCliente(this.value)">
            <datalist id="clientes">
                <!-- Iterar sobre los clientes para mostrar opciones -->
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->nombres }}" data-id="{{ $cliente->id }}"> </option>
                @endforeach
            </datalist>
        </div>
        <!-- Servicio -->
        <div class="input-group-sm col-md-4 mb-3">
            <label class="form-label font-sm fw-600 text-secondary">Fecha de emisión:</label>
            <input type="date" value="{{ now()->format('Y-m-d') }}" class="form-control" readonly />
        </div>
        <!-- Sección Producto -->
        <div class="card elevation-0 border">
            <div class="card-body">
                <div class="row">
                    <!-- Producto -->
                    <div class="input-group-sm col-md-4 mb-3">
                        <label for="producto" class="form-label font-sm fw-600">Producto:</label>
                        <input type="hidden" id="producto_id">
                        <input type="hidden" id="producto_nombre" value="">
                        <input list="productos" placeholder="producto" value="" class="form-control"
                            onchange="filtrarProducto(this.value)">
                        <datalist id="productos">
                            <!-- Iterar sobre los productos para mostrar opciones -->
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->nombre }}" data-id="{{ $producto->id }}"
                                    data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}">
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                    <!-- Cantidad -->
                    <div class="input-group-sm col-md-2 mb-3">
                        <label for="cant_producto" class="form-label font-sm fw-600">Cantidad:</label>
                        <input type="number" placeholder="cantidad" class="form-control" id="cant_producto" />
                    </div>
                    <!-- Stock -->
                    <div class="input-group-sm col-md-2 mb-3">
                        <label for="stock" class="form-label font-sm fw-600">Stock:</label>
                        <input type="number" class="form-control" id="stock" placeholder="stock" readonly />
                    </div>
                    <!-- Precio -->
                    <div class="input-group-sm col-md-2 mb-3">
                        <label for="precio" class="form-label font-sm fw-600">Precio venta</label>
                        <input type="number" step="0.01" class="form-control" id="precio" placeholder="precio"
                            readonly />
                    </div>
                    <!-- Metodo pago -->
                    <div class="input-group-sm col-md-2">
                        <label for="metodo_pago" class="form-label font-sm fw-600">Método de Pago:</label>
                        <select id="metodo_pago_id" name="metodo_pago_id"
                            class="custom-select form-select form-select-lg mb-3">
                            <option value="">Método de pago</option>
                            <!-- Iterar sobre los métodos de pago para mostrar opciones -->
                            @foreach ($metodosPago as $metodo)
                                <option value="{{ $metodo->id }}" data-nombre="{{ $metodo->brand->nombre }}"
                                    data-imagen="{{ $metodo->foto_qr }}">
                                    {{ $metodo->brand->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Proforma -->
                    <div class="table-responsive-lg table-borderless col-md-12">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-3"
                            onclick="agregarProductoTemporal()">Agregar detalle de venta</button>
                        <table class="table table-hover" id="proforma">
                            <thead class="thead-light">
                                <tr class="border-bottom">
                                    <th scope="col" class="font-sm">Nº</th>
                                    <th scope="col" class="font-sm">Producto</th>
                                    <th scope="col" class="font-sm">Cantidad</th>
                                    <th scope="col" class="font-sm">Precio Venta</th>
                                    <th scope="col" class="font-sm">Subtotal</th>
                                    <th scope="col" class="font-sm">Acción</th>
                                    <!-- Se corrigió "Accíon" a "Acción" -->
                                    <!-- Datos ocultos -->
                                    <th scope="col" class="font-sm d-none">Producto Id</th>
                                    <th scope="col" class="font-sm d-none">Cantidad</th>
                                    <th scope="col" class="font-sm d-none">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="proformaBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para continuar y abrir el modal de checkout -->
    <div class="text-end modal-footer">
        <button type="button" id="continuar_btn" class="btn btn-outline-primary btn-sm" onclick="abrirModal()"
            disabled>
            Continuar
        </button>
    </div>

    <!-- Modal de checkout -->
    <div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-md-12 text-center">
                    <div class="container col-md-12 mx-auto mb-3">
                        <picture>
                            <img id="feature_img" width="200" height="200" class="img-thumbnail border rounded"
                                src="" alt="">
                        </picture>
                    </div>
                    <!-- Contenido -->
                    <div class="">
                        <h6 class="text-dark font-weight-bold">Cantidad a Pagar</h6>
                        <h3 class="display-4">S/.<span id="cantidad_total_pagar"></span></h3>
                    </div>
                    <!-- Fin contenido -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm w-100">Realizar venta</button>
                </div>
            </div>
        </div>
    </div>
</form>
