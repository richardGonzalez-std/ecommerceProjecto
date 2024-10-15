<?php
include 'cabecera.php';
include 'link.php';

$id_usuario = $_SESSION['id_usuario'];

if (isset($_POST['agregar'])){
    $id_producto = $_POST['id_producto'];

    $sql = "SELECT * FROM carrito WHERE id_usuario='$id_usuario' AND id_producto='$id_producto'";
    $query = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($query) == 0) {
        // Si no está, lo agregamos
        $sql_insert = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES ('$id_usuario', '$id_producto', 1)";
        mysqli_query($link, $sql_insert);
    } else {
        // Si ya está, aumentamos la cantidad
        $sql_update = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario='$id_usuario' AND id_producto='$id_producto'";
        mysqli_query($link, $sql_update);
    }
}

// Eliminar producto del carrito
if (isset($_POST['eliminar'])) {
    $id_producto = $_POST['id_producto'];
    $sql_delete = "DELETE FROM carrito WHERE id_usuario='$id_usuario' AND id_producto='$id_producto'";
    mysqli_query($link, $sql_delete);
}

// Consultar productos en el carrito
$sql_carrito = "SELECT carrito.*, producto.nombre, producto.precio FROM carrito 
                JOIN producto ON carrito.id_producto = producto.id_producto 
                WHERE id_usuario='$id_usuario'";
$query_carrito = mysqli_query($link, $sql_carrito);

?>
<h1>Tu Carrito</h1>
<table>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
        <th>Acción</th>
    </tr>
    <?php $total = 0; ?>
    <?php while ($row = mysqli_fetch_array($query_carrito)): ?>
        <tr>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td>$<?php echo $row['precio']; ?></td>
            <td>$<?php echo $row['precio'] * $row['cantidad']; ?></td>
            <td>
                <form action="carrito.php" method="POST">
                    <input type="hidden" name="id_compra" value="<?php echo $row['id_producto']; ?>">
                    <button type="submit" name="eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total += $row['precio'] * $row['cantidad']; ?>
    <?php endwhile; ?>
    <tr>
        <td colspan="3">Total</td>
        <td>$<?php echo $total; ?></td>
        <td>
            <form action="precompra.php" method="POST">
                <button type="submit">Proceder a Comprar</button>
            </form>
        </td>
    </tr>
</table>
}