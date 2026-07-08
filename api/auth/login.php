<?php 
require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['senha'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['senha'])) {
            echo "Login bem-sucedido!";
            // Aqui você pode iniciar uma sessão ou gerar um token JWT
        } else {
            echo "Email ou senha incorretos.";
        }
    } catch (PDOException $e) {
        die("Erro ao fazer login: " . $e->getMessage());
    }
}