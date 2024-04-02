<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: ../index.php');
}
if ($_SESSION['rol']  == 1) {
    header('Location: ../admin/index.php');
}
include('procesos/conexion.php');
$consulta = $pdo->prepare("SELECT id_gen, nom_gen FROM tbl_genero");
$consulta->execute();
$generos = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <h3>Bienvenido: <?php echo $_SESSION['nom']; ?></h3>
    <a href="./procesos/salir.php"><button type="button" class="btn btn-danger">Salir</button></a>
    <div class="contenedortop5">
        <h1 style="color: white; text-align: center;">Películas populares</h1>
        <div class="top5" id="top5"></div>
        <span id="error"></span>
    </div>

    <div class="buscar">
        <div class="form-group">
            <label for="buscar">Buscar:</label>
            <input type="text" name="buscar" id="buscar" placeholder="Buscar..." class="form-control">
            <label for="genero">Género: </label>
            <select name="genero" id="genero">
                <option value="">Todos</option>
                <?php
                foreach ($generos as $genero) {
                    echo '<option value="' . $genero['id_gen'] . '">' . $genero['nom_gen'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="contenedorpelis">
        <div id="pelis">
            <span id="error"></span>
        </div>
    </div>

    <div class="infopeli" id="peliinfo"></div>

    <script src="./procesos/contenido.js"></script>
</body>

</html>