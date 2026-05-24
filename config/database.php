<?php

$host = "db";
$dbname = "matcapital";
$username = "M10";
$password = "Matheus11";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); // Cria uma nova conexão PDO
    // Configura o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { // Em caso de erro, exibe uma mensagem e termina a execução
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

?>