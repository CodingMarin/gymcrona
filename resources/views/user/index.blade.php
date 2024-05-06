@extends('adminlte::page')

@section('title', 'Metodos de Pago')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Perfil</h5>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-0">
            <div class="col-sm-6">
                <h3 class="font-sm font-weight-bold mb-0 text-truncate">Configuracion de perfil</h3>
                <p class="text-muted font-sm text-truncate">Información personal</p>
            </div>
            <div class="col-sm-6 text-right top-0">
                <a type="button" class="text-primary font-small text-truncate">Editar</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Foto Perfil -->
            <div class="form-group row">
                <label for="inputFotoPerfil" class="col-sm-2 col-form-label font-sm">
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
                <div class="col-sm-10">
                    <picture>
                        <img class="rounded border"
                            src="{{ asset('images/' . ($user->foto_url ? $user->foto_url : 'picture-default.svg')) }}"
                            alt="{{ $user->name }}" width="60">
                    </picture>
                </div>
            </div>
            <!-- Nombre -->
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label font-sm">
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
                <div class="col-sm-10">
                    <input type="text" class="form-control font-sm" id="inputName" value="{{ $user->name }}" readonly>
                </div>
            </div>
            <!-- Ruc -->
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label font-sm">
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
                <div class="col-sm-10">
                    <input type="text" class="form-control font-sm" id="inputRuc"
                        value="{{ $user->ruc ? $user->ruc : 'N/A' }}" readonly>
                </div>
            </div>
            <!-- Correo eléctronico -->
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label font-sm">
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
                <div class="col-sm-10">
                    <input type="email" class="form-control font-sm" id="inputEmail" value="{{ $user->email }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title font-sm">Configuración de Método de Pago</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputCurrency" class="col-sm-2 col-form-label font-sm">Moneda</label>
                <div class="col-sm-10">
                    <select class="form-control font-sm" id="inputCurrency" disabled>
                        <option value="pen" selected>PEN</option>
                        <option value="usd">USD</option>
                    </select>
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
