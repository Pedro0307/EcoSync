<?php
session_start();
header('Content-Type: application/json');

require_once 'conexao_banco.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT nome_rota, origem_lat, origem_lng, destino_lat, destino_lng FROM rotas_salvas WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$rotas = [];
while ($row = $result->fetch_assoc()) {
    $rotas[] = $row;
}

echo json_encode($rotas);

$stmt->close();
$conn->close();
?>