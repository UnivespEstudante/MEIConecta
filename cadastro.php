<?php
include 'conexao.php'; // conexão

// Recebe dados do formulário
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // senha com hash

// Verificação antes do INSERT se o usuário ja esta cadastrado
$stmt = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE usuario = ?");
$stmt->execute([$usuario]);
if ($stmt->fetchColumn() > 0) {
        // Mensagem de Erro
        echo"<div class='alert alert-danger'>
                 Usuário já existe. Escolha outro nome de usuário.
            </div> <a href='index.php' class='btn btn-primary mt-2'>Voltar para o cadastro</a>
    ";

    } else {
        // Cadastra no BD
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone, email, usuario, senha) VALUES (?, ?, ?, ?, ?)");
        // Mensagem de sucesso
        $stmt->execute([$nome, $telefone, $email, $usuario, $senha]);
        echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
    }
?>

