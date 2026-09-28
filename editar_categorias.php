<?php
session_start();
require_once "includes/conexion.php";
require_once "includes/funciones.php";
 
$id = intval($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: categorias.php");
  exit;
}
 
$stmt = $conn->prepare("SELECT * FROM categorias WHERE id=? AND activo=1");
$stmt->bind_param("i", $id);
$stmt->execute();
$categoria = $stmt->get_result()->fetch_assoc();
$stmt->close();
 
if (!$categoria) {
  header("Location: categorias.php");
  exit;
}
 
$page_title = "Editar Categoria";
require_once "includes/header.php";
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre      = trim($_POST["nombre"] ?? "");
 
 
  
 
  if (empty($mensaje_error) && (empty($nombre) )) {
    $mensaje_error = "Todos los campos obligatorios deben completarse.";
  } elseif (empty($mensaje_error)) {
    $sql = "UPDATE categorias SET nombre=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre, $id);
 
    if ($stmt->execute()) {
      $_SESSION["exito"] = "categoria actualizada correctamente.";
      $stmt->close();
      $conn->close();
      header("Location: categorias.php");
      exit;
    }
 
    $mensaje_error = "Error al actualizar: " . $stmt->error;
    $stmt->close();
  }
}
 
?>
 
<h2>Editar categoria</h2>
 
<?php if (!empty($mensaje_error)): ?>
  <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>
 
<form method="POST" enctype="multipart/form-data" class="form-categoria">
  <div class="campo">
    <label>Nombre *</label>
    <input type="text" name="nombre" required value="<?= htmlspecialchars($categoria["nombre"]); ?>">
  </div>

  <button type="submit" class="btn-primario">Guardar Cambios</button>
  <a href="categorias.php" class="btn-secundario">Cancelar</a>
</form>
 
<?php require_once "includes/footer.php"; ?>