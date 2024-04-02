<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: ../index.php');
}
if ($_SESSION['rol'] == 2) {
    header('Location: ../view/index.php');
}
include('./procesos/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h3>Bienvenido: <?php echo $_SESSION['nom']; ?></h3>
    <a href="./procesos/salir.php"><button type="button" class="btn btn-danger">Salir</button></a>
    <div class="columnas">
        <div class="columna">
            <h1>Peticiones aceptar usuarios</h1>
            <!-- Utilizar clases de Bootstrap para tablas -->
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>id_user</th>
                        <th>Nombre</th>
                        <th>email</th>
                        <th>rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Listado de peticiones -->
                <tbody id="peticiones"></tbody>
            </table>

            <div>
                <h1>Usuarios activos</h1>
                <!-- Utilizar clases de Bootstrap para tablas -->
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>id_user</th>
                            <th>Nombre</th>
                            <th>email</th>
                            <th>rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Listado de usuarios -->
                    <tbody id="usuarios"></tbody>
                </table>
            </div>
        </div>

        <div class="columna">
            <div class="formulario">
                <form action="" method="post" id="editusu">
                    <input type="hidden" name="idp" id="idp" value="">
                    <p>Nombre:</p>
                    <p><input type="text" name="nom" id="nom" placeholder="nom" class="form-control"></p>
                    <p>Email:</p>
                    <p><input type="email" name="email" id="email" placeholder="email" class="form-control"></p>
                    <p>Rol:</p>
                    <p>
                        <select name="rol" id="rol" class="form-control">
                            <?php
                            $consulta = $pdo->prepare("SELECT * FROM tbl_rol");
                            $consulta->execute();
                            $generos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($generos as $genero) {
                                echo '<option value="' . $genero['id_rol'] . '">' . $genero['nom_rol'] . '</option>';
                            }
                            ?>
                        </select>
                    </p>
                    <p>Estado:</p>
                    <p>
                        <select name="activo" id="activo" class="form-control">
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </p>
                    <p><input type="button" id="editarusu" value="Confirmar" class="btn btn-primary"></p>
                </form>
            </div>
        </div>

        <div class="columna">
            <div class="formulario">
                <form action="" method="post" id="frmpeli">
                    <input type="hidden" name="idcont" id="idcont" value="">
                    <p>Titulo:</p>
                    <p><input type="text" name="titulo" id="titulo" placeholder="titulo" class="form-control"></p>
                    <p>Descripcion:</p>
                    <p><input type="text" name="Descripcion" id="Descripcion" placeholder="Descripcion" class="form-control"></p>
                    <p>URL Trailer:</p>
                    <p><input type="text" name="url_video" id="url_video" placeholder="url_video" class="form-control"></p>
                    <p>Fecha estreno:</p>
                    <p><input type="date" name="fecha_subida" id="fecha_subida" class="form-control"></p>
                    <p>Genero:</p>
                    <select name="genero" id="genero" class="form-control">
                        <option value="">Todos</option>
                        <?php
                        $consulta = $pdo->prepare("SELECT id_gen, nom_gen FROM tbl_genero");
                        $consulta->execute();
                        $generos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($generos as $genero) {
                            echo '<option value="' . $genero['id_gen'] . '">' . $genero['nom_gen'] . '</option>';
                        }
                        ?>
                    </select>
                    <p>Portada:</p>
                    <p><input type="file" name="portada" id="portada" class="form-control"></p>
                    <p><input type="button" id="editarpeli" value="registrar" class="btn btn-primary"></p>
                </form>
            </div>
        </div>
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

    <div>
        <h1>Peliculas activas</h1>
        <!-- Utilizar clases de Bootstrap para tablas -->
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th>id_cont</th>
                    <th>titulo</th>
                    <th>Descripcion</th>
                    <th>url_video</th>
                    <th>fecha_subida</th>
                    <th>genero</th>
                    <th>portada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Listado de peliculas -->
            <tbody id="peliculas">
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="./procesos/contenido.js"></script>
</body>

</html>