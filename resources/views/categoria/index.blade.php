@extends('adminlte::page')

@section('title', 'Gymcrona - Categorias')

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
        <!-- Mostrar mensjae de error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card elevation-0 border">
            <div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
                <div class="input-group input-group-sm border rounded w-auto">
                    <span class="input-group-text border-0 font-sm rounded-0"><svg width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg></span>
                    <input type="text" class="font-sm form-control border-0" placeholder="Buscar categoria"
                        aria-label="search" onkeyup="filtrarCategorias(this.value)">
                </div>
                <button type="button" data-toggle="modal" data-target="#nuevaCategoriaModal"
                    class="ml-auto w-auto btn btn-sm font-sm d-sm-none border rounded"><svg width="18" height="18"
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
                    class="ml-auto w-auto btn btn-sm font-sm d-none d-sm-inline-flex bg-dark">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    @if (session('success'))
                        <div class="alert alert-dismissible fade show text-success font-sm"
                            style="background: rgba(39, 174, 96,.2); border: 1px solid rgba(39,174,96, .3);" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" class="text-success">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <p class="font-sm text-muted">
                            Mostrando
                            <span class="text-primary">{{ $categorias->firstItem() ? $categorias->firstItem() : 0 }}</span>
                            -
                            <span class="text-primary">{{ $categorias->lastItem() ? $categorias->lastItem() : 0 }}</span>
                            de
                            <span class="text-primary">{{ $totalCategorias }}</span>
                            categorias
                        </p>
                    </div>
                    @if ($categorias->count() > 0)
                        <table class="table table-hover" id="categorias">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-sm fw-600">Id</th>
                                    <th scope="col" class="font-sm fw-600">Nombre</th>
                                    <th scope="col" class="font-sm fw-600">Descripcion</th>
                                    <th scope="col" class="font-sm fw-600 text-center">Acciones</th>
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
                                                    class="mr-1 btn btn-success btn-sm rounded font-sm">
                                                    <svg width="20" height="20" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="1"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                        <path d="M16 19h6" />
                                                    </svg>
                                                </a>
                                                <div>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#eliminarCategoriaModal"
                                                        data-id="{{ $categoria->id }}"
                                                        class="btn btn-danger btn-sm font-sm w-100">
                                                        <svg width="20" height="20" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="1"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @else
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Id</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Nombre</th>
                                    <th scope="col" class="font-sm fw-600 text-light-dark">Descripcion</th>
                                </tr>
                            </thead>
                        </table>
                        <div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-6 text-center">
                                    <img class="img-fluid" src="{{ asset('images/icons/empty-state-categories.svg') }}"
                                        width="150" alt="Icon empty state">
                                    <div class="title font-sm">¿Sin registros?</div>
                                    <div class="subtitle text-secondary font-sm">Emecemos agregando unos registros a tu
                                        cuenta</div>
                                    <div class="mt-3">
                                        <button type="button" data-toggle="modal" data-target="#nuevaCategoriaModal"
                                            class="btn btn-primary btn-sm">
                                            Empezar ahora
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
                        <h6 class="modal-title">Nueva categoria</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formNuevaCategoria" action="{{ route('categoria.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group input-group-sm">
                                    <label for="nombre" class="font-sm fw-600">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="font-sm fw-600">Descripción</label>
                                    <textarea class="form-control font-sm" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm font-sm"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary btn-sm font-sm">Registrar categoría</button>
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
                        <h6 class="modal-title">Eliminar categoría</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="borrarCategoriaForm" method="POST" action="">
                        <div class="modal-body">
                            <p class="font-sm">¿Estás seguro de que deseas eliminar esta categoría?</p>
                            @csrf
                            @method('DELETE')
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-outline-danger">Confirmar</button>
                            </div>
                        </div>
                    </form>
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

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
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
