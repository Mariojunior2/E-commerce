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

function editar_preco($id_produto, $quantidade) {
    global $pdo;
    $sql = "UPDATE produto SET preco = :preco WHERE id_produto = :id_produto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':preco' => $quantidade,
        ':id_produto' => $id_produto
    ]);
}

/*

function buscar_compra($id_produto, $id_cliente) {
    global $pdo;
    $sql = "SELECT * FROM compra WHERE id_produto = :id_produto AND id_cliente = :id_cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_produto' => $id_produto,
        ':id_cliente' => $id_cliente
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);

    }
*/

?>