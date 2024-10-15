<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: login.php");
    exit();
}

// Supongamos que has guardado el tipo de usuario en la sesión
// Por ejemplo, al iniciar sesión, puedes hacer algo como esto:
// $_SESSION['tipo_usuario'] = $row['tipo_usuario']; // donde $row es el resultado de la consulta del usuario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="carrito.php">Carrito</a></li>
                <?php
                // Verifica si el usuario es administrador antes de mostrar el enlace de reporte de ventas
                if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
                    <li><a href="reporte_ventas.php">Reporte de ventas</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
