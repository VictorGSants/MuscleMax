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
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="sobre.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>



<header>
    <div class="logo">
        <img src="../img/logo.png" alt="Logo">
    </div>
    <nav class="paginas">
        <ul>
        <li><a href="../pagina/home2.php">Home</a></li>

        <li><a href="../treino/pagina_treino.php">Meus Treinos</a></li>
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
</header>
<main>
    <div class="foto">
        <img src="../img/sobre.jpeg" alt="">
    </div>
    <div class="sobre-main">
        <h1 class="sobrenosh1">
            Sobre nós
        </h1>
        <h2>
            <p>Somos a</p>
            <p class="t1">MuscleMax</p>
        </h2>
        <p class="texto-main">Uma equipe dedicada de entusiastas do fitness, especialistas em saúde e apaixonados por ajudar os outros.
            Comprometidos em ser seu parceiro confiável na busca por uma vida mais saudável e ativa.
        </p>
    </div>

</main>
<footer>
        <div class="contact" style="padding: 15px; ">
            <div style="margin-left : 500px">
                <label>Contato: </label>
                <i id="icone" class="fas fa-envelope"></i>
                <span class="email_">musclemaxcampinas@gmail.com</span>
            </div>    
            
        </div>
    </footer>


</html>