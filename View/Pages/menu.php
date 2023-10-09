<?php
session_start();
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
                    <li>
                        <a class="icon" href="#">
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
                    <li>
                        <a class="icon" href="#">
                            <svg width="25" height="25" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.75 7.5C3.75 5.42893 5.42893 3.75 7.5 3.75H10.3125C12.3836 3.75 14.0625 5.42893 14.0625 7.5V10.3125C14.0625 12.3836 12.3836 14.0625 10.3125 14.0625H7.5C5.42893 14.0625 3.75 12.3836 3.75 10.3125V7.5ZM15.9375 7.5C15.9375 5.42893 17.6164 3.75 19.6875 3.75H22.5C24.5711 3.75 26.25 5.42893 26.25 7.5V10.3125C26.25 12.3836 24.5711 14.0625 22.5 14.0625H19.6875C17.6164 14.0625 15.9375 12.3836 15.9375 10.3125V7.5ZM3.75 19.6875C3.75 17.6164 5.42893 15.9375 7.5 15.9375H10.3125C12.3836 15.9375 14.0625 17.6164 14.0625 19.6875V22.5C14.0625 24.5711 12.3836 26.25 10.3125 26.25H7.5C5.42893 26.25 3.75 24.5711 3.75 22.5V19.6875ZM15.9375 19.6875C15.9375 17.6164 17.6164 15.9375 19.6875 15.9375H22.5C24.5711 15.9375 26.25 17.6164 26.25 19.6875V22.5C26.25 24.5711 24.5711 26.25 22.5 26.25H19.6875C17.6164 26.25 15.9375 24.5711 15.9375 22.5V19.6875Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="icon" href="#">
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
                    <li>
                        <a class="icon" href="#">
                            <svg width="25" height="25" viewBox="0 0 22 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.4247 25.9388C10.4624 25.9607 10.4921 25.9776 10.5131 25.9894L10.548 26.0089C10.8266 26.1618 11.1722 26.1606 11.4511 26.0094L11.4869 25.9894C11.5079 25.9776 11.5376 25.9607 11.5753 25.9388C11.6508 25.8951 11.7587 25.8313 11.8944 25.7477C12.1656 25.5807 12.5484 25.3345 13.0058 25.0114C13.9189 24.3664 15.1372 23.4093 16.3582 22.1592C18.7883 19.671 21.3125 15.9327 21.3125 11.125C21.3125 5.42956 16.6954 0.8125 11 0.8125C5.30456 0.8125 0.6875 5.42956 0.6875 11.125C0.6875 15.9327 3.21165 19.671 5.64182 22.1592C6.86282 23.4093 8.08114 24.3664 8.99424 25.0114C9.45156 25.3345 9.83442 25.5807 10.1056 25.7477C10.2413 25.8313 10.3492 25.8951 10.4247 25.9388ZM11 14.875C13.0711 14.875 14.75 13.1961 14.75 11.125C14.75 9.05393 13.0711 7.375 11 7.375C8.92893 7.375 7.25 9.05393 7.25 11.125C7.25 13.1961 8.92893 14.875 11 14.875Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                </ul>

                <div class="user">
                    <?php
                        if (isset($_SESSION['usuario_nombre'])) {
                            echo '<div class="nombre-usuario">' . $_SESSION['usuario_nombre'] . '</div>';
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

                </div>
            </div>
        </div>
        <div class="carrito">

            <div class="descripcion">
                <p class="orden">Orden actual</p>
                <p id="fecha">Fecha:</p>
            </div>
        </div>

    </div>
    <!-- Script js funcionalidades -->
    <script src="../app/productos-api.js"></script>
    <script src="../app/menu.js"></script>

</body>

</html>