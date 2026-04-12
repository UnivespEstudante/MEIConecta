<?php
// Configurações do banco
$host = "localhost";
$dbname = "bd_agenda_barber_web";
$user = "root";
$pass = "";

try {
    // Cria conexão com PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Define que erros serão tratados como exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Mostra mensagem de erro e encerra
    echo "Erro na conexão com o banco: " . $e->getMessage();
    exit;
}
?>