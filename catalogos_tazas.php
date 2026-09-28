<?php
session_start();
$page_title = "Mi Carrito";
require_once "includes/header.php";

// Recuperar el carrito desde la sesión
$carrito = $_SESSION["carrito"] ?? [];

// Total
$total = 0;

// Mensaje de éxito
$mensaje_exito = $_SESSION["exito"] ?? "";
unset($_SESSION["exito"]);
?>

<h2>Carrito</h2>
<p>La funcionalidad de carrito estará disponible en una hora posterior.</p>

<div class="carrito-container">
  <h2>🛒 Mi Carrito de Compras</h2>

  <?php if ($mensaje_exito): ?>
    <p class="mensaje-exito"><?= htmlspecialchars($mensaje_exito); ?></p>
  <?php endif; ?>

  <?php if (empty($carrito)): ?>
    <div class="carrito-vacio">
      <p>Tu carrito está vacío.</p>
      <a href="index.php" class="btn-primario">Ver catálogo</a>
    </div>
  <?php else: ?>
    <table class="tabla-carrito">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
      <?php foreach ($carrito as $item): 
        $subtotal = $item["precio"] * $item["cantidad"];
        $total += $subtotal;

        // 👇 CORRECCIÓN CLAVE AQUÍ
        $imagen = $item["imagen"] ?? "default.jpg";
      ?>
        <tr>
          <td class="producto-resumen">
            <img src="uploads/<?= htmlspecialchars($imagen); ?>"
                 alt="<?= htmlspecialchars($item["nombre"]); ?>"
                 width="60" height="60">
            <?= htmlspecialchars($item["nombre"]); ?>
          </td>

          <td>$<?= number_format($item["precio"], 2); ?></td>

          <td>
            <a href="carrito_accion.php?accion=quitar&id=<?= $item["id"]; ?>" class="accion-cantidad">−</a>
            <strong><?= $item["cantidad"]; ?></strong>
            <a href="carrito_accion.php?accion=agregar&id=<?= $item["id"]; ?>" class="accion-cantidad">+</a>
          </td>

          <td>$<?= number_format($subtotal, 2); ?></td>

          <td>
            <a href="carrito_accion.php?accion=eliminar&id=<?= $item["id"]; ?>" class="btn-eliminar">
              🗑️
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="3"><strong>Total:</strong></td>
          <td colspan="2"><strong>$<?= number_format($total, 2); ?> MXN</strong></td>
        </tr>
      </tfoot>
    </table>

    <div class="carrito-acciones">
      <a href="carrito_accion.php?accion=vaciar" 
         class="btn-secundario"
         onclick="return confirm('¿Vaciar el carrito?')">
         Vaciar carrito
      </a>

      <button class="btn-primario"
              onclick="alert('Pago no implementado en este proyecto')">
        💳 Proceder al pago
      </button>
    </div>
  <?php endif; ?>
</div>

<?php require_once "includes/footer.php"; ?>