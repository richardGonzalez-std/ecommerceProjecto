<?php
include 'cabecera.php';
include 'link.php';

$id_usuario = $_SESSION['id_usuario'];

// Primero, registrar la compra total en la tabla `compra`
$sql_compra = "INSERT INTO compra (id_usuario, total) VALUES ('$id_usuario', 0)";
if (mysqli_query($link, $sql_compra)) {
    // Obtener el ID de la compra recién creada
    $id_compra = mysqli_insert_id($link);
    
    // Obtener productos del carrito para registrar la compra
    $sql = "SELECT carrito.*, producto.nombre, producto.precio FROM carrito 
            JOIN producto ON carrito.id_producto = producto.id_producto 
            WHERE id_usuario='$id_usuario'";
    $query = mysqli_query($link, $sql);

    $total_compra = 0; // Inicializar total de la compra

    while ($row = mysqli_fetch_array($query)) {
        $id_producto = $row['id_producto'];
        $cantidad = $row['cantidad'];
        $precio = $row['precio'];
        $total = $precio * $cantidad;

        // Registrar cada producto en la tabla de detalle de compra
        $sql_detalle = "INSERT INTO detalle_compra (id_compra, id_producto, cantidad, precio_unitario) 
                        VALUES ('$id_compra', '$id_producto', '$cantidad', '$total')";
        mysqli_query($link, $sql_detalle);

        // Sumar el total de la compra
        $total_compra += $total;
    }

    // Actualizar el total de la compra en la tabla `compra`
    $sql_actualizar_total = "UPDATE compra SET total='$total_compra' WHERE id_compra='$id_compra'";
    mysqli_query($link, $sql_actualizar_total);

    // Vaciar el carrito
    $sql_vaciar_carrito = "DELETE FROM carrito WHERE id_usuario='$id_usuario'";
    mysqli_query($link, $sql_vaciar_carrito);

    echo "<h1>Compra Realizada Exitosamente</h1>";
    echo "<p>Gracias por su compra. Su pedido será procesado pronto.</p>";
} else {
    echo "Error al registrar la compra: " . mysqli_error($link);
}
?>
