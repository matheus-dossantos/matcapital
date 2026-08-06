<?php 
require_once '../../config/database.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die(json_encode(["erro" => "Método não permitido"]));
}
try {
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
    echo json_encode(["successo" => "Categoria deletada com sucesso"]);
} catch (PDOException $e) {
        error_log($e->getMessage());          // detalhe técnico vai pro log do servidor (só você vê)
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao deletar categoria']);  // mensagem genérica pro cliente
    }