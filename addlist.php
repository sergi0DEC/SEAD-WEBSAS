<?php
require 'database.php';
session_start();


if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, name, password,rol FROM users WHERE id = :id');
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
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($connn, $sql_fetch_todos);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Agregar Producto al Inventario</title>
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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  
    <!-- JavaScript Bundle with Popper -->
    <!-- Hoja de estilos Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Hola de estilos Bootstrap personalizada -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Hoja de estilos CSS  -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/table-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Links para el modal -->
                            <!-- Esta linea cambia el estilo  -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">	          
    <link rel="stylesheet" href="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Links para el modal -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">	         
      
    <link rel="stylesheet" href="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.css">  
      
	<link rel="stylesheet" href="estilos.css">


</head>

<body>
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
                       <a href="list.php" class="dropdown-item">Ver inventario</a>
                        <a href="addlist.php" class="dropdown-item active">Agregar Producto </a>
                        <a href="fix.php" class="dropdown-item">Modificar Inventario </a>
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
                        <a href="index.php" class="nav-item nav-link ">Iniciar Sesión</a>
                    <?php endif; ?>
                    
                </div>
            </div>
            <a href="#" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Nueva Actividad<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Barra de navegacion End -->
    
    <!-- <div class="header"></div> -->
    <div class="container1">
        <h1>Agregar Productos</h1>
      <!--  <h2>Has accedido como <?//php echo $str = strtoupper($username) ?></h2>-->
    </div>
    <div>
        <table class="table table-striped table-dark" style="width:90%; margin: 0 auto;">
            <thead>
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
        <div class="addproduct">
            <!-- Programación del modal -->
            <!-- Boton -->
            <div class="containerModal">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@nombreDeUsuario" style="float:right; margin-right: 80px;margin-bottom:100px; font-size: 20px;">Agregar Producto</button>
            <a name="" id="" class="btn btn-warning" href="list.php" role="button" style="float:left; font-size: 20px; margin-left:80px">Volver</a>
            </div>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="addlist1.php">
                      <div class="form-group">
                        <label for="exampleInputEmail1" class="col-form-label">Nombre de Producto:</label>
                        <input type="text" class="form-control" id="recipient-name" name="name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1" class="col-form-label">Cantidad</label>
                        <input type="number" class="form-control" name="amount" required>
                      </div>
                      <button type="submit" class="btn btn-primary" style="float:right; margin-right:120px">Guardar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float:left; margin-left:120px">Cancelar</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button> -->
                  </div>
                </div>
              </div>
            </div>  

    
        </div>
    </div>

    <script src="../jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="../popper/popper.min.js"></script>	 	 	 
    <script src="bootstrap4/js/bootstrap.min.js"></script>   	
    <script src="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="codigo.js"></script> 	
    <?php
    mysqli_close($connn);
    ?>

    <!-- Links para el modal -->
   
</body>
</html>