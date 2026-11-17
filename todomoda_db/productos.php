<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/conexion.php';

// Obtener productos de la base de datos
$stmt = $conexion->query('SELECT * FROM productos ORDER BY id DESC');
$productos = $stmt->fetchAll();

function escapar(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos | Todomoda</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="topbar">
        <div class="promo-bar">3 Y 6 CUOTAS SIN INTERÉS · TODOMODA ARGENTINA</div>
        <nav class="navbar">
            <a href="panel.php" class="logo">TODOMODA</a>
            <div class="nav-links">
                <a href="panel.php">Mis Datos</a>
                <a href="productos.php" class="activo">Productos (<?= count($productos) ?>)</a>
                <a href="carrito.php" style="background: #ffcccc; padding: 5px 10px; border-radius: 4px; text-decoration: none;">🛒 Ver Carrito (<?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0 ?>)</a>
                <a href="historia.php">Historia en Argentina</a>
                <?php if (($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
                    <a href="admin_usuarios.php">Panel Admin</a>
                <?php endif; ?>
                <a href="cerrar_sesion.php" class="btn-salir">Cerrar Sesión</a>
            </div>
        </nav>
    </header>

    <main class="contenedor-ancho">
        <div class="barra-filtro">
            <span>Filtrar por: <strong>Beauty & Fragancias</strong></span>
            <span>Ordenar por: <strong>Nuestros elegidos</strong></span>
        </div>

        <div class="grilla-productos">
            <?php foreach ($productos as $prod): ?>
                <article class="card-producto">
                    <div class="card-imagen" style="background-color: <?= escapar($prod['color']) ?>;">
            
                        <img src="<?= escapar($prod['imagen']) ?>" alt="<?= escapar($prod['nombre']) ?>" onerror="this.style.display='none'">
                    </div>
                    <div class="card-info">
                        <h2><?= escapar($prod['nombre']) ?></h2>
                        <p class="precio"><?= escapar($prod['precio']) ?></p>
                        
                        <!-- Botón para Agregar al Carrito -->
                        <form action="agregar_carrito.php" method="POST" style="margin-bottom: 5px;">
                            <input type="hidden" name="producto_id" value="<?= (int)$prod['id'] ?>">
                            <button type="submit" class="btn-carrito">AGREGAR AL CARRITO</button>
                        </form>

                        <!-- Botón para Eliminar Producto (Solo Admin) -->
                        <?php if (($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
                            <form action="eliminar_producto.php" method="POST" onsubmit="return confirm('¿Seguro que querés eliminar este producto?');">
                                <input type="hidden" name="id" value="<?= (int)$prod['id'] ?>">
                                <button type="submit" style="background-color: #d9534f; color: white; border: none; padding: 6px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 11px; font-weight: bold;">ELIMINAR PRODUCTO</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>