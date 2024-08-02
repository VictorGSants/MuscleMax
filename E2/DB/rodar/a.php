<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musclemax";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Remover a restrição de chave estrangeira
$sql_remove_fk = "ALTER TABLE Workouts DROP FOREIGN KEY workouts_ibfk_1";

if ($conn->query($sql_remove_fk) === TRUE) {
    echo "Restrição de chave estrangeira removida com sucesso.<br>";
} else {
    echo "Erro ao remover a restrição de chave estrangeira: " . $conn->error . "<br>";
}

// Encerra a conexão com o banco de dados
$conn->close();
?>