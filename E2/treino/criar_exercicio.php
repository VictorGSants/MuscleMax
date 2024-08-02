<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Exercício - MuscleMax</title>
    <link rel="stylesheet" href="criar_exercicio.css">
</head>
<body>
    <div class="container">
        <h1>Criar Novo Exercício</h1>
        <form action="processar_exercicio.php" method="POST">
            <label for="exercise_name">Nome do Exercício:</label>
            <input type="text" id="exercise_name" name="exercise_name" required>
            
            <label for="description">Descrição:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            
            <label for="muscle_group">Grupo Muscular:</label>
            <input type="text" id="muscle_group" name="muscle_group" required>

            <input type="submit" value="Criar Exercício">
        </form>

        <!-- Botão para voltar para a página de criar treino -->
        <a href="criar_treino.php" class="btn-voltar">Voltar para Criar Treino</a>
    </div>
</body>
</html>
