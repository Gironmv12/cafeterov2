<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios </title>
    <link rel="stylesheet" href="../Css/admin_usuarios.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="app">
    <sidebar>
            <div class="logo">
                <img src="../images/logo-index.png" alt="logo" width="50">
                <h4>Cafetero</h4>
            </div>
            <nav>
                <ul>
                    <li><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" width="25">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        <a href="admin_productos.php">Administrar Productos</a>
                    </li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white" width="25">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>

                        <a href="modulo_pedidos.php" >Módulo de pedidos</a>
                    </li>
                    <li class="active"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" width="25">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>

                        <a href="admin_usuarios.php" style="color: #fff;">Administrar Usuarios</a>
                    </li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" width="25">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>

                        <a href="menu.php">Menu</a>
                    </li>
                </ul>
            </nav>

            <div class="user form">
                <?php
                    if (isset ($_SESSION['usuario_nombre'])) {
                        echo '<div class="admin-title">Administrador</div>';
                        echo '<div class="user-info">';
                        echo '<div class="user-name">' . $_SESSION['usuario_nombre'] . '</div>';
                        echo '<a href="../../Controller/logout.php" class="logout-button">Cerrar Sesion
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </sidebar>

        <div class="app-container">
            <div class="title">
                <h1>Administrar Usuarios</h1>
            </div>

            <div class="form-container">
                
                <div class="forms">
                    <form action="../../Controller/alta_usuario.php" method="post" class="form">
                        <h3 class="form-title">Agregar Usuario</h3>
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" required>
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" class="form-input" required>
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" id="correo" name="correo" class="form-input" required>
                        <label for="clave" class="form-label">Contraseña:</label>
                        <input type="password" id="clave" name="clave" class="form-input" required>
                        <label for="rol" class="form-label">Rol:</label>
                        <select id="rol" name="rol" class="form-input" required>
                            <option value="1">Administrador</option>
                            <option value="2">Cliente</option>
                        </select>
                        <input type="submit" value="Crear Usuario" class="form-submit">
                    </form>


                    <div id="editarUsuario" style="display: none;" class="edit_usuario">
                        
                        <form id="formEditarUsuario" action="../../Controller/actualizar_usuario.php" method="post" class="form">
                            <h3 class="form-title">Editar Usuario</h3>
                            <input type="hidden" id="editarIdUsuario" name="idUsuario">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" id="editarNombre" name="nombre" class="form-input" required>
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" id="editarApellido" name="apellido" class="form-input" required>
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" id="editarCorreo" name="correo" class="form-input" required>
                            <label for="rol" class="form-label">Rol:</label>
                            <select id="editarRol" name="rol" class="form-input" required>
                                <option value="1">Administrador</option>
                                <option value="2">Cliente</option>
                            </select>
                            <input type="submit" value="Actualizar Usuario" class="form-submit">
                        </form>
                    </div>
                </div>
            </div>

            <?php
                    require_once("../../Model/bdApi.php");
                    $db = new DB();
                    $pdo = $db->connect();

                    $stmt = $pdo->prepare("SELECT usuarios.idUsuario, usuarios.nombre, usuarios.apellido, usuarios.correo, roles.nombre AS rol FROM usuarios INNER JOIN roles ON usuarios.idRol = roles.idRol");
                    $stmt->execute();

                    // Comprobar si la consulta devolvió algún resultado
                    if ($stmt->rowCount() > 0) {
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Rol</th><th>Acciones</th></tr>";

                        // Mostrar cada fila de resultados en la tabla
                        while($row = $stmt->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row["idUsuario"] . "</td>";
                            echo "<td>" . $row["nombre"] . "</td>";
                            echo "<td>" . $row["apellido"] . "</td>";
                            echo "<td>" . $row["correo"] . "</td>";
                            echo "<td>" . $row["rol"] . "</td>";
                            echo "<td><a href='#' onclick='editarUsuario(\"" . $row["idUsuario"] . "\", \"" . $row["nombre"] . "\", \"" . $row["apellido"] . "\", \"" . $row["correo"] . "\", \"" . $row["rol"] . "\")'>Editar</a> | <a href='#' onclick='confirmarEliminar(" . $row["idUsuario"] . ")'>Eliminar</a></td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No hay usuarios.";
                    }
                ?>
        </div>

    </div>




    <script>
    function editarUsuario(id, nombre, apellido, correo, rol) {
        document.getElementById('editarUsuario').style.display = 'block';
        document.getElementById('editarIdUsuario').value = id;
        document.getElementById('editarNombre').value = nombre;
        document.getElementById('editarApellido').value = apellido;
        document.getElementById('editarCorreo').value = correo;
        document.getElementById('editarRol').value = rol;
    }
    </script>

    <script>
    function confirmarEliminar(idUsuario) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../Controller/eliminar_usuario.php?id=" + idUsuario;
            }
        })
    }
    </script>
</body>

</html>