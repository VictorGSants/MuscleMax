<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Treino</title>
    <link rel="stylesheet" href="detalhes_treino.css">
    <style>
        body {
            position: relative;
        }
        
        iframe#cronometro {
            position: fixed;
            top: 20px;
            right: 20px;
            border: none;
        }
    </style>
</head>
<body>
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

    // Verifica se foi passado o parâmetro ID na URL
    if(isset($_GET['id'])) {
        $workoutID = $_GET['id'];

        // Consulta para recuperar os detalhes do treino
        $sql = "SELECT * FROM ExercisesInWorkout WHERE WorkoutID = $workoutID";
        $result = $conn->query($sql);

        echo"<a href='../treino/pagina_treino.php' class='btn-back'>&lt;</a>";
        echo"<a href='exportar_treino.php?id=$workoutID' class='btn-export'>Exportar Treino</a>";
        echo"<iframe id='cronometro' src='../outros/cronometro.php' frameborder='0' width='320' height='400'></iframe>";

        // Verifica se encontrou resultados
        if ($result->num_rows > 0) {
            // Exibir os detalhes do treino
            while ($row = $result->fetch_assoc()) {
                // Consulta adicional para recuperar o nome e descrição do exercício
                $sqlExerciseDetails = "SELECT ExerciseName, Description FROM Exercises WHERE ExerciseID = " . $row['ExerciseID'];
                $resultExerciseDetails = $conn->query($sqlExerciseDetails);

                // Verifica se encontrou os detalhes do exercício
                if ($resultExerciseDetails->num_rows > 0) {
                    // Exibir o nome e descrição do exercício
                    $exerciseDetailsRow = $resultExerciseDetails->fetch_assoc();
                    $exerciseName = $exerciseDetailsRow['ExerciseName'];
                    $description = $exerciseDetailsRow['Description'];
                } else {
                    $exerciseName = "Nome do Exercício Não Encontrado";
                    $description = "Descrição do Exercício Não Encontrada";
                }

                echo "<div class='exercise'>";
                echo "<h3>Exercício: " . $exerciseName . "</h3>";
                echo "<p>Séries: " . $row['Sets'] . "</p>";
                echo "<p>Repetições: " . $row['Reps'] . "</p>";
                echo "<p>Peso: " . $row['Weight'] . "</p>";
                echo "<p>Tempo de Descanso (segundos): " . $row['RestTimeSeconds'] . "</p>";
                echo "<button onclick=\"showDescription('" . addslashes($description) . "')\" class='btn-show-description'>Mostrar Descrição</button>";
                echo "<a href='../treino/editar_treino.php?workoutID=$workoutID&exerciseID=" . $row['ExerciseID'] . "' class='btn-edit'>Editar Exercício</a>";
                echo "<button onclick='removeExercise($workoutID, " . $row['ExerciseID'] . ")' class='btn-remove'>Remover Exercício</button>";
                echo "</div>";
            }
        } else {
            echo "<p style='color: white;'>Nenhum exercício encontrado para este treino.</p>";
        }
    } else {
        echo "<p style='color: white;'>ID do treino não especificado.</p>";
    }

    $conn->close();
?>

<!-- Adicionar botão para voltar à página de treino -->

<script>
    function removeExercise(workoutID, exerciseID) {
        if (confirm("Tem certeza que deseja remover este exercício do treino?")) {
            window.location.href = "remover_exercicio.php?workoutID=" + workoutID + "&exerciseID=" + exerciseID;
        }
    }
    function showDescription(description) {
        // Obtém a referência da div de descrição
        var descriptionDiv = document.getElementById('exerciseDescription');

        // Atualiza o conteúdo da div com a descrição do exercício
        descriptionDiv.innerHTML = description;
        
        // Cria o botão para fechar a descrição
        var closeButton = document.createElement('button');
        closeButton.textContent = "Fechar Descrição";
        closeButton.classList.add('btn-close-description');
        closeButton.onclick = function() {
            hideDescription();
        };
        
        // Adiciona o botão à div de descrição
        descriptionDiv.appendChild(closeButton);

        // Exibe a div de descrição
        descriptionDiv.style.display = 'block';
    }
    function hideDescription() {
        // Obtém a referência da div de descrição
        var descriptionDiv = document.getElementById('exerciseDescription');
        
        // Oculta a div de descrição
        descriptionDiv.style.display = 'none';
    }
</script>

<div id="exerciseDescription" class="exercise-description"></div>
</body>
</html>
