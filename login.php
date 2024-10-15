<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header("Location: productos.php");
    exit();
}
include 'link.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'validacion.php';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <form action="login.php" method="post">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit" name="val" value="1">Iniciar Sesión</button>
    </form>
    <div class="form-link">
            <p>¿No tienes una cuenta? <a href="registrar.php">Regístrate aquí</a></p>
    </div>
</body>
</html>