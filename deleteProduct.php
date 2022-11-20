<?php
session_start();

require 'database.php';

  $delete_num = $_GET['id'];
  $sql_delete =  "DELETE FROM productos_marcas WHERE id = '$delete_num'";
  $query_delete = mysqli_query($connn,$sql_delete);
  if($connn->query($sql_delete)){
    header("Refresh:0 , url = productos.php");
    echo "<script>alert('¡Producto eliminado con éxito!')</script>";
    exit();

  }
  else{  
      header("Refresh:0 , url = productos.php");
      echo "<script>alert('deleted failed')</script>";
      exit();

  }
  mysqli_close($connn);
?>