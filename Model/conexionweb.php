<?php
function conectarbd() {
    $pdo = new PDO("mysql:host=localhost;dbname=cafetero", "root", "root");
    return $pdo;
}
?>