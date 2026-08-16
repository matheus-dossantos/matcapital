<?php
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $stmt = $pdo->prepare("SELECT tipo, SUM(valor) AS total FROM transactions GROUP BY tipo");
    $stmt->execute();
    $summary = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($summary);
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao buscar resumo']);
}