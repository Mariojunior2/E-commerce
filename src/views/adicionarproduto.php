<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';

$id = $_SESSION['cliente_id'] ;
$tipo = $_SESSION['cliente_tipo'];
if(!isset($id)) {
    header('Location: index.php');
    exit();
}

if($tipo !== 'vendedor') {
    header('Location: hub.php');
    exit();
}

if($_POST) {
    adicionar_produto($_POST['nome'], $_POST['preco'], $_POST['quantidade'], $_POST['descricao'], $_POST['img_produto'], $id);
    header('Location: vendendorhub.php');
    exit();
}
?>
<form method="post">
    <label>Adicionar Produto!</label><br><br>

    <form method="post">
    <input type="hidden" name="id">

    <label>Nome do Produto</label><br>
    <input type="text" name="nome"  id="nome_produto" ><br><br>

    <label>Valor do Produto</label><br>
    <input type="number" name="preco" id="valor_produto" step="0.01"  ><br><br>

    <label>Quantidade do Produto</label><br>
    <input type="number" name="quantidade" id="quantidade"><br><br>

    <label>Descrição do Produto</label><br>
    <textarea name="descricao" id="descricao" rows="50"></textarea><br><br>

    <label>Imagem do Produto</label><br>
    <input type="text" name="img_produto" id="img_produto" ><br><br>


    <button type="submit">Enviar</button>
</form>
</form>
<a href="./vendendorhub.php">Retornar a sua loja</a>
<a href="../functions/logout_process.php">Deslogar</a>

<?php include '../includes/footer.php' ?>