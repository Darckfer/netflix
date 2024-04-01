<?php

require_once "./conexion.php";

$consulta = $pdo->prepare("SELECT *  FROM tbl_contenido c INNER JOIN tbl_genero g ON c.genero=g.id_gen order by c.id_cont asc;");
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
