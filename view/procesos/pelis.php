<?php
include_once('conexion.php');

if (!empty($_POST['busqueda']) || !empty($_POST['genero'])) {
    $nombre =  $_POST['busqueda'];
    $genero =  $_POST['genero'];
    if ($genero != '') {
        $consulta = $pdo->prepare("SELECT * FROM tbl_contenido WHERE titulo LIKE :nombre AND genero LIKE :genero");
        $consulta->bindValue(':nombre', '%' . $nombre . '%', PDO::PARAM_STR);
        $consulta->bindValue(':genero', '%' . $genero . '%', PDO::PARAM_STR);
    } else {
        $consulta = $pdo->prepare("SELECT * FROM tbl_contenido WHERE titulo LIKE :nombre");
        $consulta->bindValue(':nombre', '%' . $nombre . '%', PDO::PARAM_STR);
    }
} else {
    $consulta = $pdo->prepare("SELECT * FROM tbl_contenido");
}

$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
