<?php
require_once "conexion.php";
$id = $_POST['id'];

$query = $pdo->prepare("DELETE FROM tbl_likes WHERE id_cont_like = :id");
$query->bindParam(":id", $id);
$query->execute();

$query = $pdo->prepare("DELETE FROM tbl_contenido WHERE id_cont = :id");
$query->bindParam(":id", $id);
$query->execute();
echo "ok";
