<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';
$id = $_SESSION['cliente_id'] ;

if(!isset($id)) {
    header('Location: index.php');
    exit();
}

$produtos = listar_produtos();
?>

<h1>Bem vindo, <?php echo "" .  $_SESSION['cliente_nome'] ?></h1>
<h2>Produtos</h2>
<h2><a href="./carrinho.php">Carrinho</a></h2>

<div class="container">
<?php if (count($produtos) > 0): ?>
    <?php foreach ($produtos as $produto): ?>
    <a href="produto.php?id_produto=<?php echo $produto['id_produto']; ?>"  style="text-decoration: none; color: inherit;">
        <div class="produto">
            <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="imagem do produto" style="max-width: 200px; height: auto;">
            <h4><?php echo htmlspecialchars($produto['nome']); ?></h4>
            <h5>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></h5>
        </div>
        </a>
    <?php endforeach ?>
    <?php else: ?>
        <p>Atualmente sem produtos!</p>
<?php endif ?>
</div>

<?php 
    if (isset($_GET['sucesso_compra']) && $_GET['sucesso_compra'] == 1)     {
        echo '<p style="color: green;">Compra realizada com sucesso! Pode ver em seu carrinho!</p>';
    }
    if (isset($_GET['erro_compra']) && $_GET['erro_compra'] == 1) {
        echo '<p style="color: red;">Erro ao comprar. Tente novamente.</p>';
    }
    if (isset($_GET['erro_compra']) && $_GET['erro_compra'] == 2) {
        echo '<p style="color: red;">Estoque insuficiente pelo valor pedido do produto. Espere o vendendor recarregar o estoque.</p>';
    }
?>


<a href="../functions/logout_process.php">Deslogar</a>

<?php include '../includes/footer.php' ?>