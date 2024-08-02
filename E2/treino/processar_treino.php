<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processar Treino - MuscleMax</title>
    <link rel="stylesheet" href="processar_treino.css">
</head>
<body>
    <div class="container">
        <?php
            // Verifica se o formulário foi submetido
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['workout_name']) && isset($_POST['exercises'])) {
                    $workout_name = $_POST['workout_name'];
                    $exercises = $_POST['exercises'];

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

                    if(isset($_SESSION['UserID'])) {
                        $userID = $_SESSION['UserID'];
                    } else {
                        echo "UserID não está definido na sessão.";
                    }
                    // Insere o novo treino na tabela Workouts
                    $sql = "INSERT INTO Workouts (WorkoutName, UserID) VALUES ('$workout_name',  $userID)"; // Substitua "1" pelo ID do usuário logado
                    if ($conn->query($sql) === TRUE) {
                        $workout_id = $conn->insert_id; // Obtém o ID do treino recém-inserido

                        // Insere os exercícios associados ao treino na tabela ExercisesInWorkout
                        foreach ($exercises as $exercise_id) {
                            $sql = "INSERT INTO ExercisesInWorkout (WorkoutID, ExerciseID) VALUES ($workout_id, $exercise_id)";
                            $conn->query($sql);
                        }

                        echo "Treino criado com sucesso!";
                        echo '<a href="pagina_treino.php" class="btn btn-primary">Voltar para Página de Treino</a>';
                    } else {
                        echo "Erro ao criar o treino: " . $conn->error;
                    }

                    // Fecha a conexão
                    $conn->close();
                } else {
                    echo "Por favor, preencha todos os campos do formulário.";
                    echo '<a href="pagina_treino.php" class="btn btn-primary">Voltar para Página de Treino</a>';
                }
            } else {
                // Redireciona de volta para a página de criação de treino se o formulário não foi submetido
                header("Location: criar_treino.php");
                exit();
            }
        ?>
    </div>
</body>
</html>
            