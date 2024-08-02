<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musclemax";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$exercises_peito = [1, 2, 3]; // IDs dos exercícios para o peito
$exercises_pernas = [4, 5, 6]; // IDs dos exercícios para as pernas
$exercises_costas = [7, 8, 9]; // IDs dos exercícios para as costas
$exercises_ombros = [10, 11, 12]; // IDs dos exercícios para os ombros
$exercises_bracos = [13, 14, 15]; // IDs dos exercícios para os braços
$exercises_abdomen = [16, 17, 18]; // IDs dos exercícios para o abdômen
$exercises_panturrilhas = [19, 20]; // IDs dos exercícios para as panturrilhas

// Inserindo treinos reais para cada workout A, B, C, D e E
for ($i = 1; $i <= 5; $i++) {
    $workout_id = $i; // IDs dos workouts A, B, C, D e E

    // Associando exercícios aos treinos
    $exercises = [];
    switch ($i) {
        case 1: // Workout A
            $exercises = $exercises_peito;
            break;
        case 2: // Workout B
            $exercises = $exercises_pernas;
            break;
        case 3: // Workout C
            $exercises = $exercises_costas;
            break;
        case 4: // Workout D
            $exercises = $exercises_ombros;
            break;
        case 5: // Workout E
            $exercises = $exercises_bracos;
            break;
    }

    // Inserindo os exercícios associados a cada treino
    foreach ($exercises as $exercise_id) {
        $sets = 0; // Número aleatório de sets entre 3 e 5
        $reps = 0; // Número aleatório de repetições entre 8 e 12
        $weight = 0; // Peso aleatório entre 20 e 40 (em kg)
        $rest_time = 0; // Tempo de descanso aleatório entre 60 e 90 segundos

        // Inserindo os dados do exercício associado ao treino na tabela ExercisesInWorkout
        $sql_insert_exercise_in_workout = "INSERT INTO ExercisesInWorkout (WorkoutID, ExerciseID, Sets, Reps, Weight, RestTimeSeconds)
        VALUES ($workout_id, $exercise_id, $sets, $reps, $weight, $rest_time)";

if ($conn->query($sql_insert_exercise_in_workout) === TRUE) {
echo "Treino associado ao exercício inserido com sucesso para Workout ID $workout_id e Exercise ID $exercise_id.<br>";
} else {
echo "Erro ao inserir treino associado ao exercício: " . $conn->error . "<br>";
}
}
}
?>