<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /SEAD-WEBSAS-php/pagina_principal.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /SEAD-WEBSAS-php/pagina_principal.php");
    } else {
      $message = 'Las credenciales no coinciden, intente de nuevo.';
    }
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>WEB-SAS</title>
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
    
</head>
<body>
    <!-- Barra Navegación Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="media/icono.ico" alt="" height="46">
            <h2 class="m-2 text-primary">WEB-SAS</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <!-- Barra navegacion End -->

    <!-- Mensaje start-->
    <?php if(!empty($message)): ?>
      <h5> <?= $message ?></h5>
    <?php endif; ?>
    <!-- Mensaje end-->    
    
    <!-- login Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">INICIAR SESIÓN</h6>
                <h1 class="mb-5 text-center">Bienvenido 28/9</h1>
            </div>
            <div class="row mb-5 text-center align-items-center justify-content-center">
                
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.3s">
                    <form action="index.php" method="POST"> 
                        <div class="row g-3">                   
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="email" type="text" class="form-control" placeholder="Your Email" required>
                                    <label for="email">Correo Electrónico</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="password" type="password" class="form-control" placeholder="password" required>
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--
                                <button class="btn btn-primary w-100 py-3" type="submit" name = "accede" value="iniciar_sesion" id="boton" onclick="login()" onsubmit="login()">Acceder</button>
                                -->
                                <input class="btn btn-primary w-100 py-3" type="submit" value="Enviar"></input>
                            </div>
                            <div class="col-md-6">
                                <a href="signup.php" class="btn btn-secondary w-100 py-3">Crear Cuenta</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- login End -->


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


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <!--Aqui metemos JQuery-->
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