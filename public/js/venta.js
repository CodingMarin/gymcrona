function filtrarProducto(filtro) {
    const productoSeleccionado = $("option[value='" + filtro + "']");
    const nombre = productoSeleccionado.attr('value');
    const dataId = productoSeleccionado.attr('data-id');
    const precio = productoSeleccionado.attr('data-precio');
    const stock = productoSeleccionado.attr('data-stock');

    document.getElementById('producto_nombre').value = nombre;
    document.getElementById("producto_id").value = dataId;
    document.getElementById("stock").value = stock;
    document.getElementById("precio").value = precio;
}

function filtrarCliente(filtro) {
    const clienteSeleccionado = $("option[value='" + filtro + "']");
    const dataId = clienteSeleccionado.attr('data-id');

    document.getElementById("cliente_id").value = dataId;
}
let contadorProductos = 0;
let totalProductos = 0;

function agregarProductoTemporal() {
    let productoNombre = $("#producto_nombre").val();
    let cantidad = parseInt($("#cant_producto").val());
    let stock = parseInt($("#stock").val());
    let producto_id = $("#producto_id").val();
    let precio = $("#precio").val();
    let cliente = $("#cliente_id").val();
    let metodoPago = $("#metodo_pago_id").val();
    let productoExistente = false;

    $("#proformaBody tr").each(function () {
        let idProductoExistente = $(this).find('input[name^="detalle_venta"]').val();
        if (idProductoExistente == producto_id) {
            productoExistente = true;
            return false; // Terminar el bucle si se encuentra el producto
        }
    });

    if (productoNombre === '' || cantidad === '' || cliente === '' || metodoPago === '') {
        // Mostrar un alerta
        alert("Todos los campos son requeridos");
        // Salir de la función si hay campos vacíos
        return;
    } else {
        // Habilitar boton una vez completado los campos
        $("#continuar_btn").attr('disabled', false);
    }

    // Validar productos con stock 0 no pueden ser agregados
    if (stock == 0) {
        alert("No se puede agregar productos con stock 0");
        return;
    }

    // Validar que la cantidad no supere al stock
    if (cantidad > stock) {
        alert("La cantidad no puede superar al stock");
        return;
    }

    // Verificar si el producto ya está en la lista
    if (productoExistente) {
        // Mostrar un mensaje de alerta
        alert("El producto ya ha sido agregado a la lista.");
        return;
    }
    // Calcular el subtotal de los productos añadidos al table
    const subtotal = (precio * cantidad);

    totalProductos += subtotal;

    // Crear fila con los datos temporales
    const fila = `
    <tr>
        <td class="font-sm">${++contadorProductos}</td>
        <td class="font-sm">${productoNombre}</td>
        <td class="font-sm">${cantidad}</td>
        <td class="font-sm">S/.${precio}</td>
        <td class="font-sm">S/.${subtotal}</td>
        <td class="font-sm">
            <button class="btn btn-sm btn-danger" onclick="removerProducto(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
        <!-- Campos ocultos -->
        <input type="hidden" name="detalle_venta[${contadorProductos}][producto_id]" value="${producto_id}">
        <input type="hidden" name="detalle_venta[${contadorProductos}][producto_nombre]" value="${productoNombre}">
        <input type="hidden" name="detalle_venta[${contadorProductos}][cantidad]" value="${cantidad}">
        <input type="hidden" name="detalle_venta[${contadorProductos}][subtotal]" value="${subtotal}">
    </tr>
`;

    // Setear el total a pagar en el moda
    $("#checkOutModal #cantidad_total_pagar").text(totalProductos.toFixed(2));
    // Agregar la fila a la tabla
    $("#proformaBody").append(fila);

    console.log('producto_id:', producto_id);
    console.log('cantidad:', cantidad);
    console.log('subtotal:', subtotal);

    // Limpiar los campos despues de agregar un producto
    document.getElementById("producto_nombre").value = ''; // Por solucionar. no limpia el campo producto
    document.getElementById("producto_id").value = '';
    document.getElementById("cant_producto").value = '';
    document.getElementById("stock").value = '';
    document.getElementById("precio").value = '';
}

function removerProducto(btn) {
    // Obtener la fila a eliminar
    var fila = btn.parentNode.parentNode;
    // Obtener el subtotal de la fila a eliminar
    var subtotal = parseFloat(fila.querySelector("td:nth-child(5)").innerText.split("S/.")[1]);
    // Actualizar el totalProductos
    totalProductos -= subtotal;
    // Actualizar el total a pagar en el modal
    $("#checkOutModal #cantidad_total_pagar").text(totalProductos.toFixed(2));
    // Eliminar la fila de la tabla
    fila.remove();
}

document.getElementById('metodo_pago_id').addEventListener('change', function () {
    const metodoPagoSeleccionado = this.options[this.selectedIndex];
    const nombre = metodoPagoSeleccionado.getAttribute("data-nombre");
    const imagen = metodoPagoSeleccionado.getAttribute("data-imagen");

    // Enviar el QR al checkout
    $("#feature_img").attr('src', "{{ asset('/images/payments') }}/" + imagen);
});

function abrirModal() {
    $("#checkOutModal").modal("show");
}

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
});