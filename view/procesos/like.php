<?php
require_once "./conexion.php";
session_start();
$id_user = $_SESSION['id_user'];
$id_cont = $_POST['id'];

$consulta = $pdo->prepare("SELECT * FROM tbl_likes WHERE id_user_like = :id_usuario AND id_cont_like = :id_contenido");
$consulta->bindParam(":id_usuario", $id_user, PDO::PARAM_INT);
$consulta->bindParam(":id_contenido", $id_cont, PDO::PARAM_INT);
$consulta->execute();

// Verificar si el registro existe
if ($consulta->rowCount() == 0) {
    $consulta2 = $pdo->prepare("INSERT INTO tbl_likes (id_user_like, id_cont_like) VALUES (:id_user, :id_cont)");
    $consulta2->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $consulta2->bindParam(":id_cont", $id_cont, PDO::PARAM_INT);
    $consulta2->execute();
    echo "new";
} else {
    $consulta2 = $pdo->prepare("DELETE FROM tbl_likes WHERE id_user_like = :id_user AND id_cont_like = :id_cont");
    $consulta2->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $consulta2->bindParam(":id_cont", $id_cont, PDO::PARAM_INT);
    $consulta2->execute();
    echo "eliminado";
}
