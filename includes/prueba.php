<?php
require_once "../includes/conexion.php";

// $conn ya está disponible y lista para usar
$resultado = $conn->query("SELECT COUNT(*) as total FROM productos");
$fila = $resultado->fetch_assoc();

echo "Total de tazas: " . $fila["total"];

$conn->close();
?>