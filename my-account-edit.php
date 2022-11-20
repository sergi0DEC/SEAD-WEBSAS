<?php
    function function_alert($message) {
    
        // Display the alert box 
        echo "<script>alert('$message');</script>";
    }
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
    $id=$_SESSION['user_id'];
  }else{
    header('Location: index.php');
    exit();
  }

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['name'])) {
    $sql = "UPDATE users SET name=:name, email=:email WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':name', $_POST['name']);

    if ($stmt->execute()) {     
        header("Refresh:0 , url = my-account.php");
        function_alert("Datos modificados con exito");
    } else {
      $message = 'Lo siento, hubo un error al intentar modificar tus datos';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Modificar datos</title>
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

    <!--Mensaje start-->
    <?php if(!empty($message)): ?>
      <h3> <?= $message ?></h3>
    <?php endif; ?>
    <!--Mensaje end-->

    <!-- modificar Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-5">Modifica tus datos</h1>
            </div>
            <div class="row mb-5 text-center align-items-center justify-content-center">            
                <div class="col-lg-4 col-md-12">

                    <form action="my-account-edit.php" method="POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input value=<?= $user['name']; ?> name="name" type="text" class="form-control" id="name" placeholder="Enter your Name" required>
                                    <label for="name">Nombre</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input value=<?= $user['email']; ?> name="email" type="text" class="form-control" id="email" placeholder="Enter your Email" required>
                                    <label for="email">Usuario</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <input class="btn btn-primary w-100 py-3" type="submit" value="Actualizar"></input>
                            </div>
                            <div class="col-md-12">
                                <a href="change-pass.php" class="btn btn-secondary w-100 py-3">Cambiar Contraseña</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modificar End -->

     
    <!-- Footer Start -->
    <?php require('footer.php')?>
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
