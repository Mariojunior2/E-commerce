<?php include '../includes/header.php';?>
<h1>Login</h1>
<form action="../functions/login_process.php" method="GET">
    <label>Email: </label><br>
    <input type="text" name="email" id="email"><br>
    <label>Senha: </label><br>
    <input type="text" name="senha" id="senha"><br>
    
    <button type="submit">Logar</button>
    <a href="./registro.php">Sem conta? Registre-se</a><br>
    <?php 
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
        echo '<p style="color: green;">Login realizado com sucesso!</p>';
    }

    if(isset($_GET['erro']) && $_GET['erro'] == 1) {
        echo '<p style="color: red;">E-mail ou senha incorretos.</p>';
    }
    ?>
</form>


<?php include '../includes/footer.php';?>