<!-- Borrar metodo pago Modal -->
<div class="modal fade" id="eliminarMetodoPagoModal" tabindex="-1" aria-labelledby="eliminarMetodoPagoModalLabel"
    aria-hidden="true">
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
