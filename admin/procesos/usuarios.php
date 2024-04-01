<?php

require_once "./conexion.php";

$consulta = $pdo->prepare("SELECT *  FROM tbl_users u INNER JOIN tbl_rol r ON u.rol=r.id_rol WHERE activo = 1;");
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
