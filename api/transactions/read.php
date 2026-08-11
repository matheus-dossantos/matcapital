<?php 
require_once '../../config/database.php';
header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT * FROM transactions");
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($transactions);
} catch (PDOException $e) {
    error_log($e->getMessage());          // detalhe técnico vai pro log do servidor (só você vê)
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao buscar transações']);  // mensagem genérica pro cliente
}