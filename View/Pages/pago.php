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
    <!--<link rel="stylesheet" href="../Css/pago.css">-->
    <!-- Título de la página -->
    <title>Pago</title>
</head>

<body>
    <!-- Maquetado -->
    <div class="img-fondo">
        <div class="parent">
            <div class="div1">
                <p>Café-tero</p>
                <div class="contenido">
                    <p>Transferencia Bancaria Directa.</p>
                    <div class="frame">
                        <p>
                            Banco: BBVA Bancomer, S.A. <br>
                            Titular de la cuenta: Cafe-tero, S.A. de C.V. <br>
                            Número de cuenta: 0147481705 <br>
                            CLABE: 012100001474817059 <br>
                        </p>
                    </div>
                    <p id="texto-t">Tu compra estará segura, al finalizar el pago enviaremos un comprobante de compra a
                        tu correo
                        electrónico.</p>
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
                        <table class="">
                            <thead>
                                <tr>
                                    <th class="product-name">Producto</th>
                                    <th class="product-total">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $total = 0;
                                    foreach ($detallesCompra as $detalle) {
                                        $subtotal = $detalle['precioCompra'] * $detalle['cantidad'];
                                        $total += $subtotal;
                                        echo "<tr class=''>";
                                        echo "<td class=''>";
                                        echo "<div class=''><img src='../images/productos/" . $detalle['image'] . "' alt='Imagen del producto' width='150'></div>";
                                        echo "<div class=''>";
                                        echo "<div class=''>" . $detalle['nombre'] . "</div>";
                                        echo "<strong class=''>×&nbsp;" . $detalle['cantidad'] . "</strong>";
                                        echo "</div>&nbsp;";
                                        echo "</td>";
                                        echo "<td class='p'>";
                                        echo "<span class=''><bdi><span class=''>$</span>" . $subtotal . "</bdi></span>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    $iva = $total * 0.08;
                                    $totalConIva = $total + $iva;

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total sin IVA</th>
                                    <td><span class=''><bdi><span class=''>$</span><?php echo $total; ?></bdi></span></td>
                                </tr>
                                <tr>
                                    <th>IVA (8%)</th>
                                    <td><span class=''><bdi><span class=''>$</span><?php echo $iva; ?></bdi></span></td>
                                </tr>
                                <tr>
                                    <th>Total con IVA</th>
                                    <td><span class=''><bdi><span class=''>$</span><?php echo $totalConIva; ?></bdi></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!--ARREGLAR LOS BOTONES Y USAR ANCLAS <a>-->
                    <button class="boton-minimalista" href="#"> finalizar pago</button>
                </div>
            </div>
            <div class="div2">
                <p> Finaliza tu compra. </p>
            </div>
        </div>
    </div>
</body>

</html>