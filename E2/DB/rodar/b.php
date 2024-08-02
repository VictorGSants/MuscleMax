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
// Executa as consultas SQL
$sql_insert_users = "INSERT INTO Users (Username, email, senha, sexo)
                     VALUES ('Danilo', 'danilo@a', 'a', 'Masculino'),
                            ('Victor', 'victor@a', 'a', 'Feminino')";
if ($conn->query($sql_insert_users) === TRUE) {
    echo "Dados de exemplo inseridos na tabela Users com sucesso.<br>";
} else {
    echo "Erro ao inserir dados de exemplo na tabela Users: " . $conn->error . "<br>";
}
// Inserção de dados de exemplo na tabela ExerciseRecords
$sql_insert_exercises = "INSERT INTO Exercises (ExerciseName, Description, MuscleGroup)
                         VALUES ('Supino Inclinado', 'Levante a barra inclinada até os braços ficarem esticados, e abaixe-a até tocar o peito.', 'Peito'),
                                ('Crucifixo com Halteres', 'Deite-se em um banco e levante os halteres até que os braços fiquem retos, então abaixe-os até que fiquem alinhados com o peito.', 'Peito'),('Flexão de Braços', 'Deite-se no chão com as mãos apoiadas e os braços estendidos. Flexione os cotovelos e abaixe o corpo até que o peito quase toque o chão, depois empurre de volta para a posição inicial.', 'Peito'),
                                ('Agachamento com Barra', 'Coloque a barra nas costas, afaste os pés na largura dos ombros, agache até que as coxas fiquem paralelas ao chão e volte à posição inicial.', 'Pernas'),
                                ('Leg Press', 'Sente-se no equipamento, coloque os pés na plataforma e empurre-a para longe até que as pernas fiquem quase retas, depois dobre os joelhos e volte à posição inicial.', 'Pernas'),
                                ('Cadeira Extensora', 'Sente-se na máquina, levante os pesos empurrando a plataforma para longe até que as pernas estejam esticadas, depois dobre os joelhos e volte à posição inicial.', 'Pernas'),
                                ('Puxada Horizontal', 'Sente-se na máquina, puxe a barra em direção ao corpo até que ela toque o peito, mantendo os cotovelos próximos ao corpo, depois volte à posição inicial.', 'Costas'),
                                ('Remada Curvada', 'De pé, segure uma barra com as palmas das mãos voltadas para baixo, flexione os joelhos ligeiramente, incline o tronco para a frente, puxe a barra em direção ao umbigo e depois volte à posição inicial.', 'Costas'),
                                ('Hiperextensão', 'Deite-se de bruços em um banco inclinado, mantenha as mãos atrás da cabeça e levante o tronco até que esteja alinhado com as pernas, depois retorne à posição inicial.', 'Costas'),
                                ('Desenvolvimento com Halteres', 'Sentado em um banco, levante os halteres acima da cabeça até que os braços estejam estendidos, depois abaixe-os até que os cotovelos fiquem abaixo dos ombros e volte à posição inicial.', 'Ombros'),
                                ('Elevação Lateral', 'De pé, segure halteres ao lado do corpo, levante os braços até a altura dos ombros e depois retorne à posição inicial.', 'Ombros'),
                                ('Elevação Frontal', 'De pé, segure halteres com as palmas voltadas para baixo, levante os braços até a altura dos ombros à frente do corpo e depois retorne à posição inicial.', 'Ombros'),
                                ('Rosca Direta', 'De pé, segure a barra com as palmas voltadas para cima, levante-a até os ombros e depois retorne à posição inicial.', 'Braços'),
                                ('Rosca Alternada', 'De pé, segure halteres com as palmas voltadas para cima, levante um braço até o ombro e depois o outro, alternando os movimentos.', 'Braços'),
                                ('Tríceps Testa', 'Deitado em um banco, segure uma barra com as mãos afastadas, abaixe-a em direção à testa até que os braços fiquem em um ângulo de 90 graus e depois retorne à posição inicial.', 'Braços'),
                                ('Abdominal Crunch', 'Deite-se no chão com os joelhos dobrados, as mãos atrás da cabeça, levante os ombros em direção aos joelhos e depois retorne à posição inicial.', 'Abdômen'),
                                ('Prancha', 'Deite-se de bruços no chão, levante o corpo apoiando-se nos cotovelos e nos dedos dos pés, mantenha a posição por alguns segundos e depois relaxe.', 'Abdômen'),
                                ('Leg Raise', 'Deite-se no chão com as pernas estendidas, levante as pernas em direção ao teto até que os quadris sejam levantados do chão e depois retorne à posição inicial.', 'Abdômen'),
                                ('Alongamento de Panturrilha', 'Fique em pé, coloque as mãos em uma parede, dê um passo para trás com uma perna, mantenha-a esticada e pressione o calcanhar no chão até sentir o alongamento na panturrilha, depois troque de perna.', 'Panturrilhas')";
if ($conn->query($sql_insert_exercises) === TRUE) {
    echo "Dados de exemplo inseridos na tabela Exercises com sucesso.<br>";
} else {
    echo "Erro ao inserir dados de exemplo na tabela Exercises: " . $conn->error . "<br>";
}

$sql_remove_fk = "ALTER TABLE Workouts DROP FOREIGN KEY workouts_ibfk_1";

if ($conn->query($sql_remove_fk) === TRUE) {
    echo "Restrição de chave estrangeira removida com sucesso.<br>";
} else {
    echo "Erro ao remover a restrição de chave estrangeira: " . $conn->error . "<br>";
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

// Inserção de treinos de exemplo
$sql_insert_workouts = "INSERT INTO Workouts (WorkoutName)
    VALUES ('Treino A'),
           ('Treino B'),
           ('Treino C'),
           ('Treino D'),
           ('Treino E')";

if ($conn->query($sql_insert_workouts) === TRUE) {
echo "Dados de exemplo inseridos na tabela Workouts com sucesso.<br>";
} else {
echo "Erro ao inserir dados de exemplo na tabela Workouts: " . $conn->error . "<br>";
}


// Encerra a conexão com o banco de dados
$conn->close();
?>
