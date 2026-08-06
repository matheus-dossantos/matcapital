<?php 
require_once '../../config/database.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die(json_encode(["erro" => "Método não permitido"]));
}
try {   
    $stmt = $pdo->prepare("UPDATE categories SET user_id = :user_id, nome = :nome, tipo = :tipo, cor = :cor, icone = :icone WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->bindParam(':user_id', $_POST['user_id']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':tipo', $_POST['tipo']);
    $stmt->bindParam(':cor', $_POST['cor']);
    $stmt->bindParam(':icone', $_POST['icone']);
    $stmt->execute();
    echo json_encode(["sucesso" => "Categoria atualizada com sucesso"]);
    } catch (PDOException $e) {
        error_log($e->getMessage());          // detalhe técnico vai pro log do servidor (só você vê)
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao atualizar categoria']);  // mensagem genérica pro cliente
    }
