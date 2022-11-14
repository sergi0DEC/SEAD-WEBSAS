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
  }
  $username = $_SESSION['user_id'];
  $sql_fetch_todos = "SELECT * FROM productos_marcas ORDER BY id ASC";
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
        <h1>Lista de Productos</h1>
    </div>
    <!-- Método para fix product -->
    <div class="fixproduct">
        <form method="POST" action="php/fix1Product.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre del Producto a editar</label>
                <br>
                <input style="border-top-style: solid;" type="text" class="form-control" name="name" value="<?php echo $_GET['message']; ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Marca</label>
                <br>
                <input type="text" value="<?php echo $_GET['marca'] ?>" class="form-control" name="marca" required>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Descripcion del producto</label>
                <br>
                <input style="border-top-style: solid;" type="text" class="form-control" name="descripcion" value="<?php echo $_GET['descripcion']; ?>" required>
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
                <th scope="col">ID Producto</th>
                <th scope="col">Nombre Producto</th>
                <th scope="col">Marca</th>
                <th scope="col">Descripcion</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                    <td scope="row"><?php echo $idpro ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['marca'] ?></td>
                        <td><?php echo $row['descripcion'] ?></td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="form-button">
        <a name="" id="" class="return" href="productos.php" role="button" style="float:left">Volver</a>
    </div>
    
    <?php
    mysqli_close($connn);
    ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">websas.com</a>, Todos los derechos reservados.                                      
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="index.php">Inicio</a>
                            <a href="acerca-de.php">Acerca de</a>
                            <a href="404.php">Preguntas frecuentes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

</body>
</html>