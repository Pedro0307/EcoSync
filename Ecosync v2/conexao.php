<?php
$host = "localhost";
$user = "root";   
$pass = "123456";
$db   = "cadastro";

$conexao = new mysqli($host, $user, $pass, $db);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>
