$(document).ready(function() {
    // Cuando se presiona una tecla en el campo de búsqueda
    $("#busqueda-input").on("keyup", function() {
        var query = $(this).val();

        // Realizar una solicitud AJAX para buscar productos
        $.ajax({
            type: "POST",
            url: "../../Controller/buscar_productos.php", // Nombre del archivo PHP que manejará la búsqueda
            data: {
                query: query
            },
            success: function(response) {
                // Colocar los productos encontrados en el contenedor
                $("#productos-container").html(response);
            }
        });
    });
});