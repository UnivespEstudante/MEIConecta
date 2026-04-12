<?php
include 'conexao.php'; // conexão
include 'auth.php';    // funções de login

// Recebe dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Tenta logar
if (login($pdo, $usuario, $senha)) {
    header("Location: index.php"); // sucesso → vai para home
    exit;
} else {
    // erro → mostra mensagem
    echo "<div class='alert alert-danger'>Usuário ou senha inválidos!</div>";
    echo "<a href='index.php'>Voltar</a>";
}
?>