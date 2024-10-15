<?php
include 'cabecera.php';
include 'link.php';

$sql = 'SELECT * FROM producto';
$query = mysqli_query($link, $sql);
?>

<h1>Lista de productos</h1>

<a class="add-product-link" href="agregar_producto.php">Añadir nuevo producto</a>
<div class="productos">
    <?php while ($row = mysqli_fetch_array($query)): ?>
        <div class="producto">
            <h3><?php echo $row['nombre'];?></h3>
            <img src="<?php echo $row['foto'];?>" width="100" height="100" alt="">
            <p><?php echo $row['descripcion'];?> </p>
            <p>Precio: $<?php echo $row['precio'];?> </p>
            <form action="carrito.php" method="post">
                <input type="hidden" name="id_producto" value="<?php echo $row['id_producto'];?>">
                <button type="submit" name="agregar">Agregar al carrito</button>
            </form>
        </div>
        <?php endwhile;?>
</div>