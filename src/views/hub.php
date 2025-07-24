<?php 
session_start();
include '../includes/header.php'; 
$id = $_SESSION['cliente_id'] ;

if(!isset($id)) {
    header('Location: index.php');
    exit();
}

?>

<h1>Bem vindo, <?php echo "" .  $_SESSION['cliente_nome'] ?></h1>
<h2>Produtos</h2>

<div class="container">
    
</div>
<a href="../functions/logout_process.php">Deslogar</a>

<?php include '../includes/footer.php' ?>