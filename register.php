<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Registro</title>
</head>

<body>
    <div class="login-container">
        <h2 class="centrar_item">Registrate</h2>
        <form action="./procesos/validar.php" method="post">
            <input type="hidden" name="idp" id="idp" value="1">
            <p><label for="nom">Nombre: <span id="nom"></span></label></p>
            <input type="text" id="nom" name="nom">

            <p><label for="email">Correo electrónico: <span id="emailvacio"></span></label></p>
            <input type="email" id="email" name="email">

            <p><label for="pwd">Contraseña: <span id="pwdvacio"></span> </label></p>
            <input type="password" id="pwd" name="pwd">

            <p><label for="pwd2">Confirmar contraseña: <span id="pwdvacio2"></span></label></p>
            <input type="password" id="pwd2" name="pwd2">

            <div>
                <p class="centrar_item"><button type="submit" name="enviar2">Registarse</button></p>
                <p class="centrar_item"><button type="button" onclick="window.location.href='index.php'">Ya tengo cuenta</button></p>
            </div>
        </form>
    </div>
    <script src="./procesos/campos_login.js"></script>
</body>

</html>