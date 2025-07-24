<?php 
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "e-commerce";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("erro ao conectar com o banco". $e->getMessage());
}

?>