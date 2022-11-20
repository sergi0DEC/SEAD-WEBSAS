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
    if( $user['rol'] > 1):  
        header('Location: index.php');
        exit();
    endif;
}else{
    header('Location: index.php');
    exit();
}
$sql_fetch_todos = "SELECT * FROM users ORDER BY id ASC";
$query = mysqli_query($connn, $sql_fetch_todos);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Usuarios</title>
    <link rel="shortcut icon" type="image/x-icon" href="media/icono.ico"> 
    <meta content="width=device-width, initial-scale=0.5" name="viewport">
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
    <!-- Cargando Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
    <!-- Cargando End -->

    <!-- Barra Navegación Start -->
    <?php require('navbar.php')?>
    <!-- Barra de navegacion End -->

    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Usuarios</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!--inventario start-->

    <!-- <div class="container1">
        <h1>Usuarios</h1>
    </div> -->
    <div >
        <table class="table table-striped table-dark" style="width:90%; margin: 0 auto;">
            <tr>
                <!-- <th scope="col">Orden</th> -->
                <th scope="col">ID:Usuario</th>
                <th scope="col">Usuario</th>
                <th scope="col">NOMBRE: Usuario</th>
                <th scope="col">ROL: Usuario</th>
                <!-- <th scope="col">Editar</th> -->
                <th scope="col">Acción</th>
            </tr>
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <!-- <td scope="row"><?php echo $idpro ?></td> -->
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['rol'] ?></td>
                        <!-- <td class="modify1"><a name="edit" id="" class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount']; ?> " role="button">
                                Editar
                            </a></td> -->
                        <?php if( $row['id']== $user['id']):  ?> 
                            <td class="modify1"><a name="edit" id="" class="bfix" href="my-account.php" role="button">Editar</a></td>
                        <?php else: ?>
                            <script>
                                function eliminar(prueba){
                                var respuesta=confirm("¿Desea eliminar el USUARIO? (Esta acción no se puede deshacer)");
                                if(respuesta==true)
                                    window.location=prueba;
                                else
                                    return 0;
                                }
                            </script>
                            <td class="delete"><a name="id" id="" class="bdelete" onclick="eliminar('php/delete-user.php?id=<?php echo $row['id'] ?>')" role="button">Eliminar</a></td>
                        <?php endif; ?>

                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="Addlist" style="float:right" href="signup.php" role="button">Agregar Usuario</a>
        <a name="" id="" class="btn btn-warning" href="pagina_principal.php" role="button" style="float:left; font-size: 20px; margin-left:80px">Volver</a>


    </div>
    <?php
    mysqli_close($connn);
    ?>
    <!--usuarios end-->
    <br><br><br>

    <!-- Footer Start -->
    <!-- <?php require('footer.php')?> -->
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Add button Libraries             -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="../popper/popper.min.js"></script>	 	 	 
    <script src="bootstrap4/js/bootstrap.min.js"></script>   	
    <script src="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="codigo.js"></script> 	


</body>

</html>