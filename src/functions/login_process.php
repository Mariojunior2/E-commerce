<?php 
session_start();
require '../includes/conexao.php';

if($_GET) {
    $email = $_GET['email'];
    $senha = $_GET['senha'];

    $stmt = $pdo->prepare('SELECT * FROM cliente WHERE email=:email');
    $stmt->execute([
        ':email' => $email,
    ]);

    $cliente = $stmt->fetch();

    if($cliente && password_verify($senha, $cliente['senha'])) {
        $_SESSION['cliente_id'] = $cliente['id_cliente'];
        $_SESSION['cliente_nome'] = $cliente['nome'];

        header('Location: ../views/hub.php?sucesso=1');
        exit();
    } else {
        header('Location: ../views/index.php?erro=1');
        exit();
    }
}
?>