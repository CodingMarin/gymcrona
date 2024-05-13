@extends('adminlte::page')

@section('title', 'Gymcrona - Metodos de Pago')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Metodos de pago</h5>
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Mis metodos de pago</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <!-- Mostrar mensaje satisfactorio -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Mostrar mensjae de error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
                        onkeyup="filtrarMetodoPago(this.value)">
                </div>
                <button type="button" data-toggle="modal" data-target="#nuevoMetodoPagoModal"
                    class="ml-auto w-auto btn btn-primary font-sm d-sm-none"><svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg></button>
                <button type="button" data-toggle="modal" data-target="#nuevoMetodoPagoModal"
                    class="ml-auto w-auto btn btn-primary font-sm d-none d-sm-inline-flex"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M12 9.765a3 3 0 1 0 0 4.47" />
                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    </svg>&nbsp;Agregar</button>
            </div>
            <div class="card-body">
                <div class="table-responsive-md table-borderless">
                    <table class="table table-hover" id="metodosPago">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <p class="font-sm text-muted">
                                Mostrando
                                <span class="text-primary">{{ $metodosPago->firstItem() }}</span>
                                -
                                <span class="text-primary">{{ $metodosPago->lastItem() }}</span>
                                metodos de pago
                            </p>
                        </div>
                        <thead class="">
                            <tr class="" style="background-color: #e9f2ff">
                                <th scope="col" class="font-sm fw-600 text-light-dark">Nº</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Tipo</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">Logo</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark">QR</th>
                                <th scope="col" class="font-sm fw-600 text-light-dark text-center">Acciones</th>
                            </tr>
                        </thead>
                        @php $i = 0 @endphp
                        @foreach ($metodosPago as $metodoPago)
                            @php $i++ @endphp
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="font-sm text-muted">{{ $i }}</td>
                                    <td class="font-sm">{{ $metodoPago->brand->nombre }}</td>
                                    <td class="font-sm">
                                        <picture>
                                            <img width="30"
                                                src="{{ asset('images/brands/' . $metodoPago->brand->logo) }}"
                                                alt="{{ $metodoPago->brand->nombre }}">
                                        </picture>
                                    </td>
                                    <td class="font-sm">
                                        <picture>
                                            <img width="100"
                                                src="{{ asset('images/payments/' . $metodoPago->foto_qr) }}"
                                                alt="{{ $metodoPago->brand->nombre }}">
                                        </picture>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ route('metodo-pago.edit', $metodoPago->id) }}"
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
                                            <a href="{{ route('metodo-pago.edit', $metodoPago->id) }}"
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
                                                    data-target="#eliminarMetodoPagoModal"
                                                    data-id="{{ $metodoPago->id }}"
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
                                                    data-target="#eliminarMetodoPagoModal"
                                                    data-id="{{ $metodoPago->id }}"
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
                    {{ $metodosPago->links() }}
                </div>
            </div>
        </div>

        <!-- Agregar metodo pago Modal -->
        <div class="modal fade" id="nuevoMetodoPagoModal" tabindex="-1" aria-labelledby="nuevoMetodoPagoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-sm">Agregar metodo de pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formNuevoMetodoPago" action="{{ route('metodo-pago.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="brand_id" class="font-sm">Marca</label>
                                    <select class="form-control" id="brand_id" name="brand_id" required>
                                        <option value="">Seleccione una marca</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="foto_qr" class="form-label font-sm">Subir QR:</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control-file" id="foto_qr" name="foto_qr"
                                            onchange="previewImage(this)" required>
                                    </div>
                                    <div id="imagePreview" class="mt-2 text-center"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary font-sm"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary font-sm">Registrar método de pago</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrar metodo pago Modal -->
        <div class="modal fade" id="eliminarMetodoPagoModal" tabindex="-1"
            aria-labelledby="eliminarMetodoPagoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar metodo de pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-sm">¿Estás seguro de que deseas eliminar el metodo de pago?</p>
                        <form id="borrarMetodoPagoForm" method="POST" action="">
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
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');
                    img.style.maxHeight = '300px';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function filtrarMetodoPago(filtro) {
            const filasMetodoPago = document.querySelectorAll("#metodosPago tbody tr");
            filasMetodoPago.forEach((fila) => {
                const nombreMetodoPago = fila
                    .querySelector("td:nth-child(2)")
                    .textContent.toLowerCase()
                    .trim();
                if (nombreMetodoPago.includes(filtro)) {
                    fila.style.display = "table-row";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        $('#eliminarMetodoPagoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var metodoPagoId = button.data('id');
            var modal = $(this);
            modal.find('#borrarMetodoPagoForm').attr('action', '/metodo-pago/' + metodoPagoId);
        });
    </script>
@endsection
