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
        echo json_encode(['sucesso' => true, 'mensagem' => 'Categoria criada com sucesso!']);
    } catch (PDOException $e) {
        error_log($e->getMessage());          // detalhe técnico vai pro log do servidor (só você vê)
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao criar categoria']);  // mensagem genérica pro cliente
    }
}