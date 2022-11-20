<?php

require '../database.php';
if($_POST['value'] != null){
    $sql = "UPDATE product SET amount = '" . trim($_POST['value']) . "' WHERE id = '" . $_POST['id'] . "'";
    if($conn->query($sql)){
        header("Refresh:0 , url =../list.php");
        echo "<script>alert('¡Se ha editado el inventario!')</script>";
        exit();

    }
    else{
        header("Refresh:0 , url =../list.php");
        echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
        exit();

    }
}
?>