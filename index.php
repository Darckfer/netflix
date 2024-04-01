<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header('Location: ./view');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Iniciar sesión</title>
</head>

<body>
    <div class="login-container">
        <h2 class="centrar_item">Iniciar sesión</h2>

        <form action="./procesos/validar.php" method="post">
            <?php
            if (isset($_SESSION['error_login'])) {
                echo "<p class='error'>".$_SESSION['error_login']."</p>";
            }
            ?>
            <p><label for="email">Correo electrónico: <span id="emailvacio"></span></label></p>
            <input type="email" id="email" name="email" required>

            <p><label for="pwd">Contraseña: <span id="pwdvacio"></span> </label></p>
            <input type="password" id="pwd" name="pwd" required>
            <div>
                <p class="centrar_item"><button type="submit" name="enviar">Iniciar sesión</button></p>
                <p class="centrar_item"><button type="button" onclick="window.location.href='register.php'">Registrarse</button></p>
            </div>
        </form>
    </div>
    <script src="./procesos/campos_login.js"></script>
</body>

</html>