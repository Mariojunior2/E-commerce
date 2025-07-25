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
$quantidade = 1;
?>

<h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
<img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="imagem do produto" style="max-width: 200px; height: auto;">
<h4><?php echo htmlspecialchars($produto['nome']); ?></h4>
<p><?php echo htmlspecialchars($produto['descricao']); ?></p>
<h5>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></h5> 
<h5>Unidades disponíveis: <?php echo htmlspecialchars($produto['quantidade']); ?></h5>
<form method="post">
    <label>Quantidade: </label><br>
    <input type="number" name="quantidade" id="quantidade" value="1" min="1" required><br>
    <button type="submit">Confirmar Quantidade</button>
</form>
<?php 
if ($_POST) {
$quantidade = $_POST['quantidade']; 
} else {
    $quantidade = 1;
}
?>
<button type="submit"><a href="./comprar.php?id_produto=<?php echo $produto['id_produto']; ?>&quantia=<?php echo $quantidade; ?>" style="color: black; text-decoration: none;">Comprar</a></button><br>
<a href="./hub.php">Retornar a loja!</a>

<?php
include '../includes/footer.php';
?>