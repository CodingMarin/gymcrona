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
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <!-- Verificar si existen registros en metodo de pago -->
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
                        <!-- Verificar si existen registros en categoria servicio -->
                        @if (!isset($categoriasServicio))
                            <div class="alert alert-dismissible fade show text-warning font-sm"
                                style="background: rgba(243, 156, 18,.1); border: 1px solid rgba(243, 156, 18,.2);"
                                role="alert">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-sm">No tienes ninguna categeria de servicio registrada.</span>
                                    <a href="{{ route('categoria.index') }}"
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
                                    @if ($categoriasServicio->isEmpty())
                                        <input type="text" placeholder="No hay servicios disponibles"
                                            class="form-control" disabled>
                                    @else
                                        <input list="servicios" placeholder="Servicio" value="" class="form-control"
                                            onchange="obtenerNombreServicio(this.value)" required>
                                        <datalist id="servicios">
                                            @foreach ($categoriasServicio as $categoria)
                                                <option value="{{ $categoria->nombre }}" data-id="{{ $categoria->id }}">
                                                </option>
                                            @endforeach
                                        </datalist>
                                    @endif
                                </div>
                                <!-- Promoción -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="promocion_id" class="form-label font-sm fw-600">Promoción
                                        (opcional):</label>
                                    <input type="hidden" id="promocion_id" name="promocion_id">
                                    @if ($promocionServicio->isEmpty())
                                        <input list="promociones" placeholder="No hay promociones registradas"
                                            class="form-control" disabled>
                                    @else
                                        <input list="promociones" id="promociones" placeholder="Promociones" value=""
                                            class="form-control" onchange="obtenerPromocionServicio(this.value)" required>
                                        <datalist id="promociones">
                                            @foreach ($promocionServicio as $promocion)
                                                <option value="{{ $promocion->nombre }}" data-id="{{ $promocion->id }}"
                                                    data-precio="{{ $promocion->precio }}">
                                                </option>
                                            @endforeach
                                        </datalist>
                                    @endif
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
                                    <input type="date" class="form-control" id="fecha_caducidad"
                                        name="fecha_caducidad" required />
                                </div>
                                <!-- Precio inscripción -->
                                <div class="input-group-sm col-md-4 mb-3">
                                    <label for="monto_costo" class="form-label font-sm fw-600">Precio de la Inscripcion
                                        (S/.):</label>
                                    <input type="number" step="0.01" class="form-control" id="monto_costo"
                                        name="monto_costo" placeholder="S/. 0.00" required />
                                </div>
                                <!-- Monto pagado -->
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
                                            <option value="{{ $metodo->id }}" data-nombre={{ $metodo->brand->nombre }}
                                                data-imagen="{{ $metodo->foto_qr }}">
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
                            <!-- Botón para continuar y abrir el modal de checkout -->
                            <div class="text-end modal-footer">
                                <button id="continuar_btn" class="btn btn-outline-primary btn-sm"
                                    onclick="validarFormulario(event)"
                                    @if ($metodoPago->count() > 0) @else disabled @endif>
                                    Inscribir
                                </button>
                            </div>

                            <!-- Modal de checkout -->
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
                                                    <img id="feature_img" width="200" height="200"
                                                        class="img-thumbnail border rounded" src=""
                                                        alt="">
                                                </picture>
                                            </div>
                                            <!-- Contenido -->
                                            <div class="">
                                                <h6 class="text-dark font-weight-bold">Cantidad a Pagar</h6>
                                                <h3 class="display-4">S/&nbsp;<span id="cantidad_total_pagar"></span></h3>
                                            </div>
                                            <!-- Fin contenido -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info btn-sm w-100">Realizar
                                                Inscripción</button>
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
    <!-- Incluir los scripts desde inscripcion.partials.scripts -->
    @include('inscripcion.partials.scripts')
@endsection
