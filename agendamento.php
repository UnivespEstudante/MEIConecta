<?php
include 'conexao.php';
include 'auth.php';

if (!isLogged()) {
    header("Location: index.php");
    exit;
}

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $servico = $_POST['servico'];
    $cliente_id = $_SESSION['cliente_id'];

    // Valida se a data não é passada
    if (strtotime($data) < strtotime(date("Y-m-d"))) {
        $mensagem = "<div class='alert alert-danger'>Não é possível agendar em datas passadas.</div>";
    } else {
        // Verifica se horário já está ocupado
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM agendamentos WHERE data = ? AND hora = ?");
        $stmt->execute([$data, $hora]);
        if ($stmt->fetchColumn() > 0) {
            $mensagem = "<div class='alert alert-danger'>Este horário já está ocupado. Escolha outro.</div>";
        } else {
            // Insere agendamento
            $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente_id, data, hora, servico) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cliente_id, $data, $hora, $servico]);
            $mensagem = "<div class='alert alert-success'>Agendamento realizado com sucesso!</div>";
        }
    }
}

// Busca todos os agendamentos do cliente logado
$stmt = $pdo->prepare("SELECT data, hora, servico FROM agendamentos WHERE cliente_id = ? ORDER BY data, hora");
$stmt->execute([$_SESSION['cliente_id']]);
$agendamentos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamento - Barbearia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-4">
  <?php echo $mensagem; ?>

  <h2>Seus agendamentos</h2>
  <?php if ($agendamentos): ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Data</th>
          <th>Hora</th>
          <th>Serviço</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($agendamentos as $a): ?>
          <tr>
            <td><?php echo date("d/m/Y", strtotime($a['data'])); ?></td>
            <td><?php echo $a['hora']; ?></td>
            <td><?php echo $a['servico']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Você ainda não possui agendamentos.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>