@extends('adminlte::page')

@section('title', 'Gymcrona - Registrar Venta')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Registrar Venta</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('venta.index') }}">Ventas</a></li>
                    <li class="breadcrumb-item active">Registrar nueva venta</li>
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
                        <form action="{{ route('venta.store') }}" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
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
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->nombres }}" data-id="{{ $cliente->id }}"> </option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <!-- Servicio -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label class="form-label font-sm fw-600 text-secondary">Fecha de emisión:</label>
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" class="form-control"
                                        readonly />
                                </div>

                                <!-- Sección Producto -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Producto -->
                                            <div class="input-group-sm col-md-4 mb-3">
                                                <label for="producto" class="form-label font-sm fw-600">Producto:</label>
                                                <input type="hidden" id="producto_id">
                                                <input type="hidden" id="producto_nombre" value="">
                                                <input list="productos" placeholder="producto" value=""
                                                    class="form-control" onchange="filtrarProducto(this.value)">
                                                <datalist id="productos">
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->nombre }}"
                                                            data-id="{{ $producto->id }}"
                                                            data-precio="{{ $producto->precio }}"
                                                            data-stock="{{ $producto->stock }}">
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                            <!-- Cantidad -->
                                            <div class="input-group-sm col-md-2 mb-3">
                                                <label for="cant_producto"
                                                    class="form-label font-sm fw-600">Cantidad:</label>
                                                <input type="number" placeholder="cantidad" class="form-control"
                                                    id="cant_producto" />
                                            </div>
                                            <!-- Stock -->
                                            <div class="input-group-sm col-md-2 mb-3">
                                                <label for="stock" class="form-label font-sm fw-600">Stock:</label>
                                                <input type="number" class="form-control" id="stock"
                                                    placeholder="stock" readonly />
                                            </div>
                                            <!-- Precio -->
                                            <div class="input-group-sm col-md-2 mb-3">
                                                <label for="precio" class="form-label font-sm fw-600">Precio
                                                    venta</label>
                                                <input type="number" step="0.01" class="form-control" id="precio"
                                                    placeholder="precio" readonly />
                                            </div>
                                            <!-- Metodo pago -->
                                            <div class="input-group-sm col-md-2">
                                                <label for="metodo_pago" class="form-label font-sm fw-600">Metodo de
                                                    Pago:</label>
                                                <select id="metodo_pago_id" name="metodo_pago_id"
                                                    class="custom-select form-select form-select-lg mb-3">
                                                    <option value="">Metodo de pago</option>
                                                    @foreach ($metodosPago as $metodo)
                                                        <option value="{{ $metodo->id }}"
                                                            data-nombre="{{ $metodo->brand->nombre }}"
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
                            <div class="text-end modal-footer">
                                <button type="button" id="continuar_btn" class="btn btn-outline-primary btn-sm"
                                    onclick="abrirModal()" disabled="true">
                                    Continuar
                                </button>
                            </div>
                            <!-- Checkout Modal -->
                            <div class="modal fade" id="checkOutModal" tabindex="-1"
                                aria-labelledby="checkOutModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body col-md-12 text-center">
                                            <div class="container col-md-12 mx-auto mb-3">
                                                <picture>
                                                    <img id="feature_img" class="img-fluid img-thumbnail border rounded"
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
                                            <button type="submit" class="btn btn-info btn-sm w-100">Realizar
                                                venta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <x-toast> Todos los campos son requeridos.</x-toast>
    <script>
        function filtrarProducto(filtro) {
            const productoSeleccionado = $("option[value='" + filtro + "']");
            const nombre = productoSeleccionado.attr('value');
            const dataId = productoSeleccionado.attr('data-id');
            const precio = productoSeleccionado.attr('data-precio');
            const stock = productoSeleccionado.attr('data-stock');

            document.getElementById('producto_nombre').value = nombre;
            document.getElementById("producto_id").value = dataId;
            document.getElementById("stock").value = stock;
            document.getElementById("precio").value = precio;
        }

        function filtrarCliente(filtro) {
            const clienteSeleccionado = $("option[value='" + filtro + "']");
            const dataId = clienteSeleccionado.attr('data-id');

            document.getElementById("cliente_id").value = dataId;
        }
        let contadorProductos = 0;
        let totalProductos = 0;

        function agregarProductoTemporal() {
            let productoNombre = $("#producto_nombre").val();
            let cantidad = parseInt($("#cant_producto").val());
            let stock = parseInt($("#stock").val());
            let producto_id = $("#producto_id").val();
            let precio = $("#precio").val();
            let cliente = $("#cliente_id").val();
            let metodoPago = $("#metodo_pago_id").val();
            if (productoNombre === '' || cantidad === '' || cliente === '' || metodoPago === '') {
                // Mostrar un alerta
                $("#liveToast").toast('show');
                // Salir de la función si hay campos vacíos
                return;
            } else {
                // Habilitar boton una vez completado los campos
                $("#continuar_btn").attr('disabled', false);
            }

            // Validar productos con stock 0 no pueden ser agregados
            if (stock == 0) {
                alert("No se puede agregar productos con stock 0");
                return;
            }

            // Validar que la cantidad no supere al stock
            if (cantidad > stock) {
                alert("La cantidad no puede superar al stock");
                return;
            }

            // Calcular el subtotal de los productos añadidos al table
            const subtotal = (precio * cantidad);

            totalProductos += subtotal;

            // Crear fila con los datos temporales
            const fila = `
            <tr>
                <td class="font-sm">${++contadorProductos}</td>
                <td class="font-sm">${productoNombre}</td>
                <td class="font-sm">${cantidad}</td>
                <td class="font-sm">S/.${precio}</td>
                <td class="font-sm">S/.${subtotal}</td>
                <!-- Campos ocultos -->
                <input type="hidden" name="detalle_venta[${contadorProductos}][producto_id]" value="${producto_id}">
                <input type="hidden" name="detalle_venta[${contadorProductos}][cantidad]" value="${cantidad}">
                <input type="hidden" name="detalle_venta[${contadorProductos}][subtotal]" value="${subtotal}">
            </tr>
        `;

            // Setear el total a pagar en el moda
            $("#checkOutModal #cantidad_total_pagar").text(totalProductos.toFixed(2));
            // Agregar la fila a la tabla
            $("#proformaBody").append(fila);

            console.log('producto_id:', producto_id);
            console.log('cantidad:', cantidad);
            console.log('subtotal:', subtotal);

            // Limpiar los campos despues de agregar un producto
            document.getElementById("producto_nombre").value = ''; // Por solucionar. no limpia el campo producto
            document.getElementById("producto_id").value = '';
            document.getElementById("cant_producto").value = '';
            document.getElementById("stock").value = '';
            document.getElementById("precio").value = '';
        }

        document.getElementById('metodo_pago_id').addEventListener('change', function() {
            const metodoPagoSeleccionado = this.options[this.selectedIndex];
            const nombre = metodoPagoSeleccionado.getAttribute("data-nombre");
            const imagen = metodoPagoSeleccionado.getAttribute("data-imagen");

            // Enviar el QR al checkout
            $("#feature_img").attr('src', "{{ asset('/images/payments') }}/" + imagen);
        });

        function abrirModal() {
            $("#checkOutModal").modal("show");
        }
    </script>
@endsection

@section('css')
    <style>
        .font-sm {
            font-size: 0.938rem;
        }

        .fw-600 {
            font-weight: 600 !important;
        }
    </style>
@endsection
