<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h5 class="font-weight-bold">Productos</h5>
            <ol class="breadcrumb font-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('producto.index') }}">Productos</a></li>
                <li class="breadcrumb-item active">Editar producto <span
                        class="text-success">{{ $producto->nombre }}</span></li>
            </ol>
        </div>
    </div>
</div>
