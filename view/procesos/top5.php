<?php

include_once('conexion.php');

$consulta = $pdo->prepare("SELECT *, id_cont_like, COUNT(DISTINCT id_user_like) AS users FROM tbl_likes l 
INNER JOIN tbl_contenido c ON c.id_cont = l.id_cont_like GROUP BY l.id_cont_like ORDER BY `users` DESC LIMIT 5;");
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
