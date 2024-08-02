<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Treino - MuscleMax</title>
    <link rel="stylesheet" href="criar_treino.css">
</head>
<body>
    <a href="pagina_treino.php" class="btn-voltar">Treinos</a>

    <div class="container">

        <h1>Criar Novo Treino</h1>
        <!-- Botão para criar novo exercício -->
        <form action="processar_treino.php" method="POST">
            <input type="text" id="workout_name" name="workout_name" required>
            
            <h2>Exercícios</h2>
            <input type="text" id="searchInput" onkeyup="searchExercise()" placeholder="Pesquisar exercício...">

            <label for="workout_name">Nome do Exercicio:</label>

            <div class="exercises-container" id="exercisesContainer">
                <?php
                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "root"; // Altere para o seu usuário do banco de dados
                    $password = ""; // Altere para a sua senha do banco de dados
                    $dbname = "musclemax";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verifica a conexão
                    if ($conn->connect_error) {
                        die("Conexão falhou: " . $conn->connect_error);
                    }

                    // Consulta para recuperar os exercícios do banco de dados
                    $sql = "SELECT * FROM Exercises";
                    $result = $conn->query($sql);

                    // Exibir os exercícios como checkboxes
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<input type='checkbox' name='exercises[]' value='" . $row['ExerciseID'] . "' class='exercise-checkbox'>";
                            echo "<label>" . $row['ExerciseName'] . "</label><br>";
                        }
                    } else {
                        echo "Nenhum exercício encontrado.";
                    }

                    // Fechar conexão
                    $conn->close();
                ?>
            </div>
            <a href="criar_exercicio.php" class="btn-criar-exercicio">Criar Novo Exercício</a>
            
            <input type="submit" value="Criar Treino">
        </form>

        <!-- Botão para voltar para página_treino.php -->
    </div>

    <script>
    function searchExercise() {
        var input, filter, ul, li, label, checkbox, br, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("exercisesContainer");
        li = ul.getElementsByTagName('label');
        for (i = 0; i < li.length; i++) {
            label = li[i];
            checkbox = label.previousElementSibling;
            br = label.nextElementSibling;
            txtValue = label.textContent || label.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                // Mostra a checkbox correspondente ao exercício
                checkbox.style.display = "";
                // Mostra a quebra de linha
                br.style.display = "";
            } else {
                // Esconde a div completa do item não procurado
                li[i].style.display = "none";
                // Esconde a checkbox correspondente ao exercício não procurado
                checkbox.style.display = "none";
                // Esconde a quebra de linha
                br.style.display = "none";
            }
        }
    }
</script>
</body>
</html>
