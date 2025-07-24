<?php 
session_start();
require '../includes/conexao.php';

if($_POST) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    $verificar = $pdo->prepare("SELECT * FROM cliente WHERE cpf = :cpf");
    $verificar->execute([':cpf' => $cpf]);

    if ($verificar->rowCount() > 0) {
        header('Location: ../views/registro.php?erro=1');
        exit();
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO cliente (nome, senha, email, telefone, cpf) VALUES (:nome, :senha, :email, :telefone, :cpf)");
            $executando = $stmt->execute([
                ':nome' => $nome,
                ':senha' => $senhaHash,
                ':email' => $email,
                ':telefone' => $telefone,
                ':cpf' => $cpf,
            ]);

            if($executando) {
                header('Location: ../views/registro.php?sucesso=1');
                exit();
            }
        } catch (PDOException $e) {
            header('Location: ../views/registro.php?erro=1');
            exit();
        }
    }
}
?>