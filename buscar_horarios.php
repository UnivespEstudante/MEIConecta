<?php
include 'conexao.php';

if (!isset($_GET['data'])) {
    echo json_encode([]);
    exit;
}

$data = $_GET['data'];

// Busca horários ocupados
$stmt = $pdo->prepare("SELECT hora FROM agendamentos WHERE data = ?");
$stmt->execute([$data]);
$ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Normaliza para HH:MM
$ocupados = array_map(function($h) {
    return substr($h, 0, 5);
}, $ocupados);

// Gera lista de horários livres
$livres = [];

for ($h = 8; $h <= 19; $h++) {
    $hora = str_pad($h, 2, '0', STR_PAD_LEFT) . ":00";

    if (!in_array($hora, $ocupados)) {
        $livres[] = $hora;
    }
}

echo json_encode($livres);