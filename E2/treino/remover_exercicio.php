<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Exercício - MuscleMax</title>
    <link rel="stylesheet" href="remover_exercicio.css"> <!-- Adicione o seu arquivo de estilo aqui -->
</head>
<body>
    <div class="container">
        <h1>Remover Exercício</h1>
        <?php
            // Verifica se os parâmetros workoutID e exerciseID foram passados na URL
            if(isset($_GET['workoutID']) && isset($_GET['exerciseID'])) {
                $workoutID = $_GET['workoutID'];
                $exerciseID = $_GET['exerciseID'];

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

                // Consulta para remover o exercício do treino
                $sql = "DELETE FROM ExercisesInWorkout WHERE WorkoutID = $workoutID AND ExerciseID = $exerciseID";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>Exercício removido com sucesso do treino.</p>";
                } else {
                    echo "<p>Erro ao remover exercício do treino: " . $conn->error . "</p>";
                }

                $conn->close();
            } else {
                echo "<p>ID do treino ou do exercício não especificado.</p>";
            }
        ?>
        <!-- Botão para voltar à página de detalhes do treino -->
        <a href="detalhes_treino.php?id=<?php echo $workoutID; ?>" class="btn-back">&lt; Voltar para Detalhes do Treino</a>
    </div>
</body>
</html>
