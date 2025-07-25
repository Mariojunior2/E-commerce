<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';

$id = $_SESSION['cliente_id'] ;
$id_produto = $_GET['id_produto'] ?? null;
$quantidade = (int) ($_GET['quantia'] ?? 1);
if(!isset($id) or !isset($id_produto)) {
    header('Location: index.php');
    exit();
}

$produto = buscar_produto($id_produto);
$valor_total = $produto['preco'] * $quantidade;
if ($quantidade > $produto['quantidade']) {
    header("Location: ../views/hub.php?erro_compra=2");
    exit();
}

$novo_estoque = $produto['quantidade'] - $quantidade;




?>
<form action="../functions/finalizar_compra_process.php?valor=<?php echo $valor_total ?>&id_produto=<?php echo $produto['id_produto']; ?>&novo_estoque=<?php echo $novo_estoque; ?>&quantia=<?php echo $quantidade; ?>" method="post">
<h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
<img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="imagem do produto" style="max-width: 200px; height: auto;">
<h5>R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></h5> 
<label>Endereço</label><br>
<input type="text" name="endereco" id="endereco" required><br>
<button type="submit">Finalizar compra</button>
</form>
<a href="./produto.php?id_produto=<?php echo $produto['id_produto']; ?>">Retornar para o produto</a>

<?php
include '../includes/footer.php';
?>