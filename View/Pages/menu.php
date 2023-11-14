<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicializa $_SESSION['carrito'] como un arreglo si aún no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- icono de la página -->
    <link rel="icon" href="../images/icono.png" type="png">

    <!-- Enlace a estilos index.css -->
    <link rel="stylesheet" href="../Css/menu.css">

    <!-- Título de la página -->
    <title>Menu</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <?php
        if (isset($_SESSION['login_exitoso']) && $_SESSION['login_exitoso']) {
            // Muestra una alerta de éxito
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "login exitoso",
                    text: "El login se ha completado con éxito",
                    // Cambiamos el icono
                    iconColor: "#00e676",
                    // Cambiamos el color de fondo
                    backgroundColor: "#000000",
                    // Cambiamos el color del texto
                    textColor: "#ffffff",
                    // Añadimos una imagen de fondo
                    backgroundImage: "https://example.com/image.png",
                    // Cambiamos la duración de la alerta
                    timer: 1000,
                    // Añadimos una acción
                    onClose: function () {
                        window.location.href = "https://example.com/";
                    }
                });
            </script>';
            unset($_SESSION['login_exitoso']); // Limpia la variable de sesión
        }
    ?>
    <div class="app">

        <div class="sidebar">
            <!--LOGO-->
            <div class="logo">
                <img src="../images/logo-index.png" alt="">
            </div>

            <!--Opciones-->
            <div class="opciones">
                <ul>
                    <!--Inicio-->
                    <li>
                        <a class="icon" href="../../index.php">
                            <svg width="25" height="25" viewBox="0 0 28 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.3371 2.80123C13.7032 2.43511 14.2968 2.43511 14.6629 2.80123L25.5246 13.6629C25.8907 14.029 26.4843 14.029 26.8504 13.6629C27.2165 13.2968 27.2165 12.7032 26.8504 12.3371L15.9887 1.4754C14.8904 0.377053 13.1096 0.377056 12.0113 1.4754L1.14959 12.3371C0.783471 12.7032 0.783471 13.2968 1.14959 13.6629C1.5157 14.029 2.1093 14.029 2.47541 13.6629L13.3371 2.80123Z"
                                    fill="white" />
                                <path
                                    d="M14 4.78997L24.1988 14.9887C24.2359 15.0259 24.2738 15.0618 24.3125 15.0964V22.8437C24.3125 24.1382 23.2632 25.1875 21.9688 25.1875H17.75C17.2322 25.1875 16.8125 24.7678 16.8125 24.25V18.625C16.8125 18.1072 16.3928 17.6875 15.875 17.6875H12.125C11.6072 17.6875 11.1875 18.1072 11.1875 18.625V24.25C11.1875 24.7678 10.7678 25.1875 10.25 25.1875H6.03125C4.73683 25.1875 3.6875 24.1382 3.6875 22.8437V15.0964C3.72616 15.0618 3.76409 15.0259 3.80124 14.9887L14 4.78997Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                    <!--Menu-->
                    <li>
                        <a class="icon" href="menu.php">
                            <svg width="25" height="25" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.75 7.5C3.75 5.42893 5.42893 3.75 7.5 3.75H10.3125C12.3836 3.75 14.0625 5.42893 14.0625 7.5V10.3125C14.0625 12.3836 12.3836 14.0625 10.3125 14.0625H7.5C5.42893 14.0625 3.75 12.3836 3.75 10.3125V7.5ZM15.9375 7.5C15.9375 5.42893 17.6164 3.75 19.6875 3.75H22.5C24.5711 3.75 26.25 5.42893 26.25 7.5V10.3125C26.25 12.3836 24.5711 14.0625 22.5 14.0625H19.6875C17.6164 14.0625 15.9375 12.3836 15.9375 10.3125V7.5ZM3.75 19.6875C3.75 17.6164 5.42893 15.9375 7.5 15.9375H10.3125C12.3836 15.9375 14.0625 17.6164 14.0625 19.6875V22.5C14.0625 24.5711 12.3836 26.25 10.3125 26.25H7.5C5.42893 26.25 3.75 24.5711 3.75 22.5V19.6875ZM15.9375 19.6875C15.9375 17.6164 17.6164 15.9375 19.6875 15.9375H22.5C24.5711 15.9375 26.25 17.6164 26.25 19.6875V22.5C26.25 24.5711 24.5711 26.25 22.5 26.25H19.6875C17.6164 26.25 15.9375 24.5711 15.9375 22.5V19.6875Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>

                    <?php if(isset($_SESSION['idRol']) && ($_SESSION['idRol'] == 2 || $_SESSION['idRol'] == 1)): ?>
                        <!--Mis compras-->
                        <li>
                            <a class="icon" href="mis_compras.php">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
                                width="25" height="25">
                                    <path
                                        d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                                    <path
                                        d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                                    <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <!--Reseñas-->
                    <li>
                        <a class="icon" href="reseñas.php">
                            <svg width="25" height="25" viewBox="0 0 28 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.14134 1.32279C7.73463 0.9861 10.3787 0.8125 13.0629 0.8125C15.7467 0.8125 18.3906 0.986065 20.9836 1.32269C23.3864 1.63462 25.0979 3.64921 25.2404 5.98118C24.8331 5.84518 24.4015 5.75495 23.95 5.71748C22.2143 5.57342 20.4592 5.5 18.6875 5.5C16.9158 5.5 15.1606 5.57342 13.425 5.71748C10.4771 5.96214 8.375 8.45583 8.375 11.2603V16.6171C8.375 18.7304 9.56835 20.6658 11.416 21.5973L8.10041 24.9129C7.83229 25.181 7.42905 25.2612 7.07873 25.1161C6.72841 24.971 6.5 24.6292 6.5 24.25V19.2132C6.04561 19.1645 5.59271 19.1108 5.14135 19.0522C2.63083 18.7263 0.875 16.5416 0.875 14.0783V6.29673C0.875 3.8334 2.63082 1.64873 5.14134 1.32279Z"
                                    fill="white" />
                                <path
                                    d="M18.6875 7.375C16.9676 7.375 15.2642 7.44627 13.5801 7.58605C11.6559 7.74575 10.25 9.37852 10.25 11.2603V16.6171C10.25 18.5017 11.66 20.1354 13.5865 20.2927C15.1413 20.4196 16.7126 20.489 18.298 20.4988L21.7746 23.9754C22.0427 24.2435 22.4459 24.3237 22.7963 24.1786C23.1466 24.0335 23.375 23.6917 23.375 23.3125V20.3251C23.5129 20.3148 23.6507 20.304 23.7884 20.2928C25.715 20.1356 27.125 18.5019 27.125 16.6172V11.2603C27.125 9.37853 25.7191 7.74576 23.7949 7.58606C22.1108 7.44627 20.4073 7.375 18.6875 7.375Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                    <!--Contacto-->
                    <li>
                        <a class="icon" href="contacto.php">
                            <svg width="25" height="25" viewBox="0 0 22 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.4247 25.9388C10.4624 25.9607 10.4921 25.9776 10.5131 25.9894L10.548 26.0089C10.8266 26.1618 11.1722 26.1606 11.4511 26.0094L11.4869 25.9894C11.5079 25.9776 11.5376 25.9607 11.5753 25.9388C11.6508 25.8951 11.7587 25.8313 11.8944 25.7477C12.1656 25.5807 12.5484 25.3345 13.0058 25.0114C13.9189 24.3664 15.1372 23.4093 16.3582 22.1592C18.7883 19.671 21.3125 15.9327 21.3125 11.125C21.3125 5.42956 16.6954 0.8125 11 0.8125C5.30456 0.8125 0.6875 5.42956 0.6875 11.125C0.6875 15.9327 3.21165 19.671 5.64182 22.1592C6.86282 23.4093 8.08114 24.3664 8.99424 25.0114C9.45156 25.3345 9.83442 25.5807 10.1056 25.7477C10.2413 25.8313 10.3492 25.8951 10.4247 25.9388ZM11 14.875C13.0711 14.875 14.75 13.1961 14.75 11.125C14.75 9.05393 13.0711 7.375 11 7.375C8.92893 7.375 7.25 9.05393 7.25 11.125C7.25 13.1961 8.92893 14.875 11 14.875Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>

                    <?php if(isset($_SESSION['idRol']) && $_SESSION['idRol'] == 1):?>
                    <!--Administrador Catalogo-->
                    <li>
                        <a class="icon" href="admin_productos.php">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="25"
                                height="25">
                                <path fillRule="evenodd"
                                    d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z"
                                    clipRule="evenodd" fill="White" />
                            </svg>

                        </a>
                    </li>
                    <!--Administrador Usuarios-->
                    <li>
                        <a class="icon" href="admin_usuarios.php">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="25"
                                height="25">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                            </svg>

                        </a>
                    </li>
                    <!--Administrador Pedidos-->
                    <li>
                        <a class="icon" href="modulo_pedidos.php">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="25"
                                height="25">
                                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                                <path fill-rule="evenodd"
                                    d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                    clip-rule="evenodd" />
                            </svg>

                        </a>
                    </li>

                    <?php endif; ?>
                </ul>

                <div class="user">

                    <?php
                        if (isset($_SESSION['usuario_nombre'])) {
                            if ($_SESSION['idRol'] == 1) {
                                echo '<div class="nombre-usuario">Administrador</div><br>';
                                echo '<div class="nombre-usuario">' . $_SESSION['usuario_nombre'] . '</div>';
                            } elseif ($_SESSION['idRol'] == 2) {
                                echo '<div class="nombre-usuario">Cliente</div><br>';
                                echo '<div class="nombre-usuario">' . $_SESSION['usuario_nombre'] . '</div>';
                            }
                            echo '<div class="menu-desplegable">
                                    <div id="opciones" class="oculto">
                                        <a href="../../Controller/logout.php"></a>
                                    </div>
                                </div>';
                        } else {
                            // Si no está iniciada la sesión, puedes mostrar un mensaje o redirigir al usuario a la página de inicio de sesión.
                            echo '<div class="login"> <a href="./login.php">Login</a> </div>';
                        }
                    ?>
                </div>

            </div>
        </div>

        <div class="menu">

            <div class="barra_nav">
                <!-- Header -->
                <div class="salu2">
                    <h2 id="saludo"></h2>
                </div>

                <!-- Búsqueda -->
                <div class="btn-busqueda">
                    <div class="busqueda">
                        <svg class="icono-busqueda" aria-hidden="true" viewBox="0 0 24 24">
                            <g>
                                <path
                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                </path>
                            </g>
                        </svg>
                        <input placeholder="Buscar en el menú" type="search" class="input" id="busqueda-input">
                    </div>
                </div>
            </div>

            <div class="productos">
                <div class="categoria">
                    <div class="card card-todos">
                        <!-- imagen -->
                        <a href="#"> <img src="../images/produccion-de-cafe.png" width="60px" height="60px" alt=""> </a>
                        <!-- titulo -->
                        <p>Todos</p>
                    </div>
                    <div class="card card-tradicional">
                        <!-- imagen -->
                        <a href="#"> <img src="../images/grano-de-cafe.png" width="60px" height="60px" alt=""> </a>
                        <!-- titulo -->
                        <p>Tradicional</p>
                    </div>
                    <div class="card card-gourmet">
                        <!-- imagen -->
                        <a href="#"> <img src="../images/bolsa-de-cafe.png" width="60px" height="60px" alt=""> </a>
                        <!-- titulo -->
                        <p>Gorumet</p>
                    </div>
                    <div class="card card-supermo">
                        <!-- imagen -->
                        <a href="#"> <img src="../images/paquete-de-cafe.png" width="60px" height="60px" alt=""> </a>
                        <!-- titulo -->
                        <p>Supremo</p>
                    </div>
                    <div class="card card-descafeinado">
                        <!-- imagen -->
                        <a href="#"> <img src="../images/bolsita2de-cafe.png" width="60px" height="60px" alt=""> </a>
                        <!-- titulo -->
                        <p>Descafeinado</p>
                    </div>
                </div>

                <p class="texto"> Más solicitados</p>

                <div class="lista-productos" id="productos-container">
                    <!-- Aquí se mostrarán los productos dinámicamente -->
                    <?php
                        // Incluye el archivo metodos.php
                        include '../../Controller/metodos.php';
                        // Crea una instancia de la clase Productos
                        $producto = new Productos();
                        // Obtiene los productos desde la base de datos
                        $productos = $producto->obtenerProductos();
                        // Ahora puedes usar $productos en un bucle foreach
                        foreach ($productos as $reg) {
                            // Verificar si el producto ya está en el carrito
                            $productoEnCarrito = false;
                            foreach ($_SESSION['carrito'] as $carritoProducto) {
                                if ($carritoProducto['idProducto'] === $reg['idProducto']) {
                                    $productoEnCarrito = true;
                                    break;
                                }
                            }

                            echo '<div class="inner-card">';
                            echo '<img src="../images/productos/' . $reg['image'] . '" alt="Producto Photo" class="product-image">';
                            echo '<h2 class="product-description">' . $reg['nombre'] . '</h2>';
                            echo '<p class="product-description2">' . $reg['descripcion'] . '</p>';
                            echo '<p class="product-price">$' . $reg['precio'] . ' MXN</p>';

                            // Agrega un formulario para agregar al carrito por producto
                            if (!$productoEnCarrito) {
                                echo '<form method="post" action="../../Controller/agregarAlCarrito.php">';
                                echo '<input type="hidden" name="idProducto" value="' . $reg['idProducto'] . '">';
                                echo '<input type="submit" name="agregarAlCarrito" value="" class="button">';
                                echo '</form>';
                            } else {
                                echo '<p class="text-check">Producto en el carrito <img class="img-check" src="../images/check.png" width="18px" height="18px" </p>';
                            }

                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="carrito">

            <div class="descripcion">
                <p class="orden">Orden actual</p>
                <p id="fecha">Fecha:</p>
            </div>

            <div class="carrito-productos-agregados">
                <!-- Aquí se mostrarán los productos dinámicamente cuando se de click al boton comprar producto -->
                <?php
                    if (empty($_SESSION['carrito'])) {
                        echo '<div class="productos-container">';
                        echo '<img src="../images/carrito-imagen-rb.png" alt="Carrito Vacío" class="product-image404">';
                        echo '<p> Parece que no tienes nada en tu carrito. <br> ¿Qué esperas?</p>';
                        echo '</div>';
                    } else {
                        foreach ($_SESSION['carrito'] as $key => $producto) {
                            if (is_array($producto) && isset($producto['image'])) {
                                echo '<div class="container-carrito">';
                                echo '<div class="card-producto">';
                                echo '<div class="frame-producto">';
                                echo '<img src="../images/productos/' . $producto['image'] . '" alt="Producto Photo" class="imagen-producto">';
                                // Utiliza un formulario para manejar las acciones de sumar y restar
                                echo '<div class="producto-cont">';
                                echo '<form method="post" action="../../Controller/actualizarCarrito.php">';
                                echo '<input type="hidden" name="productoKey" value="' . $key . '">'; // Clave para identificar el producto
                                echo '<input type="hidden" name="accion" value="restar">'; // Acción para restar
                                echo '<button type="submit" class="btn-restar"> - </button>';
                                echo '</form>';

                                // Muestra la cantidad actual del producto
                                if (isset($producto['cantidad'])) {
                                    echo '<span class="cantidad-producto">' . $producto['cantidad'] . '</span>';
                                }

                                // Utiliza un formulario para manejar las acciones de sumar y restar
                                echo '<form method="post" action="../../Controller/actualizarCarrito.php">';
                                echo '<input type="hidden" name="productoKey" value="' . $key . '">'; // Clave para identificar el producto
                                echo '<input type="hidden" name="accion" value="sumar">'; // Acción para sumar
                                echo '<button type="submit" class="btn-sumar"> + </button>';
                                echo '</form>';

                                echo '<form action="../../Controller/eliminarProducto.php" method="POST" id="eliminarProductoForm">';
                                echo '<input type="hidden" name="idProducto" value="' . $producto['idProducto'] . '">';
                                echo '<button type="button" class="btn-eliminar" onclick="mostrarConfirmacion()">Eliminar</button>';
                                echo '</form>';
                                
                                echo '</form>';
                                echo '</div>';

                                echo '<h2 class="nombre-producto">' . $producto['nombre'] . '</h2>';
                                echo '<p class="descripcion-producto">' . $producto['descripcion'] . '</p>';
                                echo '<p class="precio-producto">$' . $producto['precio'] . ' MXN</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo 'El producto en el carrito no contiene información de imagen.';
                            }
                        }
                    }
                ?>
            </div>

            <!-- Card compra -->
            <div class="container">
                <div class="card-compra">
                    <!-- Aquí es donde se van a mostrar el subtotal y total del producto (precio) -->
                    <?php
                        $subtotal = 0;
                        if (!empty($_SESSION['carrito'])) {
                            foreach ($_SESSION['carrito'] as $key => $producto) {
                                if (is_array($producto) && isset($producto['image'])) {
                                    // Calcula el subtotal en el bucle
                                    if (isset($producto['cantidad'])) {
                                        $subtotal += $producto['precio'] * $producto['cantidad'];
                                    }
                                }
                            }
                        }

                        // Calcula el IVA y el total
                        $iva = $subtotal * 0.08; // Calcula el 8% del IVA
                        $total = $subtotal + $iva; // Calcula el total
                    ?>
                    <p class="total-subtotal-"> Subtotal: </p>
                    <p id="total-subtotal"> $<?php echo number_format($subtotal, 2); ?> MXN </p>
                    <p class="total-iva"> $<?php echo number_format($iva, 2); ?> MXN </p>
                    <hr id="hr">
                    <p class="total-compra-"> Total: </p>
                    <p id="total-compra"> $<?php echo number_format($total, 2); ?> MXN </p>

                    <form action="../../Controller/compras.php" method="post">
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                        <button type="submit" class="boton-minimalista" id="enlacePago"
                            <?php echo empty($_SESSION['carrito']) ? 'disabled' : ''; ?>>Continuar con el pago</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <script>
    document.getElementById('enlacePago').addEventListener('click', function(event) {
        if (!<?php echo json_encode(isset($_SESSION['usuario_nombre']) && $_SESSION['usuario_nombre']); ?>) {
            event.preventDefault();
            Swal.fire({
                title: 'Iniciar Sesión',
                text: 'Para continuar con el pago, debes iniciar sesión. ¿Deseas iniciar sesión ahora?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, iniciar sesión',
                cancelButtonText: 'No, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./login.php";
                }
            });
        }
    });
    </script>

    <script>
    // Espera a que el documento esté cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Obtiene el botón de pago
        var botonPago = document.getElementById('enlacePago');

        // Verifica si el carrito está vacío y habilita/deshabilita el botón
        if (<?php echo empty($_SESSION['carrito']) ? 'true' : 'false'; ?>) {
            botonPago.setAttribute('disabled', 'disabled');
            botonPago.style.backgroundColor = '#CCCCCC'; // Color desactivado (gris)
        } else {
            botonPago.style.backgroundColor = '#2EC76D'; // Color original
        }

        // Agrega un evento click al botón para verificar nuevamente antes de enviar el formulario
        botonPago.addEventListener('click', function(event) {
            if (<?php echo empty($_SESSION['carrito']) ? 'true' : 'false'; ?>) {
                event.preventDefault();
                alert(
                    'El carrito de compras está vacío. Agrega productos antes de continuar con el pago.'
                );
            }
        });
    });
    </script>

    <!-- Script js funcionalidades -->
    <script src="../app/menu.js"></script>
    <script src="../app/busqueda.js"></script>
    <script src="../app/modalEliminarProducto.js"></script>


</body>

</html>