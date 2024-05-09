@extends('adminlte::page')

@section('title', 'Sincrona - Clientes')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Clientes</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card elevation-0 border">
            <div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
                <div class="input-group input-group-sm border rounded w-auto">
                    <span class="input-group-text border-0 font-sm rounded-0"><svg width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg></span>
                    <input type="text" class="font-sm form-control border-0" placeholder="Buscar cliente"
                        aria-label="search" onkeyup="filtrarCliente(this.value)">
                </div>
                <!-- Exportar -->
                <!-- Boton mobile -->
                <a @if (!$clientes->isEmpty()) href="{{ route('cliente.export') }}" @endif
                    class="{{ !$clientes->isEmpty()
                        ? 'btn align-items-center btn-sm d-sm-none border text-primary rounded'
                        : 'btn align-items-center btn-sm d-sm-none border text-primary rounded disabled' }}">
                    <!-- Icono -->
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg>
                    <!-- Fin icono-->
                </a>
                <!-- Fin boton -->

                <!-- Boton desktop -->
                <a @if (!$clientes->isEmpty()) href="{{ route('cliente.export') }}" @endif
                    class="{{ !$clientes->isEmpty()
                        ? 'btn align-items-center btn-secondary btn-sm d-none d-sm-inline-flex'
                        : 'btn align-items-center btn-secondary btn-sm d-none d-sm-inline-flex disabled' }}">
                    <!-- Icono -->
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg>
                    <!-- Fin icono-->
                    &nbsp;Exportar clientes
                </a>
                <!-- Fin boton -->
                <!-- Fin exportar-->

                <!-- Importar -->
                <!-- Boton mobile -->
                <a href="{{ route('cliente.export') }}" class="btn btn-sm text-success d-sm-none border rounded">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M15 15h-6" />
                        <path d="M11.5 17.5l-2.5 -2.5l2.5 -2.5" />
                    </svg>
                </a>
                <!-- Boton desktop -->
                <a href="{{ route('cliente.export') }}"
                    class="btn btn-sm btn-success align-items-center d-none d-sm-inline-flex">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M15 15h-6" />
                        <path d="M11.5 17.5l-2.5 -2.5l2.5 -2.5" />
                    </svg>
                    &nbsp;Importar clientes
                </a>
                <!-- Fin importar-->

                <!-- Registrar clientes-->
                <!-- Boton mobile -->
                <button type="button" data-toggle="modal" data-target="#registrarCliente"
                    class="ml-auto w-auto btn bg-primary align-items-center btn-sm font-sm d-sm-none">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M9 12h6" />
                        <path d="M12 9v6" />
                    </svg>
                </button>
                <!-- Boton desktop -->
                <button type="button" data-toggle="modal" data-target="#registrarCliente"
                    class="ml-auto align-items-center w-auto btn bg-primary btn-sm font-sm d-none d-sm-inline-flex">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M9 12h6" />
                        <path d="M12 9v6" />
                    </svg>
                    &nbsp;Registrar cliente
                </button>
                <!-- Fin registrar cliente -->
            </div>
            <div class="card-body">
                <!-- Mostrar el mensaje que devuelve el controlador -->
                @if (session('success'))
                    <div class="alert alert-dismissible fade show text-success font-sm"
                        style="background: rgba(39, 174, 96,.2); border: 1px solid rgba(39,174,96, .3);" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="text-success">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Fin -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="font-sm text-muted">
                        Mostrando
                        <span class="text-primary">{{ $clientes->firstItem() ? $clientes->firstItem() : 0 }}</span>
                        -
                        <span class="text-primary">{{ $clientes->lastItem() ? $clientes->lastItem() : 0 }}</span>
                        de
                        <span class="text-primary">{{ $totalClientes }}</span>
                        clientes
                    </p>
                </div>
                <div class="table-responsive-md table-borderless">
                    @if ($clientes->count() > 0)
                        <table class="table table-hover" id="clientes">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Nº</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">DNI</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Nombres</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">A. Paterno</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">A. Materno</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Teléfono</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Email</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark text-center">Acciones</th>
                                </tr>
                            </thead>
                            @php $i = 0 @endphp
                            @foreach ($clientes as $cliente)
                                @php $i++ @endphp
                                <tbody>
                                    <tr class="">
                                        <td scope="row" class="font-sm text-muted">{{ $i }}</td>
                                        <td class="font-sm">{{ $cliente->dni }}</td>
                                        <td class="font-sm text-truncate">{{ $cliente->nombres }}</td>
                                        <td class="font-sm text-truncate">{{ $cliente->ap_paterno }}</td>
                                        <td class="font-sm text-truncate">{{ $cliente->ap_materno }}</td>
                                        <td class="font-sm text-truncate">{{ $cliente->telefono }}</td>
                                        <td class="font-sm text-truncate">{{ $cliente->email }}</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="{{ route('cliente.edit', $cliente->id) }}"
                                                    class="mr-1 btn btn-success btn-sm rounded">
                                                    <svg width="20" height="20" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="1"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                        <path d="M16 19h6" />
                                                    </svg>
                                                </a>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#eliminarClienteModal" data-id="{{ $cliente->id }}"
                                                    class="btn btn-danger btn-sm rounded">
                                                    <svg width="20" height="20" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="1"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @else
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Nº</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">DNI</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Nombres</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">A. Paterno</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">A. Materno</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Teléfono</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Email</th>
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
                                        <button type="button" data-toggle="modal" data-target="#registrarCliente"
                                            class="btn btn-primary btn-sm">
                                            Empezar ahora
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
        <!-- Agregar cliente Modal -->
        <div class="modal fade" id="registrarCliente" tabindex="-1" aria-labelledby="nuevaClienteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Registrar cliente</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cliente.store') }}" method="POST">
                            @csrf
                            <div class="row">

                                <!-- DNI -->
                                <div class="col-md-4 mb-3 input-group-sm">
                                    <label for="dni" class="form-label font-sm fw-600">Dni:</label>
                                    <input type="text" class="form-control" id="dni" name="dni"
                                        placeholder="DNI" maxlength="8" required />
                                </div>

                                <!-- Nombres -->
                                <div class="col-md-4 mb-3 input-group-sm">
                                    <label for="nombres" class="form-label font-sm fw-600">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                        placeholder="Nombres" maxlength="50" required />
                                </div>

                                <!-- Apellido paterno -->
                                <div class="col-md-4 mb-3 input-group-sm">
                                    <label for="ap_paterno" class="form-label font-sm fw-600">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno"
                                        placeholder="Apellido Paterno" maxlength="50" required />
                                </div>

                                <!-- Apellido materno -->
                                <div class="col-md-4 mb-3 input-group-sm">
                                    <label for="ap_materno" class="form-label font-sm fw-600">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="ap_materno" name="ap_materno"
                                        placeholder="Apellido Materno" maxlength="50" required />
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-4 mb-3 input-group-sm">
                                    <label for="telefono" class="form-label font-sm fw-600">Teléfono(opcional):</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        placeholder="987654321" maxlength="11" />
                                </div>

                                <!-- Correo -->
                                <div class="col-md-4 mb-3 input-group-sm">
                                    <label for="email" class="form-label font-sm fw-600">Email(opcional):</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="example@gmail.com" maxlength="255" />
                                </div>
                            </div>
                            <div class="text-end modal-footer">
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrar cliente Modal -->
        <div class="modal fade" id="eliminarClienteModal" tabindex="-1" aria-labelledby="eliminarClienteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-sm">¿Estás seguro de que deseas eliminar este cliente?</p>
                        <form id="borrarClienteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-danger">Confirmar</button>
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

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }
    </style>
@endsection

@section('js')
    <script>
        function filtrarCliente(filtro) {
            const filasCliente = document.querySelectorAll("#clientes tbody tr");
            filasCliente.forEach((fila) => {
                const nombreCliente = fila
                    .querySelector("td:nth-child(2)")
                    .textContent.toLowerCase()
                    .trim();
                const dniCliente = fila
                    .querySelector("td:nth-child(3)")
                    .textContent.toLowerCase()
                    .trim();

                if (nombreCliente.includes(filtro) || dniCliente.includes(filtro)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        $('#eliminarClienteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var clienteId = button.data('id');
            var modal = $(this);
            modal.find('#borrarClienteForm').attr('action', '/cliente/' + clienteId);
        });
    </script>
@endsection
