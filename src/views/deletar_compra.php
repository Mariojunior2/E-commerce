<?php
session_start();
include '../includes/crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_compra = $_POST['id_compra'] ?? null;
    $id_cliente = $_SESSION['cliente_id'] ?? null;

    if ($id_compra && $id_cliente) {
        $compra = buscar_compra_por_id($id_compra);
        if ($compra && $compra['id_cliente'] == $id_cliente) {
            deletar_compra($id_compra);
        }
    }
}

header('Location: carrinho.php');
exit();
?>
