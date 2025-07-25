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
    $novo_estoque =  (int) ($_GET['novo_estoque'] ?? 1);
    $quantidade = (int) ($_GET['quantia'] ?? 1);
    $valor_total = (int) ($_GET['valor'] ?? 1);
    $endereco = $_POST['endereco'];

    try {
        $stmt = $pdo->prepare("INSERT INTO compra (id_produto, id_cliente, endereco, valor_total, quantidade) VALUE (:id_produto, :id_cliente, :endereco, :valor_total, :quantidade)");
        $executado = $stmt->execute([
            ':id_produto' => $id_produto,
            ':id_cliente' => $id_cliente,
            ':endereco' => $endereco,
            ':valor_total' => $valor_total,
            ':quantidade' => $quantidade
        ]);
        $stmtEstoque = $pdo->prepare("UPDATE produto SET quantidade = :quantidade WHERE id_produto = :id_produto");
        $executadoEstoque = $stmtEstoque->execute([
            ':id_produto' => $id_produto,
            ':quantidade' => $novo_estoque,
        ]);
        if($executado and $executadoEstoque) {
            header("Location: ../views/hub.php?sucesso_compra=1");
            exit();
        }
    } catch (PDOException $e) {
            header("Location: ../views/hub.php?erro_compra=1");
            exit();
    }
}



?>

