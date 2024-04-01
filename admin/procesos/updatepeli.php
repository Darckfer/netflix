<?php
if (isset($_POST)) {
    require("conexion.php");
    if (isset($_POST['idcont'])) {
        $id = $_POST['idcont'];
        $nom = $_POST['titulo'];
        $desc = $_POST['Descripcion'];
        $urlvid = $_POST['url_video'];
        $date = $_POST['fecha_subida'];
        $genero = $_POST['genero'];

        $query = $pdo->prepare("UPDATE tbl_contenido SET titulo = :nom, desc_cont = :desc, url_video = :urlvid, fecha_estreno = :date, genero = :genero WHERE id_cont = :id");
        $query->bindParam(":nom", $nom);
        $query->bindParam(":desc", $desc);
        $query->bindParam(":urlvid", $urlvid);
        $query->bindParam(":date", $date);
        $query->bindParam(":genero", $genero);
        $query->bindParam(":id", $id);
        $query->execute();
        $pdo = null;
        echo "ok";
    } else {
        $nom = $_POST['titulo'];
        $desc = $_POST['Descripcion'];
        $urlvid = $_POST['url_video'];
        $date = $_POST['fecha_subida'];
        $genero = $_POST['genero'];

        $query = $pdo->prepare("INSERT INTO tbl_contenido (titulo, desc_cont, url_video, fecha_estreno, genero) VALUES (:nom, :desc, :urlvid, :date, :genero)");
        $query->bindParam(":nom", $nom);
        $query->bindParam(":desc", $desc);
        $query->bindParam(":urlvid", $urlvid);
        $query->bindParam(":date", $date);
        $query->bindParam(":genero", $genero);
        $query->execute();
        $pdo = null;
        echo "new";
    }
}
