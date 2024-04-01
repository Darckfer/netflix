<?php
require_once "conexion.php";
$id = $_POST['id'];

$query = $pdo->prepare("UPDATE tbl_users SET activo=1 WHERE id_user = :id");
$query->bindParam(":id", $id);
$query->execute();
echo "ok";
