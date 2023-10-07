$(document).ready(function () {
    // Realiza la solicitud AJAX para obtener los datos de la API
    $.ajax({
        url: '../../Controller/apis/resApiProductos.php', // Ruta a tu archivo resApi.php
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.items && data.items.length > 0) {
                // Recorre los datos y crea una tarjeta para cada producto
                var productosContainer = $('#productos-container');
                $.each(data.items, function (index, producto) {
                    var cardHTML = `
                        <div class="card">
                            <h2>${producto.nombre}</h2>
                            <img src="data:image/jpeg;base64,${producto.image}" alt="${producto.nombre}">
                            <p>${producto.descripcion}</p>
                            <p>${producto.precio} $</p>
                        </div>
                    `;
                    productosContainer.append(cardHTML);
                });
            } else {
                // Manejo de caso en el que no hay elementos registrados
                $('#productos-container').html('No hay elementos registrados.');
            }
        },
        error: function () {
            // Manejo de errores en la solicitud AJAX
            $('#productos-container').html('Error al cargar los datos.');
        }
    });
});
