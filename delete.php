<?php
session_start();

require 'database.php';
$delete_num = $_GET['id'];
$sql_delete =  "DELETE FROM product WHERE id = '$delete_num'";
$query_delete = mysqli_query($connn,$sql_delete);
if($connn->query($sql_delete)){
  header("Refresh:0 , url = list.php");
  echo "<script>alert('¡Inventario eliminado con éxito')</script>";
  exit();

}
else{
    header("Refresh:0 , url = list.php");
    echo "<script>alert('Fallo al eliminar inventario')</script>";
    exit();

}
mysqli_close($connn);
?>