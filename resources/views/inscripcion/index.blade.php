@extends('adminlte::page')

@section('title', 'Gymcrona - Inscripciones')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Inscripcioness</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Inscripciones</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
                <!-- Filtrar -->
                <div class="input-group input-group-sm border rounded w-auto">
                    <span class="input-group-text border-0 font-sm rounded-0"><svg width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg></span>
                    <input type="text" class="font-sm form-control border-0" placeholder="Buscar inscripción"
                        aria-label="search" onkeyup="filtrarProducto(this.value)">
                </div>
                <!-- Fin-->

                <!-- Registar inscripcion -->
                <!-- Boton Mobile-->
                <a href="{{ route('inscripcion.create') }}"
                    class="ml-auto w-auto btn font-sm d-sm-none border rounded text-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg>
                </a>
                <!-- Boton desktop -->
                <a href="{{ route('inscripcion.create') }}"
                    class="ml-auto w-auto btn btn-primary btn-sm font-sm d-none d-sm-inline-flex">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg>
                    &nbsp;Nueva inscripcion
                </a>
                <!-- Fin registrar -->
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-dismissible fade show text-success font-sm"
                        style="background: rgba(39, 174, 96,.2); border: 1px solid rgba(39,174,96, .3);" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="text-success">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="font-sm text-muted">
                        Mostrando
                        <span
                            class="text-primary">{{ $inscripciones->firstItem() ? $inscripciones->firstItem() : 0 }}</span>
                        -
                        <span class="text-primary">{{ $inscripciones->lastItem() ? $inscripciones->lastItem() : 0 }}</span>
                        de
                        <span class="text-primary">{{ $totalInscripciones }}</span>
                        inscripciones
                    </p>
                </div>
                <div class="d-flex justify-content-start my-2">
                    <div class="badge badge-warning p-2 fw-600">
                        Tienes <span class="text-primary">{{ $inscripcionesPorVencer }}</span> inscripciones por
                        vencer
                    </div>
                </div>
                <div class="table-responsive-lg table-borderless">
                    @if ($inscripciones->count() > 0)
                        <table class="table table-hover" id="inscripciones">
                            <thead>
                                <tr class="border-bottom">
                                    <th scope="col" class="font-sm fw-600">Nº</th>
                                    <th scope="col" class="font-sm fw-600">Cliente</th>
                                    <th scope="col" class="font-sm fw-600">Servicio</th>
                                    <th scope="col" class="font-sm fw-600">Promoción</th>
                                    <th scope="col" class="font-sm fw-600">Estado</th>
                                    <th scope="col" class="font-sm fw-600">Fecha I.</th>
                                    <th scope="col" class="font-sm fw-600">Fecha V.</th>
                                    <th scope="col" class="font-sm fw-600">Precio</th>
                                    <th scope="col" class="font-sm fw-600">Adelantó</th>
                                    <th scope="col" class="font-sm fw-600">Deuda</th>
                                    <th scope="col" class="font-sm fw-600">Acción</th>
                                </tr>
                            </thead>
                            @php $i = 0 @endphp
                            @foreach ($inscripciones as $inscripcion)
                                @php $i++ @endphp
                                <tbody>
                                    <tr class="{{ session('new_user_id') == $inscripcion->id ? 'bg-blue-100' : '' }}">
                                        <td scope="row">{{ $i }}</td>
                                        {{-- <td class="font-sm">{{ $inscripcion->numero_boleta }}</td> --}}
                                        <td class="font-sm">{{ $inscripcion->cliente->nombres }}</td>
                                        <td class="font-sm">{{ $inscripcion->categoriaServicio->nombre }}
                                        </td>
                                        <td class="font-sm">{{ $inscripcion->promocionServicio->nombre }}
                                        </td>
                                        <td class="font-sm">
                                            @if ($inscripcion->estado->id == 1)
                                                <span
                                                    class="badge badge-success font-weight-normal">{{ $inscripcion->estado->nombre }}</span>
                                            @elseif ($inscripcion->estado->id == 2)
                                                <span
                                                    class="badge badge-warning font-weight-normal">{{ $inscripcion->estado->nombre }}</span>
                                            @elseif($inscripcion->estado->id == 3)
                                                <span
                                                    class="badge badge-danger font-weight-normal">{{ $inscripcion->estado->nombre }}</span>
                                            @endif
                                        </td>
                                        <td class="font-sm">{{ $inscripcion->fecha_emision }}</td>
                                        <td class="font-sm">{{ $inscripcion->fecha_caducidad }}</td>
                                        <td class="font-sm">S/.{{ $inscripcion->monto_costo }}</td>
                                        <td class="font-sm">S/.{{ $inscripcion->monto_pago }}</td>
                                        <td class="font-sm text-danger">S/.{{ $inscripcion->monto_deuda }}</td>
                                        <td>
                                            <a href="{{ route('inscripcion.edit', $inscripcion->id) }}"
                                                class="mr-1 btn btn-success btn-sm rounded font-sm d-sm-none">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                    <path d="M16 19h6" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('inscripcion.edit', $inscripcion->id) }}"
                                                class="mr-1 btn btn-success btn-sm rounded font-sm d-none d-sm-inline-flex">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                    <path d="M16 19h6" />
                                                </svg>
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @else
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr class="border-bottom">
                                    <th scope="col" class="font-sm fw-600">Nº</th>
                                    <th scope="col" class="font-sm fw-600">Cliente</th>
                                    <th scope="col" class="font-sm fw-600">Servicio</th>
                                    <th scope="col" class="font-sm fw-600">Promoción</th>
                                    <th scope="col" class="font-sm fw-600">Estado</th>
                                    <th scope="col" class="font-sm fw-600">Fecha I.</th>
                                    <th scope="col" class="font-sm fw-600">Fecha V.</th>
                                    <th scope="col" class="font-sm fw-600">Precio</th>
                                    <th scope="col" class="font-sm fw-600">Adelantó</th>
                                    <th scope="col" class="font-sm fw-600">Deuda</th>
                                </tr>
                            </thead>
                        </table>
                        <div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-6 text-center">
                                    <img class="img-fluid" src="{{ asset('images/icons/empty-state-categories.svg') }}"
                                        width="150" alt="Icon empty state">
                                    <div class="title font-sm">¿Sin registros?</div>
                                    <div class="subtitle text-secondary font-sm">Emecemos agregando unos registros a tu
                                        cuenta</div>
                                    <div class="mt-3">
                                        <button type="button" data-toggle="modal" data-target="#nuevaCategoriaModal"
                                            class="btn btn-primary btn-sm">
                                            Empezar ahora
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{ $inscripciones->links() }}
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
    <script></script>
@endsection
