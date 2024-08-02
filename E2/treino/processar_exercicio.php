<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processar Exercício - MuscleMax</title>
    <link rel="stylesheet" href="criar_treino.css">
</head>
<body>
    <div class="container">
        <h1>Processar Exercício</h1>
        <?php
        // Verifica se os dados foram submetidos via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Obtém os dados do formulário
            $exercise_name = $_POST['exercise_name'];
            $description = $_POST['description'];
            $muscle_group = $_POST['muscle_group'];

            // Prepara e executa a query de inserção
            $sql = "INSERT INTO Exercises (ExerciseName, Description, MuscleGroup) VALUES ('$exercise_name', '$description', '$muscle_group')";

            if ($conn->query($sql) === TRUE) {
                echo "Exercício criado com sucesso";
            } else {
                echo "Erro ao criar exercício: " . $conn->error;
            }

            // Fecha a conexão
            $conn->close();
        } else {
            // Se os dados não foram submetidos via POST, redireciona para a página de criação de exercício
            header("Location: criar_exercicio.php");
            exit();
        }
        ?>
        <!-- Botão para voltar para a página de criar treino -->
        <a href="criar_treino.php" class="btn-voltar">Voltar para Criar Treino</a>
    </div>
</body>
</html>
