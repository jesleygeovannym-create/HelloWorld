<?php
session_start();
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre      = trim($_POST['nombre'] ?? '');
    $categoria   = trim($_POST['categoria'] ?? '');
    $precio      = trim($_POST['precio'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    if (empty($nombre) || empty($categoria) || empty($precio) || empty($descripcion)) {
        $error = 'Todos los campos son obligatorios.';
    } elseif (!is_numeric($precio) || $precio < 0) {
        $error = 'El precio debe ser un número válido.';
    } else {
        $_SESSION['productos'][] = [
            'nombre'      => htmlspecialchars($nombre),
            'categoria'   => htmlspecialchars($categoria),
            'precio'      => (float)$precio,
            'descripcion' => htmlspecialchars($descripcion),
        ];
    }
}

function getBadgeClass(string $cat): string {
    return match($cat) {
        'Curso'    => 'badge-curso',
        'Ebook'    => 'badge-ebook',
        'Plugin'   => 'badge-plugin',
        'Software' => 'badge-software',
        default    => 'badge-default',
    };
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productos Digitales</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Registro de Productos Digitales</h1>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php" id="formProducto">

        <label for="nombre">Nombre del Producto</label>
        <input type="text" id="nombre" name="nombre" placeholder

         for="categoria">Categoría</label>
        <select id="categoria" name="categoria">
            <option value="">-- Selecciona --</option>
            <option value="Curso">Curso</option>
            <option value="Ebook">Ebook</option>
            <option value="Plugin">Plugin</option>
            <option value="Software">Software</option>
        </select>

        <label for="precio">Precio (USD)</label>
        <input type="number" id="precio" name="precio" placeholder="0.00" min="0" step="0.01">

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3" placeholder="Descripción del producto..."></textarea>

        <button type="submit">Registrar Producto</button>
    </form>

    <?php if (!empty($_SESSION['productos'])): ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['productos'] as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $p['nombre'] ?></td>
                <td><span class="badge <?= getBadgeClass($p['categoria']) ?>"><?= $p['categoria'] ?></span></td>
                <td>$<?= number_format($p['precio'], 2) ?></td>
                <td><?= $p['descripcion'] ?></td>
                <td>
    <a href="eliminar.php?id=<?= $i ?>">
        Eliminar
    </a>
</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="limpiar.php" class="limpiar">Limpiar lista</a>
    <?php endif; ?>
</div>

<script src="js/validacion.js"></script>
</body>
</html>