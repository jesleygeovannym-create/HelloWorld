<?php
session_start();
$page_title = "Agregar Categoria";
require_once "includes/header.php";

$mensaje_error = $_SESSION["error"] ?? "";
unset($_SESSION["error"]);
?>

<h2>Agregar nueva taza</h2>

<?php if ($mensaje_error): ?>
  <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>

<form method="POST" action="guardar_categorias.php" class="form-categoria">
  <div class="campo">
    <label>Nombre *</label>
    <input type="text" name="nombre" required>
  
  <button type="submit" class="btn-primario">Guardar categoria</button>
  <a href="categorias.php" class="btn-secundario">Cancelar</a>
</form>

<?php require_once "includes/footer.php"; ?>