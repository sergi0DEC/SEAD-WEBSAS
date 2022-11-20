<?php
require_once "database.php";
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
  $username = $_SESSION['user_id'];
  $sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
  $query = mysqli_query($connn, $sql_fetch_todos);
?>

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <title>Editar Inventario</title>
    <link rel="shortcut icon" type="image/x-icon" href="media/icono.ico"> 
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Fuentes Google Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Hoja de estilos Icon Font -->
    <!--link iconos disponibles https://fontawesome.com/v4/icons/-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Hoja de estilos Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Hola de estilos Bootstrap personalizada -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Hoja de estilos CSS  -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/table-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    
</head>
<body>
    <!-- Barra Navegación Start -->
    <?php require('navbar.php')?>
    <!-- Barra de navegacion End -->   

    <div class="container1">
        <h1>Editar Inventario</h1>
    </div>
    <!-- Método para fix product -->
    <div class="fixproduct">
        <form method="POST" action="php/fix1.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre del Producto</label>
                <br>
                <input style="border-top-style: solid;" type="text" class="form-control" name="name" value="<?php echo $_GET['message']; ?>" required disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Cantidad</label>
                <br>
                <input type="text" value="<?php echo $_GET['amount'] ?>" class="form-control" name="value" required>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
            </div>
            <br>
            <div class="form-button">
                <button type="submit" class="btn btn-warning"  style="margin-bottom: 100px; margin-left:700px" >Editar</button>
            </div>
        </form>
    </div>

    <div class="table-product">
        <table class="table table-striped table-dark" style="width:90%; margin: 0 auto;">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Orden</th>
                <th scope="col">ID:Producto</th>
                <th scope="col">Nombre:Producto</th>
                <th scope="col">Cantidades</th>
                <th scope="col">Fecha:Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td scope="row"><?php echo $idpro ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['proname'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td class="timeregis"><?php echo $row['time'] ?></td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="form-button">
        <a name="" id="" class="return" onclick="history.back()" role="button" style="float:left">Volver</a>
    </div>
    
    <?php
    mysqli_close($connn);
    ?>

    <!-- Footer Start -->
    <?php require('footer.php')?>
    <!-- Footer End -->

</body>
</html>