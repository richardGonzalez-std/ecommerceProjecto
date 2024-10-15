<?php
//validación de login

if (isset($_POST['val'])) {
    switch ($_POST['val']){
        case 1:
            if (isset($_POST['email'], $_POST['password'] ) && $_POST['email']!='' && $_POST['password']!=''){
                $email = mysqli_real_escape_string($link, $_POST['email']);
                $password = mysqli_real_escape_string($link, $_POST['password']);
                $sql = "SELECT * FROM usuario WHERE email = '$email'";
                $query = mysqli_query($link, $sql);
                $num = mysqli_num_rows($query);

                if ($num==0){
                    echo "<script>alert('No existe el usuario.')</script>";
                }else{
                    $row = mysqli_fetch_array($query);
                    if ($row['password'] != md5($password)){
                        echo '<script>alert("Contraseña incorrecta.")</script>';
                    }else{
                        $_SESSION['id_usuario'] = $row['id_usuario'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['apellido'] = $row['apellido'];
                        $_SESSION['tipo'] = $row['tipo'];
                        echo "<script>window.location.href = 'productos.php';</script>";
                    }
                }
            }else{
                echo '<script>alert("Debe rellenar todos los datos.")</script>';
            }
            break;
            
    }
}