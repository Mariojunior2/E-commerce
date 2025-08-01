<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';

$id = $_SESSION['cliente_id'] ;
$id_produto = $_GET['id_produto'] ?? null;

if(!isset($id)) {
    header('Location: index.php');
    exit();
}

if(!isset($id_produto)) {
    echo "Produto incorreto tente novamente!";
    exit();
}

$produto = buscar_produto($id_produto);

if($_POST) {
    editar_produto($_POST['nome'], $_POST['preco'], $_POST['quantidade'], $_POST['descricao'], $_POST['img_produto'], $id_produto);
    header('Location: vendendorhub.php');
    exit();
}
?>
<h2>Editar Produto</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $produto['id_produto'] ?>">

    <label>Nome do Produto</label><br>
    <input type="text" name="nome" value="<?php echo $produto['nome'] ?>" id="nome_produto" ><br><br>

    <label>Valor do Produto</label><br>
    <input type="number" name="preco" id="valor_produto" step="0.01" value="<?php echo $produto['preco'] ?>" ><br><br>

    <label>Quantidade do Produto</label><br>
    <input type="number" name="quantidade" id="quantidade" value="<?php echo $produto['quantidade'] ?>"><br><br>

    <label>Descrição do Produto</label><br>
    <textarea name="descricao" id="descricao" rows="50"><?php echo htmlspecialchars($produto['descricao']) ?></textarea><br><br>

    <label>Imagem do Produto</label><br>
    <input type="text" name="img_produto" id="img_produto" value="<?php echo $produto['imagem'] ?>"><br><br>


    <button type="submit">Enviar</button>
</form>

<a href="./vendendorhub.php">retornar</a>

<?php
include '../includes/footer.php';
?>