<?php
session_start();
include '../includes/header.php';
include '../includes/crud.php';

$id = $_SESSION['cliente_id'];
$tipo = $_SESSION['cliente_tipo'];
$id_cliente = isset($_GET['id_user']) ? (int) $_GET['id_user'] : null;


if (!isset($id)) {
    header('Location: index.php');
    exit();
}
elseif ($tipo !== 'admin') {
    header('Location: hub.php');
    exit();
}
else {
    deletar_usuario($id_cliente);
    echo 'Cliente Deletado com Sucesso! Retornando para a tela de Admin!';
    header('Location: adminhub.php');
    exit();
}



?>