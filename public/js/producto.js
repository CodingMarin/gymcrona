// Prevista de la imagen
function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('img-thumbnail');
            img.style.maxWidth = '150px';
            img.style.maxHeight = '150px';
            preview.appendChild(img);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Filtrar productos
function filtrarProducto(filtro) {
    const filasProducto = document.querySelectorAll("#productos tbody tr");
    filasProducto.forEach((fila) => {
        const nombreProducto = fila
            .querySelector("td:nth-child(2)")
            .textContent.toLowerCase()
            .trim();
        const dniProducto = fila
            .querySelector("td:nth-child(3)")
            .textContent.toLowerCase()
            .trim();

        if (nombreProducto.includes(filtro) || dniProducto.includes(filtro)) {
            fila.style.display = "table-row";
        } else {
            fila.style.display = "none";
        }
    });
}

// Funcion para eliminar el producto seleccionado
$('#eliminarProductoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var productoId = button.data('id');
    var modal = $(this);
    modal.find('#borrarProductoForm').attr('action', '/producto/' + productoId);
});
