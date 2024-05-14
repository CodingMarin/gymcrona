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
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-lg table-borderless">
                    <table class="table table-hover" id="clientes">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <thead class="">
                            <tr class="border-bottom" style="background-color: #e9f2ff">
                                <th scope="col" class="font-sm fw-600 text-light-dark">Nº</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Metodo de pago</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Producto ó Servicio</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Monto</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Fecha de ingreso</th>
                            </tr>
                        </thead>
                        @php $i = 0 @endphp
                        @foreach ($pagos as $pago)
                            @php $i++ @endphp
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="font-sm text-muted">{{ $i }}</td>
                                    <td class="font-sm">
                                        <picture>
                                            <img width="30"
                                                src="{{ asset('images/brands/' . $pago->metodoPago->brand->logo) }}"
                                                alt="{{ $pago->metodoPago->brand->nombre }}">
                                        </picture>
                                    </td>
                                    <td class="font-sm">{{ $pago->producto_servicio }}</td>
                                    <td class="font-sm">S/.{{ $pago->monto }}</td>
                                    <td class="font-sm">{{ $pago->created_at }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {{-- {{ $clientes->links() }} --}}
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
