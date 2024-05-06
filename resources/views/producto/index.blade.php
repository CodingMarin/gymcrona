@extends('adminlte::page')

@section('title', 'Sincrona - Productos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Productos</h5>
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Productos</li>
            </ol>
        </div>
    </div>
@stop



@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
                <div class="input-group border rounded w-auto">
                    <span class="input-group-text border-0 font-sm rounded-0"><svg width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg></span>
                    <input type="text" class="font-sm form-control border-0" placeholder="Buscar producto"
                        aria-label="search" onkeyup="filtrarProducto(this.value)">
                </div>
                <a href="{{ route('producto.create') }}" class="ml-auto w-auto btn btn-primary font-sm d-sm-none"><svg
                        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg></a>
                <a href="{{ route('producto.create') }}"
                    class="ml-auto w-auto btn btn-primary font-sm d-none d-sm-inline-flex"><svg width="20"
                        height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg>&nbsp;Nuevo producto</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg table-borderless">
                    <table class="table table-hover" id="productos">
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
                                <span
                                    class="text-primary">{{ $productos->firstItem() ? $productos->firstItem() : 0 }}</span>
                                -
                                <span class="text-primary">{{ $productos->lastItem() ? $productos->lastItem() : 0 }}</span>
                                de
                                <span class="text-primary">{{ $totalProductos }}</span>
                                productos
                            </p>
                        </div>
                        <thead>
                            <tr class="border-bottom">
                                <th scope="col" class="font-sm">Nº</th>
                                <th scope="col" class="font-sm">Imagen</th>
                                <th scope="col" class="font-sm">Nombre</th>
                                <th scope="col" class="font-sm">Descripcion</th>
                                <th scope="col" class="font-sm">Precio</th>
                                <th scope="col" class="font-sm">Stock</th>
                                <th scope="col" class="font-sm">Marca</th>
                                <th scope="col" class="font-sm">Estado</th>
                                <th scope="col" class="font-sm">Categoria</th>
                                <th scope="col" class="font-sm text-center">Acción</th>
                            </tr>
                        </thead>
                        @php $i = 0 @endphp
                        @foreach ($productos as $producto)
                            @php $i++ @endphp
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{ $i }}</td>
                                    <td class="font-sm">
                                        <picture>
                                            <img width="50" src="{{ asset('images/productos/' . $producto->foto_url) }}"
                                                alt="{{ $producto->foto_url }}">
                                        </picture>
                                    </td>
                                    <td class="font-sm">{{ $producto->nombre }}</td>
                                    <td class="font-sm">{{ $producto->descripcion }}</td>
                                    <td class="font-sm">S/. {{ $producto->precio }}</td>
                                    <td class="font-sm">
                                        @if ($producto->stock > 0)
                                            <span>{{ $producto->stock }} en stock</span>
                                        @else
                                            <span class="text-danger">{{ $producto->stock }} en stock</span>
                                        @endif
                                    </td>
                                    <td class="font-sm">{{ $producto->marca }}</td>
                                    <td>
                                        @if ($producto->estado == 1)
                                            <span class="badge badge-success font-weight-normal">Activo</span>
                                        @else
                                            <span class="badge badge-danger font-weight-normal">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $producto->categoriaProducto->nombre }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href=""
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
                                            <a href=""
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
                                                    data-target="#eliminarProductoModal" data-id="{{ $producto->id }}"
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
                                                    data-target="#eliminarProductoModal" data-id="{{ $producto->id }}"
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
                    {{ $productos->links() }}
                </div>
            </div>
        </div>

        <!-- Borrar producto Modal -->
        <div class="modal fade" id="eliminarProductoModal" tabindex="-1" aria-labelledby="eliminarProductoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-sm">¿Estás seguro de que deseas eliminar este producto?</p>
                        <form id="borrarProductoForm" method="POST" action="">
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
        function filtrarProducto(filtro) {
            const filasProducto = document.querySelectorAll("#productos tbody tr");
            filasProducto.forEach((fila) => {
                const nombreProducto = fila
                    .querySelector("td:nth-child(2)")
                    .textContent.toLowerCase()
                    .trim();
                const dniProducto = fila
                    .querySelector("td:nth-child(3)")
                    .textContent.toLowerCase()
                    .trim();

                if (nombreProducto.includes(filtro) || dniProducto.includes(filtro)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        $('#eliminarProductoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var productoId = button.data('id');
            var modal = $(this);
            modal.find('#borrarProductoForm').attr('action', '/producto/' + productoId);
        });
    </script>
@endsection
