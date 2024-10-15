<?php
include 'cabecera.php';
include 'link.php';

$id_usuario = $_SESSION['id_usuario'];

// Obtener los productos del carrito
$sql = "SELECT carrito.*, producto.nombre, producto.precio FROM carrito 
        JOIN producto ON carrito.id_producto = producto.id_producto 
        WHERE id_usuario='$id_usuario'";
$query = mysqli_query($link, $sql);
?>
<h1>Previsualización de Compra</h1>
<table>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
    </tr>
    <?php $total = 0; ?>
    <?php while ($row = mysqli_fetch_array($query)): ?>
        <tr>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td>$<?php echo $row['precio']; ?></td>
            <td>$<?php echo $row['precio'] * $row['cantidad']; ?></td>
        </tr>
        <?php $total += $row['precio'] * $row['cantidad']; ?>
    <?php endwhile; ?>
    <tr>
        <td colspan="3">Total</td>
        <td>$<?php echo $total; ?></td>
    </tr>
</table>
<form action="compra.php" method="POST">
    <button type="submit">Confirmar Compra</button>
</form>
