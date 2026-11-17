<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
    
    if ($producto_id) {
        require_once __DIR__ . '/conexion.php';
        
        $stmt = $conexion->prepare('SELECT * FROM productos WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $producto_id]);
        $prod = $stmt->fetch();
        
        if ($prod) {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }
            
            if (isset($_SESSION['carrito'][$producto_id])) {
                $_SESSION['carrito'][$producto_id]['cantidad']++;
            } else {
                $_SESSION['carrito'][$producto_id] = [
                    'id' => $prod['id'],
                    'nombre' => $prod['nombre'],
                    'precio' => $prod['precio'] ?? 0,
                    'imagen' => $prod['imagen'] ?? '',
                    'cantidad' => 1
                ];
            }
        }
    }
}

header('Location: productos.php');
exit;
?>