@extends('adminlte::page')

@section('title', 'Gymcrona - Inscripciones')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Inscripciones</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inscripcion.index') }}">Inscripciones</a></li>
                    <li class="breadcrumb-item active">Crear Inscripción</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <picture>
                    <img src="" alt="">
                </picture>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card-body">
                        @if (!isset($metodoPago))
                            <div class="alert alert-dismissible fade show text-warning font-sm"
                                style="background: rgba(243, 156, 18,.1); border: 1px solid rgba(243, 156, 18,.2);"
                                role="alert">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-sm">No tienes ningun metodo de pago configurado.</span>
                                    <a href="{{ route('metodo-pago.index') }}"
                                        class="rounded border-warning btn btn-sm bg-warning text-decoration-none">
                                        <span class="text-white">Ir </span>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <form action="{{ route('inscripcion.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="numero_boleta" class="form-label font-sm fw-600">N°
                                        Boleta(Opcional):</label>
                                    <input type="text" class="form-control" id="numero_boleta" name="numero_boleta"
                                        placeholder="Numero de boleta" maxlength="11" />
                                </div>
                                <!-- Cliente -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="cliente_id" class="form-label font-sm fw-600">Cliente:</label>
                                    <input type="hidden" id="cliente_id" name="cliente_id">
                                    <input list="clientes" placeholder="Cliente" value="" class="form-control"
                                        onchange="obtenerCliente(this.value)" required>
                                    <datalist id="clientes">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->nombres }}" data-id={{ $cliente->id }}>
                                            </option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <!-- Servicio -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="categoria_id" class="form-label font-sm fw-600">Servicio/Area:</label>
                                    <input type="hidden" id="servicio_id" name="servicio_id">
                                    <input type="hidden" id="servicio_nombre" name="servicio_nombre">
                                    <input list="servicios" placeholder="Servicio" value="" class="form-control"
                                        onchange="obtenerNombreServicio(this.value)" required>
                                    <datalist id="servicios">
                                        @foreach ($categoriasServicio as $categoria)
                                            <option value="{{ $categoria->nombre }}" data-id="{{ $categoria->id }}">
                                            </option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <!-- Promoción -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="promocion_id" class="form-label font-sm fw-600">Promoción
                                        (opcional):</label>
                                    <input type="hidden" id="promocion_id" name="promocion_id">
                                    <input list="promociones" placeholder="Promociones" value="" class="form-control"
                                        onchange="obtenerPromocionServicio(this.value)" required>
                                    <datalist id="promociones">
                                        @foreach ($promocionServicio as $promocion)
                                            <option value="{{ $promocion->nombre }}" data-id="{{ $promocion->id }}"
                                                data-precio="{{ $promocion->precio }}">
                                            </option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <!-- Fecha de emisión -->

                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="fecha_emision" class="form-label font-sm fw-600">Fecha de emisión:</label>
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" class="form-control"
                                        id="fecha_emision" name="fecha_emision" readonly />
                                </div>
                                <!-- Fecha de caducidad -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="fecha_caducidad" class="form-label font-sm fw-600">Fecha de
                                        caducidad:</label>
                                    <input type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad"
                                        required />
                                </div>

                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="monto_costo" class="form-label font-sm fw-600">Precio de la Inscripcion
                                        (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_costo"
                                        name="monto_costo" placeholder="S/. 0.00" required />
                                </div>
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="monto_pago" class="form-label font-sm fw-600">Monto Pagado (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_pago"
                                        name="monto_pago" placeholder="S/. 0.00" required onchange="calcularDeuda()" />
                                </div>
                                <!-- Metodo de pago -->
                                <div class="input-group-sm col-md-4">
                                    <label for="metodo_pago_id" class="form-label font-sm fw-600">Metodo de Pago:</label>
                                    <select class="custom-select form-select form-select-lg mb-3" name="metodo_pago_id"
                                        id="metodo_pago_id" required>
                                        <option value="">Selecciona un metodo de pago</option>
                                        @foreach ($metodoPago as $metodo)
                                            <option value="{{ $metodo->id }}">
                                                {{ $metodo->brand->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Estado -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="estado_id" class="form-label font-sm fw-600">Estado de
                                        Inscripcion:</label>
                                    <select class="custom-select form-select form-select-lg" name="estado_id"
                                        id="estado_id" required>
                                        <option value="" selected>Selecciona un estado</option>
                                        @foreach ($estadoInscripcion as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Deuda -->
                                <div class="input-group-sm col-md-4">
                                    <label for="monto_deuda" class="form-label font-sm fw-600">Monto de Deuda
                                        (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_deuda"
                                        name="monto_deuda" placeholder="S/. 0.00" readonly />
                                </div>
                            </div>
                            <div class="text-end modal-footer">
                                <button type="submit" class="btn btn-outline-primary btn-sm"
                                    @if ($metodoPago->count() > 0) @else disabled @endif>
                                    Inscribir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Notificación Modal -->
    <div class="modal fade" id="notificacionModal" tabindex="-1" role="dialog"
        aria-labelledby="notificacionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Notificación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="mensaje"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
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

        .fw-600 {
            font-weight: 600 !important;
        }
    </style>
@endsection

@section('js')
    <script>
        function calcularDeuda() {
            const precioInscripcion = parseFloat(document.getElementById('monto_costo').value);
            const montoPagado = parseFloat(document.getElementById('monto_pago').value);

            const deuda = precioInscripcion - montoPagado;
            document.getElementById('monto_deuda').value = deuda;

            if (montoPagado > precioInscripcion) {
                document.getElementById('mensaje').innerText =
                    'El monto pagado no puede ser mayor al precio de la inscripción.';
                $('#notificacionModal').modal('show');
            }
        }

        function obtenerPrecioPromocion() {
            const promocionSelect = document.getElementById('promocion_id');
            const precioInscripcionInput = document.getElementById('monto_costo');

            promocionSelect.addEventListener('change', function() {
                const precioPromocion = parseFloat(this.options[this.selectedIndex].getAttribute('data-precio'));
                precioInscripcionInput.value = precioPromocion.toFixed(2);

            });
        }

        function obtenerNombreServicio(filtro) {
            const servicioSeleccionado = $("option[value='" + filtro + "']");
            const nombre = servicioSeleccionado.attr('value');
            const dataId = servicioSeleccionado.attr('data-id');

            document.getElementById('servicio_nombre').value = nombre;
            document.getElementById("servicio_id").value = dataId;
        }

        function obtenerCliente(filtro) {
            const clienteSeleccionado = $("option[value='" + filtro + "']");
            const dataId = clienteSeleccionado.attr('data-id');

            document.getElementById("cliente_id").value = dataId;
        }

        function obtenerPromocionServicio(filtro) {
            const promocionSeleccionado = $("option[value='" + filtro + "']");
            const dataId = promocionSeleccionado.attr('data-id');

            document.getElementById("promocion_id").value = dataId;
        }
        obtenerPrecioPromocion();
        calcularDeuda();
    </script>
@endsection
