@extends('adminlte::page')

@section('title', 'Gymcrona - Ventas')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Ventas</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado Ventas</li>
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
                <a href="{{ route('venta.create') }}"
                    class="ml-auto w-auto btn btn-outline-primary btn-sm font-sm d-none d-sm-inline-flex align-items-center">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg>
                    &nbsp;Nueva venta
                </a>
            </div>
            <div class="card-body">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'Nº',
                        'Fecha',
                        'Cliente',
                        'Medio(pago)',
                        'Total',
                        'Estado',
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
                    ];

                    $config = [
                        'data' => [],
                        'order' => [[1, 'asc']],
                        'columns' => [
                            ['title' => 'Nº'],
                            ['title' => 'Fecha'],
                            ['title' => 'Cliente'],
                            ['title' => 'Medio(pago)'],
                            ['title' => 'Total'],
                            ['title' => 'Estado'],
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
                    foreach ($ventas as $venta) {
                        $i++;
                        // Boton para ver detalles del cliente
                        $btn_disabled = '<button class="btn btn-xs btn-default text-teal mx-1 rounded" title="Detalles">
                                    <svg width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                        <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                        <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                        <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                        <path d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                                        <path d="M10 11v-2a2 2 0 1 1 4 0v2" />
                                    </svg>
                                </button>';

                        $config['data'][] = [
                            $i,
                            $venta->fecha_venta,
                            $venta->nombre_cliente,
                            $venta->nombre_metodo_pago,
                            $venta->monto_total,
                            $venta->estado,
                            '<nobr>' . $btn_disabled . '</nobr>',
                        ];
                    }
                @endphp
                {{-- Componente Datatable --}}
                <x-adminlte-datatable id="tb_clientes" class="font-sm" :heads="$heads" head-theme="light"
                    :config="$config" hoverable with-buttons />
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
