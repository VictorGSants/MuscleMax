
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recorde.css">
    <title>Adicionar e Mostrar Dados de Exercício</title>
    <script>
        function mostrarFormulario() {
            document.getElementById("form_adicionar").style.display = "block";
        }
        function confirmDelete(recordID) {
        if (confirm('Tem certeza de que deseja excluir este registro?')) {
            window.location.href = 'excluir_registro.php?recordID=' + recordID;
        }
    }
    </script>

</head>
<body>
<?php
session_start();
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
    <nav>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo">
        </div>
        <ul>
            <li><a href="../pagina/home2.php">Home</a></li>
            <li><a href="../treino/pagina_treino.php">Meus Treinos</a></li>
            <li><a href="../pagina/sobre.php">Sobre Nós</a></li>
            <li>
            <?php if ($loggedin): ?>
                <span class="saudacao">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></span>
                
            <?php else: ?>
                <a href="../acesso/login.php" class="login">Login</a>
            <?php endif; ?>
        </li>
            
        </ul>
    </nav>

    <button onclick="mostrarFormulario()">Adicionar Registro</button>
    <form id="form_adicionar" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: none;">
        <label for="exercise_name">Nome do Exercício:</label><br>
        <input type="text" id="exercise_name" name="exercise_name" required><br>
        <label for="weight">Peso (kg):</label><br>
        <input type="text" id="weight" name="weight" required><br>
        <label for="date_recorded">Data Registrada:</label><br>
        <input type="date" id="date_recorded" name="date_recorded" required><br><br>
        <input type="submit" value="Adicionar Registro">
    </form>

    <h2>Recordes de Exercício</h2>
    <table border="1">
        <tr>
            <th>Nome do Exercício</th>
            <th>Peso (kg)</th>
            <th>Data Registrada</th>
            <th>Ações</th>
        </tr>
        <?php
        
        $servername = "localhost";
        $username = "root"; // Altere para o seu usuário do banco de dados
        $password = ""; // Altere para a sua senha do banco de dados
        $dbname = "musclemax";

        // Conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Executar apenas se o formulário foi enviado

            // Captura os dados do formulário
            $exercise_name = $_POST['exercise_name'];
            $weight = $_POST['weight'];
            $date_recorded = $_POST['date_recorded'];

            // Obter UserID do usuário logado
            $userID = $_SESSION['UserID']; // Supondo que 'UserID' seja o nome da variável de sessão que armazena o ID do usuário

            // Prepara e executa a query SQL para inserir os dados na tabela
            $sql = "INSERT INTO ExerciseRecords (UserID, ExerciseName, Weight, DateRecorded)
                    VALUES ('$userID', '$exercise_name', '$weight', '$date_recorded')";

            if ($conn->query($sql) === TRUE) {
                // Redireciona para a mesma página para evitar o reenvio do formulário
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Erro ao adicionar registro de exercício: " . $conn->error;
            }
        }

        // Consulta SQL para selecionar apenas os registros do usuário atual
        $userID = $_SESSION['UserID']; // Obtém o UserID do usuário logado
        $sql = "SELECT RecordID, ExerciseName, Weight, DateRecorded FROM ExerciseRecords WHERE UserID = $userID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output dos dados de cada linha
            while($row = $result->fetch_assoc()) {
                echo "<tr>
        <td>" . $row["ExerciseName"] . "</td>
        <td>" . $row["Weight"] . "</td>
        <td>" . $row["DateRecorded"] . "</td>
        <td><button onclick='confirmDelete(" . $row["RecordID"] . ")'>Excluir</button></td>
      </tr>";

            }
        } else {
            echo "<tr><td colspan='3'>Nenhum registro encontrado</td></tr>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </table>
</body>
</html>
