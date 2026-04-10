<?php 
include 'conexao.php'; 
$mensagem = "";

// No topo do seu index.php, substitua a captura de dados por esta:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome     = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? ''; // Isso remove o erro da linha 7
    $email    = $_POST['email'] ?? '';    // Isso remove o erro da linha 8
    $data     = $_POST['data'] ?? '';
    $hora     = $_POST['hora'] ?? '';
    $servico  = $_POST['servico'] ?? '';
    
    // 1. Validação de conflito de horário
    $stmtCheck = $pdo->prepare("SELECT id FROM agendamentos WHERE data = ? AND hora = ?");
    $stmtCheck->execute([$data, $hora]);

    if ($stmtCheck->rowCount() > 0) {
        $mensagem = "<div class='alert alert-danger'>Desculpe, este horário já está reservado.</div>";
    } else {
        // 2. Inserir Cliente
        $stmtCli = $pdo->prepare("INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)");
        $stmtCli->execute([$nome, $telefone, $email]);
        $cliente_id = $pdo->lastInsertId();

        // 3. Inserir Agendamento
        $stmtAge = $pdo->prepare("INSERT INTO agendamentos (cliente_id, data, hora, servico) VALUES (?, ?, ?, ?)");
        $stmtAge->execute([$cliente_id, $data, $hora, $servico]);
        
        $mensagem = "<div class='alert alert-success'>Agendamento realizado com sucesso!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Barbearia - Agendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; }
        .navbar { background-color: #1a1a1a !important; }
        .card { border-radius: 12px; border: none; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">💈 BarberSystem</a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link active" href="index.php">Agendar</a>
      <a class="nav-link" href="lista.php">Administração</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php echo $mensagem; ?>
            <div class="card p-4 shadow-sm">
                <h2 class="text-center mb-4">Novo Agendamento</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" name="data" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" name="hora" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Serviço</label>
                        <input type="text" name="servico" class="form-control" placeholder="Ex: Corte e Barba" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Confirmar Reserva</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>