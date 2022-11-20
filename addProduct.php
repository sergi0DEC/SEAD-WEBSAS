<?php

require 'database.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, name, password, rol FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
  
    $user = null;
  
    if (count($results) > 0) {
    $user = $results;
    }
    if( $user['rol'] > 2):  
      header('Location: index.php');
      exit();
    endif;
  }else{
    header('Location: index.php');
    exit();
}

if($_POST['nombre'] != null && $_POST['marca'] != null && $_POST['descripcion'] != null ){
    $sql = "INSERT INTO productos_marcas(nombre,marca,descripcion) VALUES ('". trim($_POST['nombre'])."', '". trim($_POST['marca'])."', '". trim($_POST['descripcion'])."')";
            if($connn-> query($sql)){                
                header("Refresh:0 , url = productos.php");
                echo "<script>alert('¡Producto Agregado con éxito!')</script>";
                exit();
            }
            else{
                header("Refresh:0 , url = productos.php");
                echo "<script>alert('Error al agregar el producto')</script>";
                exit();
    
            }
}

?>