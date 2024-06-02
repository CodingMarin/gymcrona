function validarFormulario(event) {
    // Prevenir el envío del formulario por defecto
    event.preventDefault();
    let camposRequeridos = [
        "fecha_caducidad",
        "monto_costo",
        "monto_pago",
        "metodo_pago_id",
        "estado_id",
    ];
    let camposOpcionales = ["promocion_id", "boleta_id"];
    let esValido = true;

    camposRequeridos.forEach((campo) => {
        let input = document.getElementById(campo);
        if (input && !input.value) {
            // alert("Los campos no pueden estar vacios!");
            esValido = false;
        } else if (input) {
            // input.classList.remove("is-invalid");
        }
    });

    camposOpcionales.forEach((campo) => {
        let input = document.getElementById(campo);
        if (input && !input.value) {
            // input.classList.remove("is-invalid");
        }
    });

    if (!esValido) {
        mostrarError("Por favor, complete todos los campos obligatorios.");
    } else {
        abrirModal();
    }
}

function mostrarError(mensaje) {
    document.getElementById("mensaje").innerText = mensaje;
    $("#notificacionModal").modal("show");
}
document
    .getElementById("metodo_pago_id")
    .addEventListener("change", function () {
        const metodoPagoSeleccionado = this.options[this.selectedIndex];
        const nombre = metodoPagoSeleccionado.getAttribute("data-nombre");
        const imagen = metodoPagoSeleccionado.getAttribute("data-imagen");
        console.log("Metodo de pago seleccionado: %s", nombre);

        if (nombre === "Efectivo" || nombre === "Tarjeta") {
            $("#feature_img").addClass("d-none");
        } else {
            // Enviar el QR al checkout
            $("#feature_img").attr("src", "../images/payments/" + imagen);
        }
    });

function abrirModal() {
    let totalPagar = document.getElementById("monto_pago").value;
    document.getElementById("cantidad_total_pagar").innerText = totalPagar;
    $("#checkOutModal").modal("show");
}

function calcularDeuda() {
    const precioInscripcion = parseFloat(
        document.getElementById("monto_costo").value
    );
    const montoPagado = parseFloat(document.getElementById("monto_pago").value);

    const deuda = precioInscripcion - montoPagado;
    document.getElementById("monto_deuda").value = deuda;

    if (montoPagado > precioInscripcion) {
        document.getElementById("mensaje").innerText =
            "El monto pagado no puede ser mayor al precio de la inscripción.";
        $("#notificacionModal").modal("show");
    }
}

function obtenerPrecioPromocion() {
    const promocionSelect = document.getElementById("promocion_id");
    const precioInscripcionInput = document.getElementById("monto_costo");

    promocionSelect.addEventListener("change", function () {
        const precioPromocion = parseFloat(
            this.options[this.selectedIndex].getAttribute("data-precio")
        );
        precioInscripcionInput.value = precioPromocion.toFixed(2);
    });
}

function obtenerNombreServicio(filtro) {
    const servicioSeleccionado = $("option[value='" + filtro + "']");
    const nombre = servicioSeleccionado.attr("value");
    const dataId = servicioSeleccionado.attr("data-id");

    document.getElementById("servicio_nombre").value = nombre;
    document.getElementById("servicio_id").value = dataId;
}

function obtenerCliente(filtro) {
    const clienteSeleccionado = $("option[value='" + filtro + "']");
    const dataId = clienteSeleccionado.attr("data-id");

    document.getElementById("cliente_id").value = dataId;
}

function obtenerPromocionServicio(filtro) {
    const promocionSeleccionado = $("option[value='" + filtro + "']");
    const dataId = promocionSeleccionado.attr("data-id");

    document.getElementById("promocion_id").value = dataId;
}
obtenerPrecioPromocion();
calcularDeuda();
