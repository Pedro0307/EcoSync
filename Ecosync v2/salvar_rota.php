<?php
session_start();
header('Content-Type: application/json');

// Incluir o arquivo de conexão com o banco de dados
// Certifique-se de que este arquivo existe e tem as credenciais corretas
require_once 'conexao_banco.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (
    !isset($data['nome_rota'], $data['origem_lat'], $data['origem_lng'], $data['destino_lat'], $data['destino_lng']) ||
    empty($data['nome_rota'])
) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
    exit;
}

$usuario_id = $_SESSION['usuario_id']; // ID do usuário logado
$nome_rota = $data['nome_rota'];
$origem_lat = $data['origem_lat'];
$origem_lng = $data['origem_lng'];
$destino_lat = $data['destino_lat'];
$destino_lng = $data['destino_lng'];

// Usar prepared statements para evitar injeção SQL
$sql = "INSERT INTO rotas_salvas (usuario_id, nome_rota, origem_lat, origem_lng, destino_lat, destino_lng) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isdddd", $usuario_id, $nome_rota, $origem_lat, $origem_lng, $destino_lat, $destino_lng);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Rota salva com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar a rota: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>