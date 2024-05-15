@extends('adminlte::page')

@section('title', 'Gymcrona - Productos')

@section('content_header')
    <!-- Incluir la sección de encabezado de contenido desde producto.partials.content_header -->
    @include('producto.partials.content_header')
@stop

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-dismissible fade show text-success font-sm"
                style="background: rgba(39, 174, 96,.2); border: 1px solid rgba(39,174,96, .3);" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-success">&times;</span>
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
            @include('producto.partials.card_header')
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="font-sm text-muted">
                        Mostrando
                        <span class="text-primary">{{ $productos->firstItem() ? $productos->firstItem() : 0 }}</span>
                        -
                        <span class="text-primary">{{ $productos->lastItem() ? $productos->lastItem() : 0 }}</span>
                        de
                        <span class="text-primary">{{ $totalProductos }}</span>
                        productos
                    </p>
                </div>
                <div class="table-responsive-lg table-borderless">
                    @include('producto.partials.table_content')
                    {{ $productos->links() }}
                </div>
            </div>
        </div>

        <!-- Registrar producto Modal -->
        @include('producto.partials.modal_register')

        <!-- Borrar producto Modal -->
        @include('producto.partials.modal_delete')
    </div>
@endsection

@section('css')
    <!-- Incluir los estilos desde venta.partials.styles -->
    @include('producto.partials.styles')
@endsection

@section('js')
    <!-- Incluir los scripts desde venta.partials.scripts -->
    @include('producto.partials.scripts')
@endsection
