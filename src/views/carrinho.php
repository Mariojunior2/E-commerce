<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';

$id_cliente = $_SESSION['cliente_id'] ;

if(!isset($id_cliente)) {
    header('Location: index.php');
    exit();
}



$compras = buscar_compra($id_cliente);
?>
<h1>Carrinho</h1>
<div class="container">
    <?php if (count($compras) > 0) :?>
        <?php foreach ($compras as $compra) :?>
        <a href="produto.php?id_produto=<?php echo $compra['id_produto']; ?>"  style="text-decoration: none; color: inherit;">
            <div class="card" style="margin: 10px; padding: 10px; border: 1px solid #ccc;">
                <img src="<?php echo htmlspecialchars($compra['imagem']); ?>" alt="imagem do produto" style="max-width: 200px; height: auto;">
                <h4><?= htmlspecialchars($compra['nome']) ?></h4>
                <p>Quantidade comprada: <?= $compra['quantidade'] ?></p>
                <p>Preço unitário: R$ <?= number_format($compra['preco'], 2, ',', '.') ?></p>
                <p>Subtotal: R$ <?= number_format($compra['quantidade'] * $compra['preco'], 2, ',', '.') ?></p>
            </div>
        </a>
        <?php endforeach ?>
    <?php else :?>
        <p>Nenhum produto no carrinho.</p>
    <?php endif ?>
</div>

<h2><a href="./hub.php">Retornar para a loja!</a></h2>

<?php
include '../includes/footer.php';
?>