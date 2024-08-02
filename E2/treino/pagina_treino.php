<?php
    $servername = "localhost";
    $username = "root"; // Altere para o seu usuário do banco de dados
    $password = ""; // Altere para a sua senha do banco de dados
    $dbname = "musclemax";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    session_start();

    // Verificar se o UserID está definido na sessão
    if(isset($_SESSION['UserID'])) {
        $userID = $_SESSION['UserID'];
    } else {
        // Defina um valor padrão para $userID ou redirecione para a página de login
        // Aqui, estou redirecionando para a página de login
        header("Location: login.php");
        exit; // Certifique-se de sair após redirecionar
    }

    // Verifica se foi submetido um formulário de exclusão de treino
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['workout_id'])) {
        $workout_id_to_delete = $_POST['workout_id'];

        // Excluir os registros de exercícios associados ao treino na tabela exercisesinworkout
        $sql_delete_exercises = "DELETE FROM exercisesinworkout WHERE WorkoutID = $workout_id_to_delete";
        if ($conn->query($sql_delete_exercises) === TRUE) {
            // Excluir o treino da tabela Workouts
            $sql_delete_workout = "DELETE FROM Workouts WHERE WorkoutID = $workout_id_to_delete";
            if ($conn->query($sql_delete_workout) === TRUE) {
            } else {
                echo "Erro ao excluir o treino: " . $conn->error;
            }
        } else {
            echo "Erro ao excluir os registros de exercícios associados ao treino: " . $conn->error;
        }
    }

    // Consulta para recuperar os treinos do usuário logado
    $sql = "SELECT * FROM Workouts WHERE UserID = $userID OR UserID IS NULL";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Treinos - MuscleMax</title>
    <link rel="stylesheet" href="pagina_treino.css">
</head>
<body>
    <a href="../pagina/home2.php" class="btn-home">Home</a>
    <a href='importar_treino.php' class='btn-import'>importar Treino</a>

    <div class="container">
        <h1>Meus Treinos</h1>
        <div class="actions">
            <a href="criar_treino.php" class="btn-create">Criar Novo Treino</a>
        </div>
        <div class="treinos">
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='treino'>";
                        echo "<a href='../treino/detalhes_treino.php?id=" . $row['WorkoutID'] . "'>";
                        echo "<h2>" . $row['WorkoutName'] . "</h2>";
                        echo "</a>";
                        // Adicionando o botão de exclusão
                        echo "<form method='POST' action='".$_SERVER["PHP_SELF"]."'>";
                        echo "<input type='hidden' name='workout_id' value='" . $row['WorkoutID'] . "'>";
                        echo "<button type='submit' class='btn-delete'>Excluir</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Nenhum treino encontrado.</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>
