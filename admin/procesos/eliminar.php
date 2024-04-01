<?php
require_once "conexion.php";
$id = $_POST['id'];

$query = $pdo->prepare("DELETE FROM tbl_likes WHERE id_user_like = :id");
$query->bindParam(":id", $id);
$query->execute();

$query = $pdo->prepare("DELETE FROM tbl_users WHERE id_user = :id");
$query->bindParam(":id", $id);
$query->execute();
echo "ok";
