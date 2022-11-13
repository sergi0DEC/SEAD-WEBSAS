<?php
    function function_alert($message) {
        
        // Display the alert box 
        echo "<script>alert('$message');</script>";
    }

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, name,password,rol) VALUES (:email,:name, :password,:rol)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':rol', $_POST['rol']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      //$message = 'Usuario creado exitosamente';
      function_alert("¡Usuario creado exitosamente!");
      header("Refresh:0 , url = users.php");
      exit();
    } else {
      $message = 'Lo siento, hubo un error al intentar crear su cuenta';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WEB-SAS</title>
    <link rel="shortcut icon" type="image/x-icon" href="media/icono.ico"> 
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Fuentes Google Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Hoja de estilos Icon Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Hoja de estilos Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Hola de estilos Bootstrap personalizada -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Hoja de estilos CSS  -->
    <link href="css/style.css" rel="stylesheet">
    <script src="js/inicio.js"></script>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
    <!-- Spinner End -->


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

    <!--Mensaje start-->
    <?php if(!empty($message)): ?>
      <h3> <?= $message ?></h3>
    <?php endif; ?>
    <!--Mensaje end-->

    <!-- sign up Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Crear Cuenta </h6>
                <h1 class="mb-5">Ingresa los datos del nuevo usuario</h1>
            </div>
            <div class="row mb-5 text-center align-items-center justify-content-center">            
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="signup.php" method="POST" >
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter your Name" required>
                                    <label for="name">Nombre</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="Enter your Email" required>
                                    <label for="email">Correo Electrónico</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="rol" type="number" min=1 max=3 class="form-control" id="rol" placeholder="Enter your Rol" required>
                                    <label for="Rol">Rol</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="confirm_password" type="password" class="form-control" placeholder="Confirm password" id="repassword" required>
                                    <label for="repassword">Repite la Contraseña</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Registrar Usuario</button>
                                <p class="warnings" id="warnings"></p>
                            </div>
                            <div class="col-md-12">
                                <!-- <h6 class="mb-4">¿Ya tienes cuenta?</h6> -->
                                <a href="users.php" class="btn btn-secondary w-100 py-3">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- sign up End -->


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