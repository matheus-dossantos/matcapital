<?php 
require_once '../../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $cor = $_POST['cor'];
    $icone = $_POST['icone'];
    try {
        $stmt = $pdo->prepare("INSERT INTO categories (user_id, nome, tipo, cor, icone) VALUES (:user_id, :nome, :tipo, :cor, :icone)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':icone', $icone);
        $stmt->execute();
        echo "Categoria criada com sucesso!";
    } catch (PDOException $e) {
        die("Erro ao criar categoria: " . $e->getMessage());
    }
}