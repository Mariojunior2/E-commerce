<?php 
include '../includes/conexao.php';

function listar_produtos() {
    global $pdo;
    $sql = "SELECT * FROM produto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function buscar_produto($id_produto) {
    global $pdo;
    $sql = "SELECT * FROM produto WHERE id_produto = :id_produto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_produto' => $id_produto,
    ]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    return $produto;

    if(!$produto) {
        echo "Produto não encontrado ou acesso negado.";
        exit();
    }
}


?>