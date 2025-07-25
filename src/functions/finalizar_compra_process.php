<?php 
session_start();
require '../includes/conexao.php';
require '../includes/crud.php';

$id_cliente = $_SESSION['cliente_id'];

if(!isset($id_cliente)) {
    header('Location: index.php');
    exit();
}

if($_POST) {
    $id_produto =  $_GET['id_produto'] ?? null;

    $valor_total = (int) ($_GET['valor'] ?? 1);
    $endereco = $_POST['endereco'];

    try {
        $stmt = $pdo->prepare("INSERT INTO compra (id_produto, id_cliente, endereco, valor_total) VALUE (:id_produto, :id_cliente, :endereco, :valor_total)");
        $executado = $stmt->execute([
            ':id_produto' => $id_produto,
            ':id_cliente' => $id_cliente,
            ':endereco' => $endereco,
            ':valor_total' => $valor_total,
        ]);
        if($executado) {
            header("Location: ../views/hub.php?sucesso_compra=1");
            exit();
        }
    } catch (PDOException $e) {
            header("Location: ../views/hub.php?erro_compra=1");
            exit();
    }
}



?>

