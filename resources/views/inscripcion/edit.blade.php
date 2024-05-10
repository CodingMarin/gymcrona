@extends('adminlte::page')

@section('title', 'Gymcrona - Editar Inscripción')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Editar Inscripción</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inscripcion.index') }}">Inscripciones</a></li>
                    <li class="breadcrumb-item active">Editar</li>
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
                        <form action="{{ route('inscripcion.update', $inscripcion->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- Número de boleta -->
                                <div class="col-md-6 mb-3">
                                    <label for="numero_boleta" class="form-label">N° Boleta (Opcional):</label>
                                    <input type="text" class="form-control" id="numero_boleta" name="numero_boleta"
                                        placeholder="Número de boleta" maxlength="11"
                                        value="{{ $inscripcion->numero_boleta }}" />
                                </div>

                                <!-- Cliente -->
                                <div class="col-md-6 mb-3">
                                    <label for="cliente_id" class="form-label">Cliente:</label>

                                    <!-- Cliente id -->
                                    <input type="hidden" class="form-control" id="cliente_id" name="cliente_id"
                                        value="{{ $inscripcion->cliente->id }}">

                                    <!-- Nombre cliente -->
                                    <input type="text" class="form-control" value="{{ $inscripcion->cliente->nombres }}"
                                        readonly>
                                </div>

                                <!-- Servicio -->
                                <div class="col-md-6 mb-3">
                                    <label for="servicio_id" class="form-label">Servicio:</label>

                                    <!-- Servicio id -->
                                    <input type="hidden" class="form-control" id="servicio_id" name="servicio_id"
                                        value="{{ $inscripcion->categoriaServicio->id }}">

                                    <!-- Nombre servicio -->
                                    <input type="text" class="form-control"
                                        value="{{ $inscripcion->categoriaServicio->nombre }}" readonly>
                                </div>
                                <!-- Promoción -->
                                <div class="col-md-6 mb-3">
                                    <label for="promocion_id" class="form-label">Promoción:</label>

                                    <!-- Promocion id -->
                                    <input type="hidden" class="form-control" id="promocion_id" name="promocion_id"
                                        value="{{ $inscripcion->promocionServicio->id }}">

                                    <!-- Promocion nombre -->
                                    <input type="text" class="form-control"
                                        value="{{ $inscripcion->promocionServicio->nombre }}" readonly>
                                </div>

                                <!-- Fecha de emisión -->
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_emision" class="form-label">Fecha de emisión:</label>
                                    <input type="date" class="form-control" id="fecha_emision" name="fecha_emision"
                                        value="{{ $inscripcion->fecha_emision }}" readonly />
                                </div>

                                <!-- Fecha de caducidad -->
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_caducidad" class="form-label">Fecha de caducidad:</label>
                                    <input type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad"
                                        value="{{ $inscripcion->fecha_caducidad }}" required />
                                </div>

                                <!-- Precio -->
                                <div class="col-md-3 mb-3">
                                    <label for="monto_costo" class="form-label">Precio de la Inscripción (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_costo"
                                        name="monto_costo" value="{{ $inscripcion->monto_costo }}" required readonly />
                                </div>

                                <!-- Monto Pagado -->
                                <div class="col-md-3 mb-3">
                                    <label for="monto_pago" class="form-label">Monto Pagado (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_pago"
                                        name="monto_pago" value="{{ $inscripcion->monto_pago }}" readonly />
                                </div>

                                <!-- Monto de Deuda -->
                                <div class="col-md-6 mb-3">
                                    <label for="monto_deuda" class="form-label text-danger">Monto de Deuda (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_deuda"
                                        name="monto_deuda" value="{{ $inscripcion->monto_deuda }}" readonly />
                                </div>

                                <!--  de Deuda -->
                                <div class="col-md-6 mb-3">
                                    <label for="pago_actual" class="form-label text-success">Pago actual (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="pago_actual"
                                        name="pago_actual" placeholder="0.00" onchange="calcularDeuda()" />
                                </div>

                                <!-- Método de Pago -->
                                <div class="col-md-6 mb-3">
                                    <label for="metodo_pago_id" class="form-label">Método de Pago:</label>
                                    <select class="custom-select form-select form-select-lg" id="metodo_pago_id"
                                        name="metodo_pago_id" required>
                                        @foreach ($metodoPago as $pago)
                                            <option value="{{ $pago->id }}"
                                                @if ($inscripcion->metodo_pago_id == $pago->id) selected @endif>
                                                {{ $pago->brand->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Estado -->
                                <div class="col-md-6 mb-3">
                                    <label for="estado_id" class="form-label">Estado de Inscripción:</label>
                                    <select class="custom-select form-select form-select-lg" name="estado_id">
                                        @foreach ($estadoInscripcion as $estado)
                                            <option value="{{ $estado->id }}"
                                                @if ($inscripcion->estado_id == $estado->id) selected @endif>{{ $estado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-end modal-footer">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Guardar Cambios</button>
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
            font-size: 0.938rem;
        }

        .fw-600 {
            font-weight: 600;
        }

        .text-light-dark {
            color: #172B4D;
        }

        .bg-blue-100 {
            background-color: rgba(96, 165, 250, 0.5);
        }
    </style>
@endsection

@section('js')
    <script>
        function calcularDeuda() {
            //////////////////Funcion//////////////
            const precioInscripcion = parseFloat(document.getElementById('monto_costo').value);
            const montoPagado = parseFloat(document.getElementById('monto_pago').value);
            const pagoActual = parseFloat(document.getElementById('pago_actual').value);
            const deuda = parseFloat(document.getElementById('monto_deuda').value);

            if (isNaN(precioInscripcion) || isNaN(montoPagado) || isNaN(pagoActual) || isNaN(deuda)) {
                console.error('Alguno de los valores no es un número válido.');
                return;
            }

            if (pagoActual > deuda) {
                document.getElementById('mensaje').innerText = 'El pago actual no debe superar la deuda.';
                $('#notificacionModal').modal('show');
                document.getElementById('pago_actual').value = (0).toFixed(2);

            } else if (pagoActual < 0) {
                document.getElementById('mensaje').innerText = 'Por favor inserte un valor válido';
                $('#notificacionModal').modal('show');
                document.getElementById('pago_actual').value = 0;
            } else {
                let montoTotalPagado = 0;

                if (montoPagado >= precioInscripcion || montoPagado === precioInscripcion) {
                    document.getElementById('pago_actual').readOnly = true;
                } else {
                    montoTotalPagado = montoPagado + pagoActual
                    document.getElementById('monto_deuda').value = deuda - pagoActual;
                    document.getElementById('monto_pago').value = montoTotalPagado.toFixed(2);
                }

            }
        }
        calcularDeuda();
    </script>
@endsection
