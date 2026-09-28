<?php
// limpiar.php — Borra todos los productos de la sesión
session_start();
$_SESSION['productos'] = [];
header('Location: index.php');
exit;
?>
