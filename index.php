<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agenda Barbearia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h1 class="text-center mb-4">Agendamento de Clientes</h1>
  
  <form method="POST" action="" class="card p-4 shadow">
    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Telefone</label>
      <input type="text" name="telefone" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Data</label>
      <input type="date" name="data" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Hora</label>
      <input type="time" name="hora" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Serviço</label>
      <input type="text" name="servico" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Agendar</button>
  </form>
</div>

</body>
</html>

<!--Envio dos dados do formulário para o banco de dados-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $servico = $_POST['servico'];

    // Inserir cliente
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $telefone, $email]);
    $cliente_id = $pdo->lastInsertId();

    // Inserir agendamento
    $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente_id, data, hora, servico) VALUES (?, ?, ?, ?)");
    $stmt->execute([$cliente_id, $data, $hora, $servico]);

    echo "Agendamento realizado com sucesso!";
}
?>
