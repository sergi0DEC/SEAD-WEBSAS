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
  }else{
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WEB-SAS</title>
    <link rel="shortcut icon" type="image/x-icon" href="media/icono.ico"> 
    <!-- <meta content="width=device-width, initial-scale=1.0" name="viewport"> -->
    <!--Meta datos-->
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

    <!-- Herramientas Start -->
   
    <div class="container-xxl py-5" style="margin-top:20px">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h4 class="section-title bg-white text-center text-primary px-3">Herramientas</h4>
        </div>
        <div class="container" style="margin-top:60px">
            <div class="row g-8">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="list.php">
                        <div class="service-item text-center pt-3">
                            <div class="p-4" >
                                <i class="fa fa-3x fa-list-alt text-primary mb-4"></i>
                                <h5 class="mb-3">Inventario</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="productos.php">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-check-square text-primary mb-4"></i>
                                <h5 class="mb-3">Productos</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <?php if( $user['rol'] == 1):  ?> 
                        <a href="users.php">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-users text-primary mb-4"></i>
                                <h5 class="mb-3">Usuarios</h5>
                            </div>
                        </div>
                        </a>
                    <?php else: ?>
                        <a href="my-account.php">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-users text-primary mb-4"></i>
                                <h5 class="mb-3">Mi cuenta</h5>
                            </div>
                        </div>
                        </a>
                    <?php endif; ?>
                    
                </div>
                <!-- <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <a href="404.php">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-tags text-primary mb-4"></i>
                            <h5 class="mb-3">Categorías</h5>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="404.php">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-square text-primary mb-4"></i>
                            <h5 class="mb-3">Empty</h5>
                            <p>Empty Tool</p>
                        </div>
                    </div>
                    </a>
                </div> -->
               <!-- <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="404.php">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-square text-primary mb-4"></i>
                            <h5 class="mb-3">Empty</h5>
                            <p>Empty Tool</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a href="404.php">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-square text-primary mb-4"></i>
                            <h5 class="mb-3">Empty</h5>
                            <p>Empty Tool</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <a href="404.php">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-square text-primary mb-4"></i>
                            <h5 class="mb-3">Empty</h5>
                            <p>Empty Tool</p>
                        </div>
                    </div>
                    </a>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Herramientas End -->
     
    <!-- Footer Start -->
    <div style="margin-top:140px">
        <?php require('footer.php')?>                  
    </div>
    
    <!-- Footer End -->

    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/inicio.js"></script>
</body>

</html>