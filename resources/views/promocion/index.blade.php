@extends('adminlte::page')

@section('title', 'Sincrona - Promociones')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Promociones</h5>
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Todas las promociones</li>
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
                    <input type="text" class="font-sm form-control border-0" placeholder="Buscar" aria-label="search"
                        onkeyup="filtrarPromocion(this.value)">
                </div>
                <button type="button" data-toggle="modal" data-target="#agregarPromocionModal"
                    class="ml-auto w-auto btn bg-info font-sm d-sm-none"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path
                            d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                        <path
                            d="M12.5 13.847l-1.5 1.153l.532 -1.857l-1.532 -1.143h1.902l.598 -1.8l.598 1.8h1.902l-1.532 1.143l.532 1.857z" />
                    </svg></button>
                <button type="button" data-toggle="modal" data-target="#agregarPromocionModal"
                    class="ml-auto w-auto btn bg-info font-sm d-none d-sm-inline-flex"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path
                            d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                        <path
                            d="M12.5 13.847l-1.5 1.153l.532 -1.857l-1.532 -1.143h1.902l.598 -1.8l.598 1.8h1.902l-1.532 1.143l.532 1.857z" />
                    </svg>&nbsp;Agregar promo</button>
            </div>
            <div class="card-body">
                <div class="table-responsive-md table-borderless">
                    <table class="table table-hover" id="promocion">
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
                                <span class="text-primary">{{ $promociones->firstItem() }}</span>
                                -
                                <span class="text-primary">{{ $promociones->lastItem() }}</span>
                                de
                                <span class="text-primary">{{ $totalPromociones }}</span>
                                promociones
                            </p>
                        </div>
                        <thead>
                            <tr class="table-primary">
                                <th scope="col" class="font-sm fw-600">Nº</th>
                                <th scope="col" class="font-sm fw-600">Tipo Promocion</th>
                                <th scope="col" class="font-sm fw-600">Descripción</th>
                                <th scope="col" class="font-sm fw-600">Precio</th>
                                <th scope="col" class="font-sm fw-600 text-center">Acción</th>
                            </tr>
                        </thead>
                        @php $i = 0 @endphp
                        @foreach ($promociones as $promocion)
                            @php $i++ @endphp
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="font-sm">{{ $i }}</td>
                                    <td class="font-sm">{{ $promocion->nombre }}</td>
                                    <td class="font-sm">{{ $promocion->descripcion }}</td>
                                    <td class="font-sm">S/. {{ $promocion->precio }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="" class="mr-1 btn btn-success btn-sm rounded font-sm d-sm-none">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                    <path d="M16 19h6" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('promocion.edit', $promocion->id) }}"
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
                                                    data-target="#eliminarCategoriaModal" data-id="{{ $promocion->id }}"
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
                                                    data-target="#eliminarCategoriaModal" data-id="{{ $promocion->id }}"
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
                    {{ $promociones->links() }}
                </div>
            </div>
        </div>
        <!-- Agregar promocion Modal -->
        <div class="modal fade" id="agregarPromocionModal" tabindex="-1" aria-labelledby="agregarPromocionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Promocion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formNuevaPromocion" action="{{ route('promocion.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre" class="font-sm">Nombre (promocion)</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="font-sm">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="precio" class="font-sm">Precio</label>
                                    <input class="form-control" id="precio" name="precio" type="number"
                                        min="0.00" max="10000.00" step="0.01" required />
                                    @error('precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary font-sm"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary font-sm">Registrar categoría</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrar categoria Modal -->
        <div class="modal fade" id="eliminarPromocionModal" tabindex="-1" aria-labelledby="eliminarPromocionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Promocion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-sm">¿Estás seguro de que deseas eliminar esta promocion?</p>
                        <form id="borrarPromocionForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn w-100 mb-2 btn-outline-secondary"
                                data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn w-100 btn-outline-danger">Confirmar</button>
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
        function filtrarPromocion(filtro) {
            const filasPromocion = document.querySelectorAll("#promocion tbody tr");
            filasPromocion.forEach((fila) => {
                const nombrePromocion = fila
                    .querySelector("td:nth-child(2)")
                    .textContent.toLowerCase()
                    .trim();
                if (nombrePromocion.includes(filtro)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        $('#eliminarPromocionModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var promocionId = button.data('id');
            var modal = $(this);
            modal.find('#borrarPromocionForm').attr('action', '/promocion/' + promocionId);
        });
    </script>
@endsection
