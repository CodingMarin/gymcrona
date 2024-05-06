@extends('adminlte::page')

@section('title', 'Sincrona - Inicio')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-4">
                <x-adminlte-small-box class="text-sm bg-blue-400 text-white" title="{{ $clientes }}"
                    text="Clientes registrados" icon="fas fa-user-plus text-white" url="{{ route('cliente.index') }}"
                    url-text="Ver todos los clientes" />
            </div>
            <div class="col-md-4">
                <x-adminlte-small-box class="text-sm bg-purple-400 text-white" title="{{ $clientes }}"
                    text="Productos vendidos" icon="far fa-handshake text-white" url="{{ route('cliente.index') }}"
                    url-text="Registros de venta" />
            </div>
            <div class="col-md-4">
                <x-adminlte-small-box class="text-sm bg-indigo-400 text-white" title="{{ $productos }}"
                    text="Productos registrados" icon="fas fa-box text-white" url="{{ route('producto.index') }}"
                    url-text="Ver todos los productos" />
            </div>
            <div class="col-md-4">
                <x-adminlte-small-box class="text-sm bg-violet-400 text-white" title="{{ $inscripciones }}"
                    text="Total de inscripciones" icon="fas fa-address-card text-white"
                    url="{{ route('inscripcion.index') }}" url-text="Ver todas las incripciones" />
            </div>
            <div class="col-md-4">
                <x-adminlte-small-box class="text-sm bg-blue-400 text-white" title="{{ $promociones }}" text="Promociones"
                    icon="far fa-lightbulb text-white" url="{{ route('promocion.index') }}"
                    url-text="Ver tas las promociones" />
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .text-xs {
            font-size: 0.75rem;
            /* 12px */
            line-height: 1rem;
            /* 16px */
        }

        .text-sm {
            font-size: 0.875rem;
            /* 14px */
            line-height: 1.25rem;
            /* 20px */
        }

        .text-base {
            font-size: 1rem;
            /* 16px */
            line-height: 1.5rem;
            /* 24px */
        }

        .bg-blue-400 {
            background-color: rgb(96 165 250);
        }

        .bg-purple-400 {
            background-color: rgb(192 132 252);
        }

        .bg-indigo-400 {
            background-color: rgb(129 140 248);
        }

        .bg-violet-400 {
            background-color: rgb(167 139 250);
        }
    </style>
@endsection
