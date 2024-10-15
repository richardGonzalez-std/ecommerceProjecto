<?php
include 'link.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Manejo de la imagen
    $target_dir = "uploads/"; // Asegúrate de que este directorio tenga permisos de escritura
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    
    // Verificar si se subió correctamente
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Guardar el producto en la base de datos
        $sql = "INSERT INTO producto (nombre, descripcion, precio, stock, foto) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$target_file')";
        if (mysqli_query($link, $sql)) {
            echo "Producto añadido exitosamente.";
            echo "<script>window.location.href='productos.php'</script>";
        } else {
            echo "Error al añadir el producto: " . mysqli_error($link);
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Agregar Producto</h1>
    <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*" required><br>

        <button type="submit">Agregar Producto</button>
    </form>
</body>
</html>
