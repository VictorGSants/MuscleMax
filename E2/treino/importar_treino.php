<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Treino - MuscleMax</title>
    <link rel="stylesheet" href="importar_treino.css">
</head>
<body>
    <a href="pagina_treino.php" class="btn-voltar">Treinos</a>

    <div class="container">
        <h1>Importar Treino</h1>

        <!-- Formulário para importar treino -->
        <form action="processar_importacao.php" method="POST" enctype="multipart/form-data">
            <label for="fileInput">Selecione o arquivo de texto do treino:</label>
            <input type="file" id="fileInput" name="fileInput" accept=".txt" required placeholder="">
            <input type="submit" value="Importar Treino">
        </form>
    </div>
</body>
</html>