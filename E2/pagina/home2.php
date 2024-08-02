<?php
session_start();
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Verifica se o UserID está definido na sessão
if(isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
} else {
    // Se o UserID não estiver definido, defina-o como vazio ou qualquer valor padrão que você desejar
    $userID = "UserID";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Musclemax</title>
    <link rel="stylesheet" href="home2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <nav>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo">
        </div>
        <ul>
            <li><a href="../treino/pagina_treino.php">Meus Treinos</a></li>
            <li><a href="sobre.php">Sobre Nós</a></li>
            <li><a href="../recorde/recorde.php?userID=<?php echo $userID; ?>" class="btn-records">Meus Recordes</a></li>
            <li>
                <?php if ($loggedin): ?>
                    <span class="saudacao">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></span>
                    <form action="../pagina/logout.php" method="POST" style="display:inline;">
                        <input type="submit" value="Sair" class="logout">
                    </form>
                <?php else: ?>
                    <a href="../acesso/login.php" class="login">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <div class="content">
        <div class="about-brand">
            <h2>SUPERE SEUS LIMITES<br>DEFINA SEU FUTURO</h2>
            <p>O MuscleMax é um projeto inovador desenvolvido para atender às necessidades específicas de profissionais da área de educação física e membros de academias menos desenvolvidas. Ele surge como uma solução abrangente e eficaz, visando proporcionar uma experiência de treino mais segura, personalizada e eficiente, promovendo um estilo de vida ativo e saudável na comunidade.</p>
        </div>
    </div>
    <?php if ($loggedin): ?>
        <a class="novotreino" href="../treino/pagina_treino.php">Meus treinos</a>
    <?php else: ?>
    <?php endif; ?>
    <footer>
        <div class="contact">
            <label>Contato: </label>
            <i id="icone" class="fas fa-envelope"></i>
            <span>musclemaxcampinas@gmail.com</span>
        </div>
    </footer>
</body>
</html>
