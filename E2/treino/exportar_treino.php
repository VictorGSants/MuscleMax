<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Treino</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Exportar Treino</h2>

    <?php
    // Código PHP para exportar o treino
    // ...
        
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Seu nome de usuário do banco de dados
    $password = ""; // Sua senha do banco de dados
    $dbname = "musclemax";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se o UserID está definido na sessão
    session_start();
    if(isset($_SESSION['UserID'])) {
        $userID = $_SESSION['UserID'];
    } else {
        // Se o UserID não estiver definido na sessão, redirecione para a página de login
        header("Location: login.php");
        exit; 
    }

    // Verifica se o ID do treino está definido na URL
    if(isset($_GET['id'])) {
        $workoutID = $_GET['id'];

        // Consulta para recuperar os detalhes do treino do usuário
        $sql = "SELECT w.WorkoutName, eiw.Sets, eiw.Reps, eiw.Weight, eiw.RestTimeSeconds, e.ExerciseName, e.Description
                FROM Workouts w
                INNER JOIN ExercisesInWorkout eiw ON w.WorkoutID = eiw.WorkoutID
                INNER JOIN Exercises e ON eiw.ExerciseID = e.ExerciseID
                WHERE w.UserID = $userID AND w.WorkoutID = $workoutID";

        $result = $conn->query($sql);

        // Nome do arquivo de texto
        $filename = "treino_usuario_$workoutID.txt";

        // Cria ou abre o arquivo de texto para escrita
        $file = fopen($filename, "w");

        // Verifica se a consulta retornou resultados
        if ($result->num_rows > 0) {
            // Escreve os detalhes do treino no arquivo de texto
            $workoutName = "";
            while ($row = $result->fetch_assoc()) {
                // Mostra o nome do treino apenas uma vez
                if (empty($workoutName)) {
                    $workoutName = $row['WorkoutName'];
                    fwrite($file, "Treino: " . $workoutName . "\n\n");
                }
                fwrite($file, "Exercício: " . $row['ExerciseName'] . "\n");
                fwrite($file, "Descrição: " . $row['Description'] . "\n");
                fwrite($file, "Séries: " . $row['Sets'] . "\n");
                fwrite($file, "Repetições: " . $row['Reps'] . "\n");
                fwrite($file, "Peso: " . $row['Weight'] . "\n");
                fwrite($file, "Tempo de Descanso (segundos): " . $row['RestTimeSeconds'] . "\n\n");
            }
            // Mostra o link para download do arquivo de texto
            echo "Treino exportado com sucesso para <a href='$filename' download>$filename</a>";
        } else {
            echo "Nenhum treino encontrado para exportar.";
        }

        // Fecha o arquivo
        fclose($file);
    } else {
        echo "ID do treino não especificado.";
    }

    // Fecha a conexão
    $conn->close();

    // Verifica se o treino foi exportado com sucesso

    // Exibe a mensagem de sucesso ou erro
    ?>

    <div style="text-align: center; margin-top: 20px;">
        <a href="detalhes_treino.php?id=<?php echo $workoutID; ?>" class="btn">Voltar para Detalhes do Treino</a>
    </div>
</div>

</body>
</html>
