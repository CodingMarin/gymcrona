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
    <div class="card">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-body">
                    <!-- Formulario de venta -->
                    @include('venta.partials.form_content')
                </div>
            </div>
        </div>
    </div>
</div>
