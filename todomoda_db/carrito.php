<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['accion'])) {
    if ($_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        unset($_SESSION['carrito'][(int)$_GET['id']]);
    } elseif ($_GET['accion'] === 'vaciar') {
        unset($_SESSION['carrito']);
    }
    header('Location: carrito.php');
    exit;
}

$carrito = $_SESSION['carrito'] ?? [];
$total_general = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras | Todomoda</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="contenedor-ancho" style="padding: 20px;">
        <h1>Tu Carrito de Compras</h1>
        <p><a href="productos.php">← Volver a Productos</a></p>

        <?php if (empty($carrito)): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>
            <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito as $item): 
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total_general += $subtotal;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td>$ <?= number_format($item['precio'], 2) ?></td>
                            <td><?= (int)$item['cantidad'] ?></td>
                            <td>$ <?= number_format($subtotal, 2) ?></td>
                            <td><a href="carrito.php?accion=eliminar&id=<?= $item['id'] ?>" style="color:red;">Quitar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>Total a pagar: $ <?= number_format($total_general, 2) ?></h3>
            <br>
            <a href="carrito.php?accion=vaciar" style="background:#ccc; padding:8px 12px; text-decoration:none; color:black;">Vaciar Carrito</a>
            <button onclick="alert('¡Compra simulada con éxito!'); window.location.href='carrito.php?accion=vaciar';" style="background:black; color:white; padding:8px 12px; cursor:pointer;">Finalizar Compra</button>
        <?php endif; ?>
    </main>
</body>
</html>