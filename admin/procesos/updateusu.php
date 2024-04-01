<?php
if (isset($_POST)) {
    require("conexion.php");
    $id = $_POST['idp'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $activo = $_POST['activo'];

    $query = $pdo->prepare("UPDATE tbl_users SET nom = :nom, email = :email, rol=:rol, activo=:activo WHERE id_user = :id");
    $query->bindParam(":nom", $nom);
    $query->bindParam(":email", $email);
    $query->bindParam(":rol", $rol);
    $query->bindParam(":activo", $activo);
    $query->bindParam(":id", $id);
    $query->execute();
    $pdo = null;
    echo "ok";
}
