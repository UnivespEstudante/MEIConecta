<?php
session_start();
$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Login acadêmico simples
    if ($usuario === 'admin' && $senha === '1234') {
        $_SESSION['logado'] = true;
        header("Location: lista.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1a1a1a; display: flex; align-items: center; height: 100vh; }
        .card { width: 100%; max-width: 350px; margin: auto; border: none; border-radius: 15px; }
    </style>
</head>
<body>
    <div class="card shadow p-4">
        <h4 class="text-center mb-4">🔐 Área Restrita</h4>
        <?php if($erro) echo "<div class='alert alert-danger small'>$erro</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Usuário</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Entrar</button>
        </form>
    </div>
</body>
</html>