<?php
    // Inicia a sessão
    session_start();

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Seu nome de usuário do banco de dados
    $password = ""; // Sua senha do banco de dados
    $dbname = "musclemax";

    // Verifica se o arquivo foi enviado corretamente
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Nome temporário do arquivo
        $tmpFilePath = $_FILES['fileInput']['tmp_name'];

        // Lê o conteúdo do arquivo
        $fileContent = file_get_contents($tmpFilePath);

        // Divide o conteúdo do arquivo em linhas
        $lines = explode("\n", $fileContent);

        // Variáveis para armazenar os detalhes do treino
        $workoutName = "";
        $exerciseID = 0;
        $sets = "";
        $reps = "";
        $weight = "";
        $restTimeSeconds = "";

        // Pega o UserID da sessão
        $userID = $_SESSION['UserID'];

        // Preparar a declaração SQL para inserir um novo exercício
        $sql_insert_exercise = "INSERT INTO ExercisesInWorkout (WorkoutID, ExerciseID, Sets, Reps, Weight, RestTimeSeconds) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert_exercise = $conn->prepare($sql_insert_exercise);

        // Loop através de cada linha do arquivo
        foreach ($lines as $line) {
            // Verifica o prefixo da linha para identificar o tipo de informação
            if (strpos($line, "Treino:") !== false) {
                // Se a linha contém o nome do treino, atualiza a variável $workoutName
                $workoutName = trim(str_replace("Treino:", "", $line));

                // Insere o novo treino na tabela Workouts
                $sql_insert_workout = "INSERT INTO Workouts (WorkoutName, UserID) VALUES (?, ?)";
                $stmt_insert_workout = $conn->prepare($sql_insert_workout);
                $stmt_insert_workout->bind_param("si", $workoutName, $userID);
                $stmt_insert_workout->execute();
                $workoutID = $stmt_insert_workout->insert_id; // Obtém o ID do treino recém-inserido
                $stmt_insert_workout->close(); // Fecha a declaração preparada
            } elseif (strpos($line, "Exercício:") !== false) {
                // Se a linha contém o nome do exercício, insere-o na tabela Exercises
                $exerciseName = trim(str_replace("Exercício:", "", $line));

                $sql_insert_exercise_details = "INSERT INTO Exercises (ExerciseName, Description) VALUES (?, '')";
                $stmt_insert_exercise_details = $conn->prepare($sql_insert_exercise_details);
                $stmt_insert_exercise_details->bind_param("s", $exerciseName);
                $stmt_insert_exercise_details->execute();
                $exerciseID = $stmt_insert_exercise_details->insert_id; // Obtém o ID do exercício recém-inserido
                $stmt_insert_exercise_details->close(); // Fecha a declaração preparada
            } elseif (strpos($line, "Séries:") !== false) {
                // Se a linha contém o número de séries, atualiza a variável $sets
                $sets = trim(str_replace("Séries:", "", $line));
            } elseif (strpos($line, "Repetições:") !== false) {
                // Se a linha contém o número de repetições, atualiza a variável $reps
                $reps = trim(str_replace("Repetições:", "", $line));
            } elseif (strpos($line, "Peso:") !== false) {
                // Se a linha contém o peso, atualiza a variável $weight
                $weight = trim(str_replace("Peso:", "", $line));
            } elseif (strpos($line, "Tempo de Descanso (segundos):") !== false) {
                // Se a linha contém o tempo de descanso, atualiza a variável $restTimeSeconds
                $restTimeSeconds = trim(str_replace("Tempo de Descanso (segundos):", "", $line));

                // Vincula os parâmetros e executa a declaração preparada para inserir o exercício
                $stmt_insert_exercise->bind_param("iissss", $workoutID, $exerciseID, $sets, $reps, $weight, $restTimeSeconds);
                $stmt_insert_exercise->execute();
            }
        }

        // Fecha a declaração preparada
        $stmt_insert_exercise->close();

        // Fecha a conexão
        $conn->close();

        // Após o processamento, redireciona de volta para a página de treinos
        header("Location: pagina_treino.php");
        exit;
    } else {
        // Se o arquivo não foi enviado corretamente, redireciona de volta para a página de importação com uma mensagem de erro
        header("Location: importar_treino.php?error=file_upload");
        exit;
    }
?>
