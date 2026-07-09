<?php 
require_once '../../config/database.php';
header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT * FROM transactions");
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($transactions);
} catch (PDOException $e) {
    die(json_encode(["erro" => $e->getMessage()]));
}