<?php 
include '../includes/conexao.php';

function listar_produtos() {
    global $pdo;
    $sql = "SELECT * FROM produto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function listar_usuarios() {
    global $pdo;
    $sql = 'SELECT * FROM cliente';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscar_usuarios($id_usuario) {
    global $pdo;
    $sql = 'SELECT * FROM cliente WHERE id_cliente = :id_cliente';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_cliente' => $id_usuario 
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function listar_produtos_vendedor($id_vendedor) {
    global $pdo;
    $sql = "SELECT * FROM produto WHERE id_vendedor = :id_vendedor ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_vendedor' => $id_vendedor
    ]);
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

function deletar_compra($id_compra) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM compra WHERE id_compra = :id");
    $stmt->bindParam(':id', $id_compra, PDO::PARAM_INT);
    $stmt->execute();
}

function deletar_usuario($id_cliente) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM cliente WHERE id_cliente = :id_cliente");
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->execute();
}

function buscar_compra_por_id($id_compra) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM compra WHERE id_compra = :id");
    $stmt->bindParam(':id', $id_compra, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function deletar_produto($id_produto) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM produto WHERE id_produto = :id_produto");
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();
}

function adicionar_produto($nome, $preco, $quantidade, $descricao, $imagem, $id_vendedor) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO produto (nome, preco, quantidade, descricao, imagem, id_vendedor) VALUES (:nome, :preco, :quantidade, :descricao, :imagem, :id_vendedor)");
    $stmt->execute([
        ':nome' => $nome,
        ':preco' => $preco,
        ':quantidade' => $quantidade,
        ':descricao' => $descricao,
        ':imagem' => $imagem,
        ':id_vendedor' => $id_vendedor
    ]);
} 


function editar_usuarios($id_cliente, $nome, $telefone, $cpf, $email, $tipo_usuario) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE cliente SET nome = :nome, telefone = :telefone, cpf = :cpf, email = :email, tipo_usuario = :tipo_usuario WHERE id_cliente = :id_cliente");
    $stmt->execute([
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':cpf' => $cpf,
        ':email' => $email,
        ':tipo_usuario' => $tipo_usuario,
        ':id_cliente' => $id_cliente
    ]);
}

function editar_produto($nome, $preco, $quantidade, $descricao, $imagem, $id_produto) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE produto SET nome = :nome, preco = :preco, quantidade = :quantidade, descricao = :descricao , imagem = :imagem WHERE id_produto = :id_produto");
    $stmt->execute([
        ':nome' => $nome,
        ':preco' => $preco,
        ':quantidade' => $quantidade,
        ':descricao' => $descricao,
        ':imagem' => $imagem,
        'id_produto' => $id_produto
    ]);
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


function buscar_compra($id_cliente) {
    global $pdo;
    $sql = "SELECT c.*, p.nome, p.preco, p.imagem FROM compra c
            JOIN produto p ON c.id_produto = p.id_produto
            WHERE c.id_cliente = :id_cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_cliente' => $id_cliente,

    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>