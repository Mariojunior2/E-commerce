<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';

$id = $_SESSION['cliente_id'];
$tipo = $_SESSION['cliente_tipo'];

if (!isset($id)) {
    header('Location: index.php');
    exit();
}

if ($tipo !== 'admin') {
    header('Location: hub.php');
    exit();
}

$usuarios = listar_usuarios();
?>

<h1>Olá, Admin <?php echo htmlspecialchars($_SESSION['cliente_nome']); ?></h1>

<div class="container">
    <?php if (count($usuarios) > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Tipo de Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id_cliente']) ?></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['telefone']) ?></td>
                        <td><?= htmlspecialchars($usuario['cpf']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                        <td>
                            <a href="editar_usuario.php?id_user=<?= $usuario['id_cliente'] ?>">
                                <button style="background-color: orange; color: white; border: none; padding: 5px 10px;">Editar</button>
                            </a>
                            <a href="deletar_usuario.php?id_user=<?= $usuario['id_cliente'] ?>" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">
                                <button style="background-color: red; color: white; border: none; padding: 5px 10px;">Deletar</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif ?>
</div>

<br>
<a href="./hub.php">Retornar para a loja</a><br>
<a href="../functions/logout_process.php">Deslogar</a>

<?php include '../includes/footer.php'; ?>
