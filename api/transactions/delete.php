<?php 
require_once '../../config/database.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die(json_encode(["erro" => "Método não permitido"]));
}
try {
    $stmt = $pdo->prepare("DELETE FROM transactions WHERE id = :id");
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
    echo json_encode(["success" => "Transação deletada com sucesso"]);
} catch (PDOException $e) {
    die(json_encode(["erro" => $e->getMessage()]));
}