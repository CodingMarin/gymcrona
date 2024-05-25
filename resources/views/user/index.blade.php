@extends('adminlte::page')

@section('title', 'Metodos de Pago')

@section('content_header')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="font-weight-bold">Perfil</h5>
                <ol class="breadcrumb font-sm">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Configuración de perfil</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card elevation-0 border">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-sm-6">
                <h3 class="card-title font-sm">Datos personales</h3>
            </div>
            <div class="col-sm-6 text-right">
                <a type="button" id="btn_edit" class="text-primary mt-2 font-sm text-truncate">Editar</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Foto Perfil -->
            <div class="form-group row">
                <label for="inputFotoPerfil" class="col-sm-2 col-form-label font-sm fw-600">
                    <span class="d-flex align-items-center">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-2"
                            style="background-color: #E3E3E3; width:30px; height:30px">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 8h.01" />
                                <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                            </svg>
                        </div>
                        Perfil:
                    </span>
                </label>
                <div class="col-sm-4">
                    <picture>
                        <img class="rounded border"
                            src="{{ asset('images/' . ($user->foto_url ? $user->foto_url : 'picture-default.svg')) }}"
                            alt="{{ $user->name }}" width="60" id="profilePicture">
                    </picture>
                    <input type="file" class="form-control font-sm mt-2" id="inputFotoPerfil" style="display:none;">
                </div>
            </div>
            <!-- Nombre -->
            <div class="form-group row align-items-center">
                <label for="name" class="col-sm-2 col-form-label font-sm fw-600">
                    <span class="d-flex align-items-center">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-2"
                            style="background-color: #E3E3E3; width:30px; height:30px">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </div>
                        Nombre:
                    </span>
                </label>
                <div class="col-sm-4 input-group-sm">
                    <input type="text" class="form-control font-sm" id="name" name="name"
                        value="{{ $user->name }}" readonly>
                </div>
            </div>
            <!-- Ruc -->
            <div class="form-group row align-items-center">
                <label for="ruc" class="col-sm-2 col-form-label font-sm fw-600">
                    <span class="d-flex align-items-center">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-2"
                            style="background-color: #E3E3E3; width:30px; height:30px">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M15 8l2 0" />
                                <path d="M15 12l2 0" />
                                <path d="M7 16l10 0" />
                            </svg>
                        </div>
                        Ruc:
                    </span>
                </label>
                <div class="col-sm-4 input-group-sm">
                    <input type="text" class="form-control font-sm" id="ruc" name="ruc"
                        value="{{ $user->ruc ? $user->ruc : 'N/A' }}" readonly>
                </div>
            </div>
            <!-- Correo eléctronico -->
            <div class="form-group row align-items-center">
                <label for="email" class="col-sm-2 col-form-label font-sm fw-600">
                    <span class="d-flex align-items-center">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-2"
                            style="background-color: #E3E3E3; width:30px; height:30px">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                        </div>
                        Correo:
                    </span>
                </label>
                <div class="col-md-4 col-sm-3 input-group-sm">
                    <input type="email" class="form-control font-sm" id="email" name="email"
                        value="{{ $user->email }}" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4 border elevation-0">
        <div class="card-header">
            <h3 class="card-title font-sm">Configuración de Método de Pago</h3>
        </div>
        <div class="card-body">
            <div class="form-group row align-items-center">
                <label for="currency" class="col-sm-2 col-form-label font-sm fw-600">
                    <span class="d-flex align-items-center">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-2"
                            style="background-color: #E3E3E3; width:30px; height:30px">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                <path d="M12 7v10" />
                            </svg>
                        </div>
                        Moneda:
                    </span>
                </label>
                <div class="col-sm-4 input-group-sm">
                    <select class="form-control font-sm" id="currency" disabled>
                        <option value="pen" selected>PEN</option>
                        <option value="usd">USD</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 elevation-0 border">
        <div class="card-header">
            <h3 class="card-title font-sm">Configuración de impresora</h3>
        </div>
        <div class="card-body">
            <div class="form-group row align-items-center">
                <label for="name_printer" class="col-sm-2 col-form-label font-sm fw-600">
                    <span class="d-flex align-items-center">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-2"
                            style="background-color: #E3E3E3; width:30px; height:30px">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                        </div>
                        Impresora:
                    </span>
                </label>
                <div class="col-sm-4 input-group-sm">
                    <input type="text" class="form-control font-sm" id="name_printer" name="name_printer"
                        value="{{ $config->name_printer ?? 'N/A' }}" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    @include('user.partials.styles')
@endsection

@section('js')
    <script>
        document.getElementById('btn_edit').addEventListener('click', function() {
            document.getElementById('name').removeAttribute('readonly');
            document.getElementById('ruc').removeAttribute('readonly');
            document.getElementById('name_printer').removeAttribute('readonly');
            document.getElementById('inputFotoPerfil').style.display = 'block';
        });
    </script>
@endsection
