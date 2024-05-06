@extends('adminlte::page')

@section('title', 'Sincrona - Categorias')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Categorias</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Categorias</li>
                </ol>
            </div>
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
                        onkeyup="filtrarCategorias(this.value)">
                </div>
                <button type="button" data-toggle="modal" data-target="#nuevaCategoriaModal"
                    class="ml-auto w-auto btn btn-info font-sm d-sm-none"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                        <path d="M3 10h18" />
                        <path d="M10 3v18" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                    </svg></button>
                <button type="button" data-toggle="modal" data-target="#nuevaCategoriaModal"
                    class="ml-auto w-auto btn btn-info font-sm d-none d-sm-inline-flex"><svg width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                        <path d="M3 10h18" />
                        <path d="M10 3v18" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                    </svg>&nbsp;Nueva Categoria</button>
            </div>
            <div class="card-body">
                <div class="table-responsive-md table-borderless">
                    <table class="table table-hover" id="categorias">
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
                                <span class="text-primary">{{ $categorias->firstItem() }}</span>
                                -
                                <span class="text-primary">{{ $categorias->lastItem() }}</span>
                                de
                                <span class="text-primary">{{ $totalCategorias }}</span>
                                categorias
                            </p>
                        </div>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Id</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Nombre</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Descripcion</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark text-center">Acciones</th>
                            </tr>
                        </thead>
                        @php $i = 0 @endphp
                        @foreach ($categorias as $categoria)
                            @php $i++ @endphp
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="font-sm text-muted">{{ $i }}</td>
                                    <td class="font-sm">{{ $categoria->nombre }}</td>
                                    <td class="font-sm text-truncate">{{ $categoria->descripcion }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ route('categoria.edit', $categoria->id) }}"
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
                                            <a href="{{ route('categoria.edit', $categoria->id) }}"
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
                                                    data-target="#eliminarCategoriaModal" data-id="{{ $categoria->id }}"
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
                                                    data-target="#eliminarCategoriaModal" data-id="{{ $categoria->id }}"
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
                    {{ $categorias->links() }}
                </div>
            </div>
        </div>

        <!-- Agregar categoria Modal -->
        <div class="modal fade" id="nuevaCategoriaModal" tabindex="-1" aria-labelledby="nuevaCategoriaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formNuevaCategoria" action="{{ route('categoria.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre" class="font-sm">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="font-sm">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
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
        <div class="modal fade" id="eliminarCategoriaModal" tabindex="-1" aria-labelledby="eliminarCategoriaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-sm">¿Estás seguro de que deseas eliminar esta categoría?</p>
                        <form id="borrarCategoriaForm" method="POST" action="">
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
        function filtrarCategorias(filtro) {
            const filasCategorias = document.querySelectorAll("#categorias tbody tr");
            filasCategorias.forEach((fila) => {
                const idCategoria = fila
                    .querySelector("td:nth-child(1)")
                    .textContent.toLowerCase()
                    .trim();
                const nombreCategoria = fila
                    .querySelector("td:nth-child(2)")
                    .textContent.toLowerCase()
                    .trim();
                const descripcionCategoria = fila
                    .querySelector("td:nth-child(3)")
                    .textContent.toLowerCase()
                    .trim();

                if (idCategoria.includes(filtro) || nombreCategoria.includes(filtro) || descripcionCategoria
                    .includes(filtro)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        $('#eliminarCategoriaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var categoryId = button.data('id');
            var modal = $(this);
            modal.find('#borrarCategoriaForm').attr('action', '/categoria/' + categoryId);
        });
    </script>
@endsection
