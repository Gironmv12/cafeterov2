<?php
/**
 * Inicia la sesión y destruye la sesión actual.
 * Redirige al usuario a la página de inicio de sesión u otra página deseada.
 *
 * @return void
 */
session_start();

// Destruye la sesión actual
session_destroy();

// Redirige al usuario a la página de inicio de sesión u otra página deseada
header("Location: ../View/Pages/menu.php");
exit();
?>
