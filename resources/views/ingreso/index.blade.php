@extends('adminlte::page')

@section('title', 'Gymcrona - Ingresos')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Ingresos</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Ingresos</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card elevation-0 border">
            <div class="card-body">
                {{-- Setup data for datatables --}}
                @php
                    $heads = ['Nº', 'Metodo de pago', 'Producto/Servicio', 'Monto', 'Fecha de ingreso'];

                    $config = [
                        'data' => [],
                        'order' => [[1, 'asc']],
                        'columns' => [
                            ['title' => 'Nº', 'width' => 60],
                            ['title' => 'Pago', 'width' => 60],
                            ['title' => 'Producto/Servicio'],
                            ['title' => 'Monto'],
                            ['title' => 'Fecha de ingreso', 'width' => 250],
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
                    foreach ($pagos as $pago) {
                        $i++;
                        $imagen =
                            ' <img width="30" src="' .
                            asset('images/brands/' . $pago->metodoPago->brand->logo) .
                            '" alt="' .
                            $pago->metodoPago->brand->nombre .
                            '"></picture>';

                        $config['data'][] = [$i, $imagen, $pago->producto_servicio, $pago->monto, $pago->created_at];
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
