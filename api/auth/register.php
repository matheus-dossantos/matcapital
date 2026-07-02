<?php
require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

    try {
            $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->bindParam(':nome', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $password);
            $stmt->execute();
            echo "Usuário cadastrado com sucesso!";
        } catch (PDOException $e) {
            die("Erro ao cadastrar: " . $e->getMessage());
        }
    }