$(document).ready(function () {
    // Función para realizar la búsqueda de productos
    function buscarProductos(consulta) {
        $.ajax({
            url: '../../Controller/apis/resApiProductos.php',
            type: 'GET',
            dataType: 'json',
            data: { query: consulta }, // Envía la consulta como parámetro
            success: function (data) {
                if (data.items && data.items.length > 0) {
                    // Recorre los datos y crea una tarjeta para cada producto
                    var productosContainer = $('#productos-container');
                    productosContainer.empty(); // Limpia la lista actual

                    $.each(data.items, function (index, producto) {
                        var cardHTML = `
                            <div class="inner-card">
                                <img src="data:image/jpeg;base64,${producto.image}" alt="${producto.nombre}" class="product-image">
                                <h2 class="product-description">${producto.nombre}</h2>
                                <p class="product-description2">${producto.descripcion}</p>
                                <p class="product-price">$${producto.precio} MXN</p>
                                <button class="button"></button>
                            </div>
                        `;
                        productosContainer.append(cardHTML);
                    });
                } else {
                    // Manejo de caso en el que no hay resultados de búsqueda
                    $('#productos-container').html('No se encontraron productos.');
                }
            },
            error: function () {
                // Manejo de errores en la solicitud AJAX
                $('#productos-container').html('Error al cargar los datos.');
            }
        });
    }

    // Agrega un evento de escucha al campo de búsqueda
    $('#busqueda-input').on('input', function () {
        var consulta = $(this).val().trim(); // Obtén el texto ingresado por el usuario
        buscarProductos(consulta); // Llama a la función de búsqueda con el texto ingresado
    });

    // Carga todos los productos al inicio
    buscarProductos('');
});

