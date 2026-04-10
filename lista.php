


<?php 

session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}
include 'conexao.php'; 

// Lógica de Exclusão
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: lista.php?msg=sucesso");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">💈 BarberSystem</a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link" href="index.php">Agendar</a>
      <a class="nav-link active" href="lista.php">Administração</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Lista de Agendamentos</h2>
    
    <?php if(isset($_GET['msg'])) echo "<div class='alert alert-info'>Operação realizada!</div>"; ?>

    <div class="table-responsive shadow-sm bg-white p-3 rounded">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Serviço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT a.id, c.nome, a.data, a.hora, a.servico 
                                     FROM agendamentos a 
                                     JOIN clientes c ON a.cliente_id = c.id
                                     ORDER BY a.data ASC, a.hora ASC");
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Formatação de data simples
                    $dataBR = date('d/m/Y', strtotime($row['data']));
                    echo "<tr>
                            <td>{$row['nome']}</td>
                            <td>{$dataBR}</td>
                            <td>{$row['hora']}</td>
                            <td>{$row['servico']}</td>
                            <td>
                                <a href='lista.php?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Deseja realmente cancelar este agendamento?')\">Cancelar</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>