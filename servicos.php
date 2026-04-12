<?php
include 'auth.php';
include 'conexao.php';

if (!isLogged()) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Serviços - Barbearia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-4">
  <h1>Serviços</h1>

  <form method="POST" action="agendamento.php" class="card p-3">

    <div class="mb-3">
      <label for="servico" class="form-label">Selecione o serviço</label>
      <select name="servico" id="servico" class="form-select" required>
        <option value="">-- Escolha --</option>
        <option value="Corte de cabelo">Corte de cabelo</option>
        <option value="Barba">Barba</option>
        <option value="Corte + Barba">Corte + Barba</option>
        <option value="Sobrancelha">Sobrancelha</option>
        <option value="Tratamento capilar">Tratamento capilar</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="data" class="form-label">Data</label>
      <input type="date" name="data" id="data" class="form-control" required>
    </div>

    <div class="mb -3">
      <label for="hora" class="form-label">Horário</label>
      <select name="hora" id="hora" class="form-select" required>
        <option value="">Selecione uma data primeiro</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Agendar</button>
  </form>
</div>

<?php include 'footer.php'; ?>

<script>
document.getElementById('data').addEventListener('change', function () {
    let data = this.value;

    fetch('buscar_horarios.php?data=' + data)
        .then(response => response.json())
        .then(horarios => {
            let select = document.getElementById('hora');
            select.innerHTML = '<option value="">Selecione um horário</option>';

            if (horarios.length === 0) {
                select.innerHTML = '<option value="">Nenhum horário disponível</option>';
                return;
            }

            horarios.forEach(h => {
                let opt = document.createElement('option');
                opt.value = h;
                opt.textContent = h;
                select.appendChild(opt);
            });
        });
});
</script>

</body>
</html>