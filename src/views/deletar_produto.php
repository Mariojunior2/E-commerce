<?php 
session_start();
include '../includes/crud.php';

if($_POST) {
    $id_produto = $_POST['id_produto'] ?? null;
    $id_vendedor = $_POST['id_vendedor'] ?? null;

    deletar_produto($id_produto);
    header('Location: ./vendendorhub.php');
}
?>