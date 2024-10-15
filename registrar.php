<?php
include 'link.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $check_result = $link->query("SELECT * FROM usuario WHERE email = '$email'");
    if ($check_result->num_rows > 0) {
        // Email already exists, handle the error (e.g., show an error message)
        echo "<script>alert('Email ya existente'); window.location.href='registrar.php';</script>";

    }else{
        $sql = "INSERT INTO usuario  (nombre,apellido, email, password) VALUES ('$nombre','$apellido','$email','$password')";
    }
   
    if (mysqli_query($link, $sql)){
        header("Location: login.php");
        exit();
    }else{
        echo "Error" . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <form action="registrar.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" required>
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Registrar</button>
    </form>
    <div class="form-link">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
</body>
</html>