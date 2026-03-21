<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamentos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">Lista de Agendamentos</h2>
  <table class="table table-striped table-hover shadow">
    <thead class="table-dark">
      <tr>
        <th>Cliente</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Serviço</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $pdo->query("SELECT c.nome, a.data, a.hora, a.servico 
                           FROM agendamentos a 
                           JOIN clientes c ON a.cliente_id = c.id");
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>
                  <td>{$row['nome']}</td>
                  <td>{$row['data']}</td>
                  <td>{$row['hora']}</td>
                  <td>{$row['servico']}</td>
                </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>