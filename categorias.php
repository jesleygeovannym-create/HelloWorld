<?php
session_start();
$page_title = "Catálogo de Tazas";
require_once "includes/conexion.php";
require_once "includes/header.php";

$mensaje_exito = $_SESSION["exito"] ?? "";
$mensaje_error = $_SESSION["error"] ?? "";
unset($_SESSION["exito"], $_SESSION["error"]);

$sql = "SELECT * FROM categorias WHERE activo=1 ORDER BY fecha_alta DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categorias = $stmt->get_result();
?>

<h2>Catálogo</h2>

<?php if ($mensaje_exito): ?>
  <p class="mensaje-exito"><?php echo htmlspecialchars($mensaje_exito); ?></p>
<?php endif; ?>

<?php if ($mensaje_error): ?>
  <p class="mensaje-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
<?php endif; ?>

<?php if ($categorias->num_rows === 0): ?>
  <p>No se encontraron tazas activas.</p>
<?php else: ?>
  <div class="grid-categorias">
    <?php while ($categoria = $categorias->fetch_assoc()): ?>
      <article class="tarjeta-categoria">
        <h3><?= htmlspecialchars($categoria["nombre"]); ?></h3>
        <div class="acciones">
          <a href="editar_categorias.php?id=<?= $categoria["id"];?>" class="btn-editar">✏️ Editar</a>
          <a href="eliminar_categorias.php?id=<?= $categoria["id"];?>" class="btn-eliminar" onclick="return confirm('¿Eliminar esta categoria?');">🗑️ Eliminar</a>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php
$stmt->close();
$conn->close();
require_once "includes/footer.php";
?>