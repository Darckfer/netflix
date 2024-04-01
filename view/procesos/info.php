<?php
require_once "./conexion.php";

$id = $_POST['id'];

$consulta = $pdo->prepare("SELECT * FROM tbl_contenido WHERE id_cont = :id");
$consulta->bindParam(":id", $id, PDO::PARAM_INT);
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
