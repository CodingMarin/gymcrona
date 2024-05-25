@extends('adminlte::page')

@section('title', 'Gymcrona - Clientes')

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
        <!-- Mostrar mensjae de error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Mostrar mensjae de satisfacción -->
        @if (session('success'))
            <div class="alert alert-dismissible fade show text-success font-sm"
                style="background: rgba(39, 174, 96,.2); border: 1px solid rgba(39,174,96, .3);" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-success">&times;</span>
                </button>
            </div>
        @endif
        <div class="card elevation-0 border">
            <div class="card-header">
                <!-- Boton desktop -->
                <button type="button" data-toggle="modal" data-target="#registrarCliente"
                    class="ml-auto w-auto btn btn-outline-primary btn-sm font-sm d-none d-sm-inline-flex align-items-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg>
                    &nbsp;Registrar cliente
                </button>
            </div>
            <div class="card-body">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'Nº',
                        'Dni',
                        'Nombres',
                        'A. Paterno',
                        'A. Materno',
                        'Teléfono',
                        'Email',
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
                    ];

                    $config = [
                        'data' => [],
                        'order' => [[1, 'asc']],
                        'columns' => [
                            ['title' => 'Nº'],
                            ['title' => 'Dni'],
                            ['title' => 'Nombres'],
                            ['title' => 'A. Paterno'],
                            ['title' => 'A. Materno'],
                            ['title' => 'Teléfono'],
                            ['title' => 'Email'],
                            ['title' => 'Acciones', 'orderable' => false],
                        ],
                        'language' => [
                            'sProcessing' => 'Procesando...',
                            'sLengthMenu' => 'Mostrar _MENU_ registros',
                            'sZeroRecords' => 'No se encontraron resultados',
                            'sEmptyTable' => 'Ningún dato disponible en esta tabla',
                            'sInfo' => 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                            'sInfoEmpty' => 'Mostrando registros del 0 al 0 de un total de 0 registros',
                            'sInfoFiltered' => '(filtrado de un total de _MAX_ registros)',
                            'sInfoPostFix' => '',
                            'sSearch' => 'Buscar:',
                            'sUrl' => '',
                            'sInfoThousands' => ',',
                            'sLoadingRecords' => 'Cargando...',
                            'oPaginate' => [
                                'sFirst' => 'Primero',
                                'sLast' => 'Último',
                                'sNext' => 'Siguiente',
                                'sPrevious' => 'Anterior',
                            ],
                            'oAria' => [
                                'sSortAscending' => ': Activar para ordenar la columna de manera ascendente',
                                'sSortDescending' => ': Activar para ordenar la columna de manera descendente',
                            ],
                            'buttons' => [
                                'copy' => 'Copiar',
                                'colvis' => 'Visibilidad',
                                'print' => 'Imprimir',
                            ],
                        ],
                    ];

                    $i = 0;
                    foreach ($clientes as $cliente) {
                        $i++;

                        $editLink = route('cliente.edit', $cliente->id);

                        // Boton para editar el cliente
                        $btn_edit =
                            '<a href="' .
                            $editLink .
                            '" class="btn btn-xs btn-default text-primary mx-1 rounded" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

                        // Boton para borrar el cliente
                        $btn_delete =
                            '<button type="button" data-toggle="modal" data-target="#eliminarClienteModal" data-id="' .
                            $cliente->id .
                            '" class="btn btn-xs btn-default text-danger mx-1 rounded" title="Borrar">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>';

                        // Boton para ver detalles del cliente
                        $btn_details = '<button class="btn btn-xs btn-default text-teal mx-1 rounded" title="Detalles">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>';

                        $config['data'][] = [
                            $i,
                            $cliente->dni,
                            $cliente->nombres,
                            $cliente->ap_paterno,
                            $cliente->ap_materno,
                            $cliente->telefono,
                            $cliente->email,
                            '<nobr>' . $btn_edit . $btn_delete . $btn_details . '</nobr>',
                        ];
                    }
                @endphp
                {{-- Componente Datatable --}}
                <x-adminlte-datatable id="tb_clientes" class="font-sm" :heads="$heads" head-theme="light"
                    :config="$config" hoverable with-buttons />
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
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('js')
    <script>
        $('#eliminarClienteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var clienteId = button.data('id');
            var modal = $(this);
            modal.find('#borrarClienteForm').attr('action', '/cliente/' + clienteId);
        });
    </script>
@endsection
