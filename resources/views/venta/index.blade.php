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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
                <!-- Filtrar -->
                <div class="input-group input-group-sm border rounded w-auto">
                    <span class="input-group-text border-0 font-sm rounded-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M4 6l8 0" />
                            <path d="M16 6l4 0" />
                            <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M4 12l2 0" />
                            <path d="M10 12l10 0" />
                            <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M4 18l11 0" />
                            <path d="M19 18l1 0" />
                        </svg>
                    </span>
                    <input type="date" class="font-sm form-control border-0" onchange="filtrarVentas(this.value)">
                </div>
                <!-- Boton Mobile-->
                <a href="{{ route('venta.create') }}"
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
                <a href="{{ route('venta.create') }}"
                    class="ml-auto w-auto btn btn-primary btn-sm font-sm d-none d-sm-inline-flex align-items-center">
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
                @if (session('success'))
                    <div class="alert alert-dismissible fade show text-success font-sm"
                        style="background: rgba(39, 174, 96,.2); border: 1px solid rgba(39,174,96, .3);" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="text-success">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive-lg table-borderless">
                    @if ($totalVentas->count() > 0)
                        <table class="table table-hover" id="ventas">
                            <thead>
                                <tr class="border-bottom">
                                    <th scope="col" class="font-sm fw-600">Nº</th>
                                    <th scope="col" class="font-sm fw-600">Fecha</th>
                                    <th scope="col" class="font-sm fw-600">Cliente</th>
                                    <th scope="col" class="font-sm fw-600">Medio(pago)</th>
                                    <th scope="col" class="font-sm fw-600">Total</th>
                                    <th scope="col" class="font-sm fw-600">Estado</th>
                                </tr>
                            </thead>
                            @php $i = 0 @endphp
                            @foreach ($ventas as $venta)
                                @php $i++ @endphp
                                <tbody>
                                    <tr class="{{ session('nueva_venta') == $venta->id ? 'bg-blue-100' : '' }}">
                                        <td scope="row">{{ $i }}</td>
                                        <td class="font-sm">{{ $venta->fecha_venta }}</td>
                                        <td class="font-sm">{{ $venta->nombre_cliente }}</td>
                                        <td class="font-sm">{{ $venta->nombre_metodo_pago }}</td>
                                        <td class="font-sm">S/.{{ $venta->monto_total }}</td>
                                        <td class="font-sm">{{ $venta->estado }}</td>
                                        <td>
                                            <a href=""
                                                class="mr-1 btn btn-success btn-sm rounded font-sm d-sm-none align-items-center">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                    <path
                                                        d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                                                    <path d="M10 11v-2a2 2 0 1 1 4 0v2" />
                                                </svg>
                                            </a>
                                            <a href=""
                                                class="mr-1 btn btn-warning text-white btn-sm rounded font-sm d-none d-sm-inline-flex align-items-center">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="mr-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                    <path
                                                        d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                                                    <path d="M10 11v-2a2 2 0 1 1 4 0v2" />
                                                </svg>
                                                Anular
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
                                    <th scope="col" class="font-sm fw-600">Fecha</th>
                                    <th scope="col" class="font-sm fw-600">Cliente</th>
                                    <th scope="col" class="font-sm fw-600">Medio(pago)</th>
                                    <th scope="col" class="font-sm fw-600">Total</th>
                                    <th scope="col" class="font-sm fw-600">Estado</th>
                                </tr>
                            </thead>
                        </table>
                        <div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-6 text-center">
                                    <img class="img-fluid" src="{{ asset('images/icons/empty-state-categories.svg') }}"
                                        width="150" alt="Icon empty state">
                                    <div class="title font-sm">¿Sin ventas?</div>
                                    <div class="subtitle text-secondary font-sm">Emecemos agregando unos registros a tu
                                        cuenta</div>
                                    <div class="mt-3">
                                        <a href="{{ route('venta.create') }}" class="btn btn-primary btn-sm">
                                            Empezar ahora
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
    </style>
@endsection

@section('js')
    <script>
        function filtrarVentas(fechaFiltro) {
            console.log(fechaFiltro);

            const filasVenta = document.querySelectorAll("#ventas tbody tr");
            filasVenta.forEach((fila) => {
                const fechaVenta = fila
                    .querySelector("td:nth-child(2)")
                    .textContent.toLowerCase()
                    .trim();


                if (fechaVenta.includes(fechaFiltro)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        }
    </script>
@endsection
