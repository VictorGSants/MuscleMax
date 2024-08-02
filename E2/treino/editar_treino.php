<?php
    $servername = "localhost";
    $username = "root"; // Altere para o seu usuário do banco de dados
    $password = ""; // Altere para a sua senha do banco de dados
    $dbname = "musclemax";

    // Inicializa variáveis
    $sets = $reps = $weight = $restTimeSeconds = "";
    $sets_err = $reps_err = $weight_err = $restTimeSeconds_err = "";

    // Processar dados do formulário quando o formulário for submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validação das séries
        $sets = trim($_POST["sets"]);
        if (empty($sets)) {
            $sets_err = "Por favor, insira o número de séries.";     
        }

        // Validação das repetições
        $reps = trim($_POST["reps"]);
        if (empty($reps)) {
            $reps_err = "Por favor, insira o número de repetições.";     
        }

        // Validação do peso
        $weight = trim($_POST["weight"]);
        if (empty($weight)) {
            $weight_err = "Por favor, insira o peso.";     
        }

        // Validação do tempo de descanso
        $restTimeSeconds = trim($_POST["restTimeSeconds"]);
        if (empty($restTimeSeconds)) {
            $restTimeSeconds_err = "Por favor, insira o tempo de descanso em segundos.";     
        }

        // Pega os IDs de treino e exercício da URL
        $workoutID = $_GET["workoutID"];
        $exerciseID = $_GET["exerciseID"];

        // Verifica se há erros de entrada antes de inserir no banco de dados
        if (empty($sets_err) && empty($reps_err) && empty($weight_err) && empty($restTimeSeconds_err)) {
            // Cria a conexão
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Prepara a declaração de atualização
            $sql = "UPDATE ExercisesInWorkout SET Sets=?, Reps=?, Weight=?, RestTimeSeconds=? WHERE WorkoutID=? AND ExerciseID=?";

            if ($stmt = $conn->prepare($sql)) {
                // Vincula as variáveis aos parâmetros da declaração preparada como parâmetros
                $stmt->bind_param("iidiii", $param_sets, $param_reps, $param_weight, $param_restTimeSeconds, $param_workoutID, $param_exerciseID);

                // Define os parâmetros
                $param_sets = $sets;
                $param_reps = $reps;
                $param_weight = $weight;
                $param_restTimeSeconds = $restTimeSeconds;
                $param_workoutID = $workoutID;
                $param_exerciseID = $exerciseID;

                // Executa a declaração
                if ($stmt->execute()) {
                    // Redireciona para a página de visualização do treino
                    header("location: ../treino/detalhes_treino.php?id=" . $workoutID);
                    exit();
                } else {
                    echo "Algo deu errado. Por favor, tente novamente mais tarde.";
                }
            } else {
                echo "Erro na preparação da declaração SQL: " . $conn->error;
            }

            // Fecha declaração
            $stmt->close();
            
            // Fecha conexão
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Treino - MuscleMax</title>
    <link rel="stylesheet" href="editar_treino.css">
</head>
<body>
<a href="../treino/detalhes_treino.php?id=<?php echo $_GET['workoutID']; ?>" class="btn-back"><</a>
    <div class="container">
        
        <h1>Editar Exercício</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?workoutID=<?php echo $_GET['workoutID']; ?>&exerciseID=<?php echo $_GET['exerciseID']; ?>" method="post">
            <div class="form-group">
                <label>Séries</label>
                <input type="text" name="sets" class="form-control" value="<?php echo $sets; ?>">
                <span class="help-block"><?php echo $sets_err;?></span>
            </div>
            <div class="form-group">
                <label>Repetições</label>
                <input type="text" name="reps" class="form-control" value="<?php echo $reps; ?>">
                <span class="help-block"><?php echo $reps_err;?></span>
            </div>
            <div class="form-group">
                <label>Peso</label>
                <input type="text" name="weight" class="form-control" value="<?php echo $weight; ?>">
                <span class="help-block"><?php echo $weight_err;?></span>
            </div>
            <div class="form-group">
                <label>Tempo de Descanso (segundos)</label>
                <input type="text" name="restTimeSeconds" class="form-control" value="<?php echo $restTimeSeconds; ?>">
                <span class="help-block"><?php echo $restTimeSeconds_err;?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Atualizar">
            </div>   
        </form>
    </div>
</body>
</html>
