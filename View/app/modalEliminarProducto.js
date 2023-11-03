function mostrarConfirmacion() {
    Swal.fire({
        title: 'Confirmar Eliminación',
        text: '¿Seguro que deseas eliminar este producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('eliminarProductoForm').submit(); // Envía el formulario
        }
    });
}