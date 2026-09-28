<?php
session_start();
require_once "includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: agregar_categoria.php");
  exit;
}

$nombre      = trim($_POST["nombre"] ?? "");

if (empty($nombre) ) {
  $_SESSION["error"] = "Todos los campos obligatorios deben completarse.";
  header("Location: agregar_categorias.php");
  exit;
}

$sql = "INSERT INTO categorias (nombre) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);

if ($stmt->execute()) {
  $id_nuevo = $conn->insert_id;
  $_SESSION["exito"] = "Categoria '$nombre' guardada correctamente (ID: $id_nuevo)";
  header("Location: agregar_categorias.php");
} else {
  $_SESSION["error"] = "Error al guardar: " . $stmt->error;
  header("Location: agregar_categorias.php");
}

$stmt->close();
$conn->close();
exit;