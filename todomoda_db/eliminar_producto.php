<?php
session_start();
// Validar que sea administrador
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    http_response_code(403);
    exit('Acceso denegado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        require_once __DIR__ . '/conexion.php';
        $stmt = $conexion->prepare('DELETE FROM productos WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}

// Redirige de vuelta a la página de productos
header('Location: productos.php');
exit;
?>