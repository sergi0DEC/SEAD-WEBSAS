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
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($connn, $sql_fetch_todos);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Inventario</title>
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
    <!-- Cargando Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
    <!-- Cargando End -->

    <!-- Barra Navegación Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="pagina_principal.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="media/icono.ico" alt="" height="46">
            <h2 class="m-2 text-primary">WEB-SAS</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="pagina_principal.php" class="nav-item nav-link ">Inicio</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Inventario</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="list.php" class="dropdown-item active">Ver inventario</a>
                        <a href="404.php" class="dropdown-item">Agregar Producto </a>
                        <a href="404.php" class="dropdown-item">Modificar Inventario </a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <?php if(!empty($user)): ?>
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Hola: <?= $user['name']; ?></a>
                        <div class="dropdown-menu fade-down m-0">
                            <a href="my-account.php" class="dropdown-item">Mi cuenta</a>  
                            <a href="signup.php" class="dropdown-item">Agregar Cuenta</a>
                            <a href="#" class="dropdown-item">Ajustes</a>
                            <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>                       
                        </div>                   
                    </a>
                    <?php else: ?>
                        <a href="list.php" class="nav-item nav-link ">Iniciar Sesión</a>
                    <?php endif; ?>
                    
                </div>
            </div>
            <a href="#" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Nueva Actividad<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Barra de navegacion End -->

    <!--inventario start-->

    <div class="container1">
        <h1>Inventario</h1>
    </div>
    <div >
        <table class="table table-striped table-dark" style="width:90%; margin: 0 auto;">
            <tr>
                <th scope="col">Orden</th>
                <th scope="col">ID:Producto</th>
                <th scope="col">Nombre:Producto</th>
                <th scope="col">Cantidades</th>
                <th scope="col">Fecha:Registro</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
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
                        <td class="modify1"><a name="edit" id="" class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount']; ?> " role="button">
                                Editar
                            </a></td>
                        <td class="delete"><a name="id" id="" class="bdelete" href="delete.php?id=<?php echo $row['id'] ?>" role="button">
                                Eliminar
                            </a></td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="Addlist" style="float:right" href="addlist.php" role="button">Agregar Producto</a>
    </div>
    <?php
    mysqli_close($connn);
    ?>
    <!--inventario end-->
    <br><br><br>

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
                            <a href="pagina_principal.php">Inicio</a>
                            <a href="acerca-de.php">Acerca de</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

</body>

</html>