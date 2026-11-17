<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    http_response_code(403);
    exit('Acceso denegado.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id < 1 || $id === (int)$_SESSION['usuario_id']) {
    http_response_code(400);
    exit('Identificador inválido o intento de autoeliminación.');
}

require_once __DIR__ . '/conexion.php';

$stmt = $conexion->prepare('DELETE FROM usuarios WHERE id = :id');
$stmt->execute(['id' => $id]);

header('Location: admin_usuarios.php');
exit;
?>