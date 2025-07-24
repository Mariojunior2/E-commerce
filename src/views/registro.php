<?php include '../includes/header.php';?>

<h1>Registro</h1>
<form action="../functions/registro_process.php" method="POST">
    <label>Nome: </label><br>
    <input type="text" name="nome" id="nome"><br>
    <label>Email: </label><br>
    <input type="text" name="email" id="email"><br>
    <label>Telefone: </label><br>
    <input type="tel" name="telefone" id="telefone"><br>
    <label>Cpf: </label><br>
    <input type="text" name="cpf" id="cpf"><br>
    <label>Senha: </label><br>
    <input type="text" name="senha" id="senha"><br>
    <button type="submit">Registrar</button>
    <a href="./index.php">Tem conta? Loga-se</a><br>
</form>

<?php 
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1)     {
        echo '<p style="color: green;">Cadastro realizado com sucesso! Pode logar cliente!</p>';
    }
    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
        echo '<p style="color: red;">Erro ao cadastrar. Tente novamente.</p>';
    }
?>

<?php include '../includes/footer.php';?>