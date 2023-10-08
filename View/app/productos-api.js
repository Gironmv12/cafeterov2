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
                    <div class="inner-card">
                        <img src="data:image/jpeg;base64,${producto.image}" alt="${producto.nombre}" class="product-image">
                        <h2 class="product-description">${producto.nombre}</h2>
                        <p class="product-description2">${producto.descripcion}</p>
                        <p class="product-price">${producto.precio} $</p>
                        <button class="button"></button>
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
