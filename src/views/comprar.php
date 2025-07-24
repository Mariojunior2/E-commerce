<?php 
session_start();
include '../includes/header.php'; 
include '../includes/crud.php';

$id = $_SESSION['cliente_id'] ;
$id_produto = $_GET['id_produto'] ?? null;

if(!isset($id)) {
    header('Location: index.php');
    exit();
}

if(!isset($id_produto)) {
    echo "Produto incorreto tente novamente!";
    exit();
}

$produto = buscar_produto($id_produto);
?>

<?php
include '../includes/footer.php';
?>