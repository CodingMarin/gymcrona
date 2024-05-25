@extends('adminlte::page')

@section('title', 'Gymcrona - Inicio')
@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-3">
                <x-adminlte-small-box class="text-sm bg-blue-400 text-white" title="{{ $clientes }}"
                    text="Clientes registrados" icon="fas fa-user-plus text-white" url="{{ route('cliente.index') }}"
                    url-text="Ver todos los clientes" />
            </div>
            <div class="col-md-3">
                <x-adminlte-small-box class="text-sm bg-purple-400 text-white" title="{{ $ventas }}"
                    text="Ventas registradas" icon="far fa-handshake text-white" url="{{ route('venta.index') }}"
                    url-text="Registros de venta" />
            </div>
            <div class="col-md-3">
                <x-adminlte-small-box class="text-sm bg-indigo-400 text-white" title="{{ $productos }}"
                    text="Productos registrados" icon="fas fa-box text-white" url="{{ route('producto.index') }}"
                    url-text="Ver todos los productos" />
            </div>
            <div class="col-md-3">
                <x-adminlte-small-box class="text-sm bg-violet-400 text-white" title="{{ $inscripciones }}"
                    text="Total de inscripciones" icon="fas fa-address-card text-white"
                    url="{{ route('inscripcion.index') }}" url-text="Ver todas las incripciones" />
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-sm">Reporte general</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-sm">Total de Ventas por Día</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="ventasPorDiaChart" width="400" height="200"></canvas>
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
        var ctxDoughnut = document.getElementById("myDoughnutChart").getContext('2d');
        var myDoughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: [
                    "Ventas Registradas",
                    "Productos Registrados",
                    "Clientes Registrados",
                    "Inscripciones Realizadas"
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        {{ $ventas }},
                        {{ $productos }},
                        {{ $clientes }},
                        {{ $inscripciones }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxVentasPorDia = document.getElementById('ventasPorDiaChart').getContext('2d');
        var ventasPorDiaChart = new Chart(ctxVentasPorDia, {
            type: 'line',
            data: {
                labels: {!! $ventasPorDia->pluck('fecha') !!},
                datasets: [{
                    label: 'Total de Ventas',
                    data: {!! $ventasPorDia->pluck('total_ventas') !!},
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
