<?php 
require_once '../../config/database.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die(json_encode(["erro" => "Método não permitido"]));
}
try {   
    $stmt = $pdo->prepare("UPDATE transactions SET user_id = :user_id, account_id = :account_id, category_id = :category_id, descricao = :descricao, valor = :valor, tipo = :tipo, data = :data WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->bindParam(':user_id', $_POST['user_id']);
    $stmt->bindParam(':account_id', $_POST['account_id']);
    $stmt->bindParam(':category_id', $_POST['category_id']);
    $stmt->bindParam(':descricao', $_POST['descricao']);
    $stmt->bindParam(':valor', $_POST['valor']);
    $stmt->bindParam(':tipo', $_POST['tipo']);
    $stmt->bindParam(':data', $_POST['data']);
    $stmt->execute();
    echo json_encode(["success" => "Transação atualizada com sucesso"]);
} catch (PDOException $e) {
    die(json_encode(["erro" => $e->getMessage()]));
}