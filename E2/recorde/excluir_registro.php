<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musclemax";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o ID do registro está presente na URL
if (isset($_GET['recordID'])) {
    $recordID = $_GET['recordID'];

    // Prepara e executa a query SQL para excluir o registro com o ID fornecido
    $sql = "DELETE FROM ExerciseRecords WHERE RecordID = $recordID";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página anterior após a exclusão
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Erro ao excluir registro: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
