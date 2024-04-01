<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("conexion.php");
    session_start();
    // Recoger todos los datos del formulario
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    if (empty($_POST['idp'])) {

        $consulta = $pdo->prepare("SELECT * FROM tbl_users WHERE email = :email");
        $consulta->bindParam(":email", $email);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($resultado && password_verify($pwd, $resultado['pwd'])) {
            if ($resultado['activo'] == '0') {
                $_SESSION['error_login'] = "Tu cuenta no se ha activado aun";
                header('Location: ../index.php');
                exit();
            } elseif ($resultado['rol'] == '1') {
                $_SESSION['id_user'] = $resultado['id_user'];
                header('Location: ../admin/');
                $pdo = null;
                exit();
            } else {
                $_SESSION['id_user'] = $resultado['id_user'];
                header('Location: ../view');
                $pdo = null;
                exit();
            }
        } else {
            $_SESSION['error_login'] = "Usuario o contraseña incorrectos";
            header('Location: ../index.php');
            exit();
        }
    } else {
        $nom = $_POST['nom'];
        $pwd2 = $_POST['pwd2'];

        // Verificar si las contraseñas coinciden
        if ($pwd !== $pwd2) {
            $_SESSION['error_pwd'] = "Las contraseñas no coinciden";
            header('Location: ../register.php');
            exit();
        }

        // Encriptar la contraseña

        $pwdencrip = password_hash($pwd, PASSWORD_BCRYPT);

        // Verificar si el correo electrónico ya está registrado
        $consulta = $pdo->prepare("SELECT * FROM tbl_users WHERE email = :email");
        $consulta->bindParam(":email", $email);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $_SESSION['error_email'] = "Este email ya esta registrado";
            header('Location: ../register.php');
            exit();
        } else {
            $rol = 2; 
            $activo = 0;
            // Insertar nuevo usuario en la base de datos
            $consulta = $pdo->prepare("INSERT INTO tbl_users (nom, email, pwd, rol, activo) VALUES (:nom, :email, :pwd, :rol, :activo)");
            $consulta->bindParam(":nom", $nom, PDO::PARAM_STR);
            $consulta->bindParam(":email", $email, PDO::PARAM_STR);
            $consulta->bindParam(":pwd", $pwdencrip, PDO::PARAM_STR);
            $consulta->bindParam(":rol", $rol, PDO::PARAM_INT); 
            $consulta->bindParam(":activo", $activo, PDO::PARAM_INT);
            $consulta->execute();

            header('Location: ../index.php');
            // Cerrar la conexión a la base de datos
            $pdo = null;
            exit();
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}
