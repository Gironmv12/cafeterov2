<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
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
    <link rel="stylesheet" href="../Css/pago.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Título de la página -->
    <title>Pago</title>
</head>

<body>
    <!-- Maquetado -->
    <div class="app">
        <sidebar>
            <div class="logo">
                <img src="../images/logo-index.png" alt="logo" width="50">
                <h4>Café-tero</h4>
            </div>

            <ul>
                <li class="active"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="white" width="25">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>

                    <a href="admin_productos.php" style="color: #fff;">Finaliza tu compra</a>

                </li>

                <li><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" width="25">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>

                    <a href="menu.php">Menu</a>
                </li>
            </ul>

            <div class="user form">
                <?php
                    if ($_SESSION['idRol'] == 2) {
                        echo '<div class="admin-title">Cliente</div>';
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
                <h1>Tu orden</h1>
                <img src="../images/shopping-bag.png" height="40px" width="40px" alt="png">
            </div>

            <div class="form-container">
                <div class="forms">
                    <div class="detalleCompra">
                        <?php
                            require_once("../../Model/bdApi.php");
                            $db = new DB();
                            $pdo = $db->connect();
                            $idUsuario = $_SESSION['usuario_id'];

                            $stmt = $pdo->prepare("SELECT productos.image, productos.nombre, detalle_compra.cantidad, detalle_compra.precioCompra 
                                                   FROM detalle_compra 
                                                   JOIN compras ON detalle_compra.idCompras = compras.idCompras 
                                                   JOIN productos ON detalle_compra.idProducto = productos.idProducto 
                                                   WHERE compras.idUsuario = ? AND compras.idCompras = (SELECT MAX(idCompras) FROM compras WHERE idUsuario = ?)");
                            $stmt->execute([$idUsuario, $idUsuario]);

                            $detallesCompra = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table class="table-cont">

                            <thead>
                                <tr>
                                    <th class="product-name">Producto y Cantidad </th>
                                    <th class="product-total">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    $total = 0;
                                    foreach ($detallesCompra as $detalle) {
                                        $subtotal = $detalle['precioCompra'] * $detalle['cantidad'];
                                        $total += $subtotal;
                                        echo "<tr class='cont-gen'>";
                                        echo "<td class='cont-img'>";
                                        echo "<div class='frame-img'><img src='../images/productos/" . $detalle['image'] . "' alt='Imagen del producto' width='150'></div>";
                                        echo "<div class='detalle-general'>";
                                        echo "<div class='detalle'>" . $detalle['nombre'] . "</div>";
                                        echo "<strong class='detalle-cant'>×&nbsp;" . $detalle['cantidad'] . "</strong>";
                                        echo "</div>&nbsp;";
                                        echo "</td>";
                                        echo "<td class='p'>";
                                        echo "<span class='subtotal'><bdi><span class=''>$</span>" . $subtotal . "</bdi></span>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    $iva = $total * 0.08;
                                    $totalConIva = $total + $iva;

                                ?>
                            </tbody>

                            <tfoot class="cont-precio-total">
                                <tr>
                                    <th>Total sin IVA</th>
                                    <td><span class='total-iva'><bdi><span
                                                    class=''>$</span><?php echo $total; ?></bdi></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>IVA (8%)</th>
                                    <td><span class='iva-procent'><bdi><span
                                                    class=''>$</span><?php echo $iva; ?></bdi></span></td>
                                </tr>
                                <tr>
                                    <th>Total con IVA</th>
                                    <td><span class='total-iva-precio'><bdi><span
                                                    class=''>$</span><?php echo $totalConIva; ?></bdi></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


            <div class="cont-pago">
                <div class="title-2">
                    <h1>Método de pago.</h1>
                    <img src="../images/credit-card.png" width="40px" height="40px" alt="png">
                </div>

                <!-- Contenedores -->
                <div class="form-container2">

                    <!-- Método de pago -->
                    <div class="txt-trans">
                        <p>Transferencia Bancaria Directa.</p>
                        <img src="../images/shopping.png" width="40px" height="40px" alt="png">
                    </div>

                    <div class="txt-banco">
                        <p>
                            Banco: Mastercard S.A. <br>
                            Titular de la cuenta: Cafe-tero, S.A. de C.V. <br>
                            Número de cuenta: 0147481705 <br>
                            CLABE: 012100001474817059 <br>
                        </p>
                    </div>

                    <div class="btn-pagar center-button">
                        <button id="btn-pago" class="btn-pago">Finalizar pago</button>
                    </div>
                    <script>
                    document.getElementById('btn-pago').addEventListener('click', function() {
                        swal({
                                title: "Compra finalizada",
                                text: "Tu compra ha concluido exitosamente",
                                icon: "success",
                                buttons: true,
                                dangerMode: false,
                                customClass: {
                                    confirmButton: 'btn-swal',
                                    cancelButton: 'btn-swal-cancel'
                                }
                            })
                            .then((willGoToPurchases) => {
                                if (willGoToPurchases) {
                                    window.location.href = "menu.php";
                                }
                            });
                    });
                    </script>


                </div>
            </div>
        </div>
    </div>
</body>

</html>