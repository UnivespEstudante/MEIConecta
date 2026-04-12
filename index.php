<?php
include 'conexao.php'; // conexão com banco
include 'auth.php';    // funções de login/logout
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Home - Barbearia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include 'header.php'; // inclui barra de navegação ?>
<div class="container mt-1">
  <?php if (isLogged()): ?>
    <!-- Mensagem se já estiver logado -->
    <h1>Bem-vindo, <?php echo $_SESSION['cliente_nome']; ?>!</h1>
    <p>Use o menu acima para navegar.</p>
  <?php else: ?>
    <!-- Tela inicial com login e cadastro -->
    <h2>Bem-vindo à Barbearia</h2>
    <p>Faça login ou cadastre-se para continuar.</p>

    <!-- Formulário de Login -->
    <div class="card p-3 mb-2">
      <h3>Login</h3>
      <form method="POST" action="login.php">
        <div class="mb-2"><input type="text" name="usuario" class="form-control" placeholder="Usuário" required></div>
        <div class="mb-2"><input type="password" name="senha" class="form-control" placeholder="Senha" required></div>
        <button type="submit" class="btn btn-primary">Entrar</button>
      </form>
    </div>

    <!-- Formulário de Cadastro -->
    <div class="card p-3">
      <h3>Cadastro</h3>
      <form method="POST" action="cadastro.php">
        <div class="mb-2"><input type="text" name="nome" class="form-control" placeholder="Nome" required></div>
        <div class="mb-2"><input type="text" name="telefone" class="form-control" placeholder="Telefone"></div>
        <div class="mb-2"><input type="email" name="email" class="form-control" placeholder="Email"></div>
        <div class="mb-2"><input type="text" name="usuario" class="form-control" placeholder="Usuário" required></div>
        <div class="mb-2"><input type="password" name="senha" class="form-control" placeholder="Senha" required></div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
      </form>
    </div>
  <?php endif; ?>
</div>
<?php include 'footer.php'; // inclui rodapé ?>
</body>
</html>