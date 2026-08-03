<?php
session_start();
header('Content-Type: application/json');

require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido']);
    exit;
}

$email = $_POST['email'] ?? '';
$password = $_POST['senha'] ?? '';

if ($email === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Email e senha são obrigatórios']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['senha'])) {
        // Guarda só o necessário na sessão — nunca a senha
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];

        echo json_encode(['sucesso' => true, 'mensagem' => 'Login bem-sucedido!']);
    } else {
        http_response_code(401);
        echo json_encode(['sucesso' => false, 'mensagem' => 'Email ou senha incorretos']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao fazer login']);
}