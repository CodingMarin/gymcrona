@extends('adminlte::page')

@section('title', 'Sincrona - Editar Inscripción')

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
                                    <select class="custom-select form-select form-select-lg" id="cliente_id"
                                        name="cliente_id" required>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}"
                                                @if ($inscripcion->cliente_id == $cliente->id) selected @endif>{{ $cliente->nombres }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Servicio -->
                                <div class="col-md-6 mb-3">
                                    <label for="servicio_id" class="form-label">Servicio:</label>
                                    <select class="custom-select form-select form-select-lg" id="servicio_id"
                                        name="servicio_id" required>
                                        @foreach ($categoriasServicio as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                @if ($inscripcion->servicio_id == $categoria->id) selected @endif>{{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Promoción -->
                                <div class="col-md-6 mb-3">
                                    <label for="promocion_id" class="form-label">Promoción:</label>
                                    <select class="custom-select form-select form-select-lg" name="promocion_id"
                                        id="promocion_id" required>
                                        @foreach ($promocionServicio as $promocion)
                                            <option value="{{ $promocion->id }}"
                                                @if ($inscripcion->promocion_id == $promocion->id) selected @endif>{{ $promocion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <div class="col-md-6 mb-3">
                                    <label for="monto_costo" class="form-label">Precio de la Inscripción (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_costo"
                                        name="monto_costo" placeholder="Precio de inscripción"
                                        value="{{ $inscripcion->monto_costo }}" required readonly />
                                </div>
                                <!-- Monto Pagado -->
                                <div class="col-md-6 mb-3">
                                    <label for="monto_pago" class="form-label">Monto Pagado (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_pago"
                                        name="monto_pago" placeholder="Monto cancelado" onchange="calcularDeuda()"
                                        value="{{ $inscripcion->monto_pago }}" required />
                                </div>
                                <!-- Método de Pago -->
                                <div class="col-md-6 mb-3">
                                    <label for="metodo_pago_id" class="form-label">Método de Pago:</label>
                                    <select class="custom-select form-select form-select-lg" id="metodo_pago_id"
                                        name="metodo_pago_id" required>
                                        @foreach ($metodoPago as $metodo)
                                            <option value="{{ $metodo->id }}"
                                                @if ($inscripcion->metodo_pago_id == $metodo->id) selected @endif>
                                                {{ $metodo->brand->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Estado -->
                                <div class="col-md-6 mb-3">
                                    <label for="estado_id" class="form-label">Estado de Inscripción:</label>
                                    <select class="custom-select form-select form-select-lg" id="estado_id" name="estado_id"
                                        required>
                                        @foreach ($estadoInscripcion as $estado)
                                            <option value="{{ $estado->id }}"
                                                @if ($inscripcion->estado_id == $estado->id) selected @endif>{{ $estado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Monto de Deuda -->
                                <div class="col-md-6 mb-3">
                                    <label for="monto_deuda" class="form-label">Monto de Deuda (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_deuda"
                                        name="monto_deuda" placeholder="Deuda" value="{{ $inscripcion->monto_deuda }}"
                                        required />
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
            const precioInscripcion = parseFloat(document.getElementById('monto_costo').value);
            const montoPagado = parseFloat(document.getElementById('monto_pago').value);

            let deuda = precioInscripcion - montoPagado;

            if (montoPagado === precioInscripcion) {
                deuda = 0;
                document.getElementById('monto_deuda').readOnly = true;
            } else {
                document.getElementById('monto_deuda').readOnly = false;
            }

            document.getElementById('monto_deuda').value = deuda;

            if (montoPagado > precioInscripcion) {
                document.getElementById('mensaje').innerText =
                    'El monto pagado no puede ser mayor al precio de la inscripción.';
                $('#notificacionModal').modal('show');
            }
        }
        calcularDeuda();
    </script>
@endsection
