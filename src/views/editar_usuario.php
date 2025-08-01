<?php
session_start();
include '../includes/header.php';
include '../includes/crud.php';

$id = $_SESSION['cliente_id'];
$tipo = $_SESSION['cliente_tipo'];
$id_cliente = $_GET['id_user'] ?? null;

if (!isset($id)) {
    header('Location: index.php');
    exit();
}

if ($tipo !== 'admin') {
    header('Location: hub.php');
    exit();
}


$user = buscar_usuarios($id_cliente);
if($_POST) {
    editar_usuarios($id_cliente, $_POST['nome'], $_POST['telefone'], $_POST['cpf'], $_POST['email'], $_POST['tipo_usuario']);
    header('Location: adminhub.php');
    exit();
}
?>

<h1>Editar clientes</h1>
<form method="post">
    <label>Nome: </label><br>
    <input type="text" name="nome" id="nome" value="<?php echo $user['nome'] ?>"><br><br>

    <label>Telefone: </label><br>
    <input type="tel" name="telefone" id="telefone" value="<?php echo $user['telefone'] ?>"><br><br>

    <label>Cpf: </label><br>
    <input type="text" name="cpf" id="cpf" value="<?php echo $user['cpf'] ?>"><br><br>

    <label>E-mail: </label><br>
    <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>"><br><br>

    <label>Tipo de usuário:</label><br>
    <select name="tipo_usuario" id="tipo_usuario">
        <option value="cliente" <?php if ($user['tipo_usuario'] === 'cliente') echo 'selected'; ?>>Cliente</option>
        <option value="vendedor" <?php if ($user['tipo_usuario'] === 'vendedor') echo 'selected'; ?>>Vendedor</option>
        <option value="admin" <?php if ($user['tipo_usuario'] === 'admin') echo 'selected'; ?>>Admin</option>
    </select><br><br>

    <button type="submit">Enviar</button>
</form>
<a href="./adminhub.php">Retornar a tela de Admin</a>

<?php include '../includes/footer.php'; ?>