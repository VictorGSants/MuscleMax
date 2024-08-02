<?php
    // Verificar se o ID do treino está definido e é válido
    if(isset($_POST['workout_id']) && is_numeric($_POST['workout_id'])) {
        $workoutID = $_POST['workout_id'];
        
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

        // Query SQL para excluir o treino
        $sql = "DELETE FROM Workouts WHERE WorkoutID = $workoutID";
        if ($conn->query($sql) === TRUE) {
            echo "Treino excluído com sucesso.";
        } else {
            echo "Erro ao excluir o treino: " . $conn->error;
        }

        // Fechar conexão
        $conn->close();
    } else {
        echo "ID do treino inválido.";
    }
?>
