@extends('adminlte::page')

@section('title', 'Sincrona - Clientes')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Clientes</h5>
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card elevation-0 border">
            <div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
                <div class="input-group border rounded w-auto">
                    <span class="input-group-text border-0 font-sm rounded-0"><svg width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg></span>
                    <input type="text" class="font-sm form-control border-0" placeholder="Buscar" aria-label="search"
                        onkeyup="filtrarCliente(this.value)">
                </div>
                <!-- Exportar -->
                <a href="{{ route('cliente.export') }}" class="btn btn-dark d-sm-none">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg></a>
                <a href="{{ route('cliente.export') }}" class="btn btn-secondary d-none d-sm-inline-flex">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg>
                    &nbsp;Exportar
                </a>
                <!-- Fin exportar-->

                <!-- Importar -->
                <a href="{{ route('cliente.export') }}" class="btn btn-dark d-sm-none">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg></a>
                <a href="{{ route('cliente.export') }}" class="btn btn-secondary d-none d-sm-inline-flex">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg>
                    &nbsp;Importar
                </a>
                <!-- Fin importar-->

                <button type="button" data-toggle="modal" data-target="#registrarCliente"
                    class="ml-auto w-auto btn bg-primary font-sm d-sm-none"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg></button>
                <button type="button" data-toggle="modal" data-target="#registrarCliente"
                    class="ml-auto w-auto btn bg-primary font-sm d-none d-sm-inline-flex"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                        <path
                            d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                        <path d="M16 15l2 6l2 -6" />
                    </svg>&nbsp;Registrar cliente</button>
            </div>
            <div class="card-body">
                <div class="table-responsive-md table-borderless">
                    <table class="table table-hover" id="clientes">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <p class="font-sm text-muted">
                                Mostrando
                                <span class="text-primary">{{ $clientes->firstItem() }}</span>
                                -
                                <span class="text-primary">{{ $clientes->lastItem() }}</span>
                                de
                                <span class="text-primary">{{ $totalClientes }}</span>
                                clientes
                            </p>
                        </div>
                        <thead class="">
                            <tr class="" style="background-color: #e9f2ff">
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
                                            <a href="{{ route('cliente.edit', $cliente->id) }}"
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
                                            <div>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#eliminarCategoriaModal" data-id="{{ $cliente->id }}"
                                                    class="btn btn-danger btn-sm font-sm w-100 d-sm-none">
                                                    <svg width="20" height="20" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#eliminarClienteModal" data-id="{{ $cliente->id }}"
                                                    class="btn btn-danger btn-sm font-sm w-100 d-none d-sm-inline-flex">
                                                    <svg width="20" height="20" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
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
                        <h5 class="modal-title">Registrar cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cliente.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- DNI -->
                                <div class="col-md-4 mb-3">
                                    <label for="dni" class="form-label font-sm">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni"
                                        placeholder="DNI" maxlength="8" required />
                                </div>
                                <!-- Nombres -->
                                <div class="col-md-4 mb-3">
                                    <label for="nombres" class="form-label font-sm">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                        placeholder="Nombres" maxlength="50" required />
                                </div>
                                <!-- Apellido paterno -->
                                <div class="col-md-4 mb-3">
                                    <label for="ap_paterno" class="form-label font-sm">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno"
                                        placeholder="Apellido Paterno" maxlength="50" required />
                                </div>
                                <!-- Apellido materno -->
                                <div class="col-md-4 mb-3">
                                    <label for="ap_materno" class="form-label font-sm">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="ap_materno" name="ap_materno"
                                        placeholder="Apellido Materno" maxlength="50" required />
                                </div>
                                <!-- Teléfono -->
                                <div class="col-md-4 mb-3">
                                    <label for="telefono" class="form-label font-sm">Teléfono(opcional):</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        placeholder="Teléfono" maxlength="11" />
                                </div>
                                <!-- Correo -->
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label font-sm">Email(opcional):</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email" maxlength="255" />
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

        .fw-600 {
            font-weight: 600;
        }

        .text-light-dark {
            color: #172B4D;
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
