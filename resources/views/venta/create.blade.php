@extends('adminlte::page')

@section('title', 'Gymcrona - Registrar Venta')

@section('content_header')
    <!-- Incluir la sección de encabezado de contenido desde venta.partials.content_header -->
    @include('venta.partials.content_header')
@stop

@section('content')
    <!-- Incluir el formulario desde venta.partials.form -->
    @include('venta.partials.form')
@stop

@section('css')
    <!-- Incluir los estilos desde venta.partials.styles -->
    @include('venta.partials.styles')
@endsection

@section('js')
    <!-- Incluir los scripts desde venta.partials.scripts -->
    @include('venta.partials.scripts')
@endsection
