<?php
session_start();
require_once "includes/conexion.php";
 
$id = intval($_GET["id"] ?? 0);
 
if ($id > 0) {
  $stmt = $conn->prepare("UPDATE categorias SET activo=0 WHERE id=?");
  $stmt->bind_param("i", $id);
 
  if ($stmt->execute() && $stmt->affected_rows > 0) {
    $_SESSION["exito"] = "categoria eliminado correctamente.";
  } else {
    $_SESSION["error"] = "No se pudo eliminar el categoria.";
  }
 
  $stmt->close();
}
 
$conn->close();
header("Location: categorias.php");
exit;