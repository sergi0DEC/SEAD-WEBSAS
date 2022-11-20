<?php
session_start();

require '../database.php';
  $delete_num = $_GET['id'];
  $sql_delete =  "DELETE FROM users WHERE id = '$delete_num'";
  $query_delete = mysqli_query($connn,$sql_delete);
  if($connn->query($sql_delete)){   
    header("Refresh:0 , url = ../users.php");
    echo "<script>alert('Usuario Eliminado con éxito')</script>";
    exit();

  }
  else{
      header("Refresh:0 , url = ../users.php");
      echo "<script>alert('deleted failed')</script>";
      exit();

  }
  mysqli_close($connn);
?>