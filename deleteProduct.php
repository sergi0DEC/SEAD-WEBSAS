<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, name, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
  $user = $results;
    }
}
$sql_fetch_todos = "SELECT * FROM productos_marcas ORDER BY id ASC";
$query = mysqli_query($connn, $sql_fetch_todos);

?>

<?php
    // echo "<script>
    // var resultado = window.confirm('Estas seguro?');
    // if (resultado === true) {
    //     window.alert('Okay, si estas seguro.');
    // } else { 
    //     window.alert('Pareces indeciso');
    // }
    // </script>";
    $delete_num = $_GET['id'];
    $sql_delete =  "DELETE FROM productos_marcas WHERE id = '$delete_num'";
    $query_delete = mysqli_query($connn,$sql_delete);
    // $row = mysqli_fetch_assoc($query_delete);
    // if(!$row){
    //     echo "<script>alert('Eliminación de Producto Exitosa')</script>";        
    //   //  header("Refresh: 0 , url = list.php");
    //   //  exit();

    // }
    // else{
    //     echo "<script>alert('No se pudo eliminar producto')</script>";
    //     header("Refresh: 0 , url = list.php");
    //     exit();

    // }
    if($connn->query($sql_delete)){
      echo "<script>alert('Success deleted')</script>";
      header("Refresh:0 , url = productos.php");
      exit();

    }
    else{
        echo "<script>alert('deleted failed')</script>";
        header("Refresh:0 , url = productos.php");
        exit();

    }
    mysqli_close($connn);
?>