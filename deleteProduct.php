<?php
session_start();

require 'database.php';

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