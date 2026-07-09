<?php 
require_once '../../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $account_id = $_POST['account_id'];
    $category_id = $_POST['category_id'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    try {
        $stmt = $pdo->prepare("INSERT INTO transactions (user_id, account_id, category_id, descricao, valor, tipo, data) VALUES (:user_id, :account_id, :category_id, :descricao, :valor, :tipo, :data)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':data', $data);
        $stmt->execute();
        echo "Transação criada com sucesso!";
    } catch (PDOException $e) {
        die("Erro ao criar transação: " . $e->getMessage());
    }
}