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
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($connn, $sql_fetch_todos);

?>

<!-- MEtodo del fix -->

<!doctype html>
<html lang="en">

<head>
    <title>Inventario</title>
    <link rel="shortcut icon" type="image/x-icon" href="media/icono.ico"> 
    <meta content="width=device-width, initial-scale=0.45" name="viewport">
    <!-- Fuentes Google Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Hoja de estilos Icon Font -->
    <!--link iconos disponibles https://fontawesome.com/v4/icons/-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  


    <!-- Hoja de estilos Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Hola de estilos Bootstrap personalizada -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Hoja de estilos CSS  -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/table-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">

    <!-- links para el modal -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">	         
      
    <link rel="stylesheet" href="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.css">
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
                    <h1 class="display-3 text-white animated slideInDown">Inventarios</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!--inventario start-->
<!-- 
    <div >
        <h1 style="text-align: center;">Inventarios</h1>
    </div> -->

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-dark" style="width:90%; margin: 0 auto;">
                <tr>
                    <th scope="col">Orden</th>
                    <th scope="col">ID:Producto</th>
                    <th scope="col">Nombre:Producto</th>
                    <th scope="col">Cantidades</th>
                    <th scope="col">Fecha:Registro</th>
                    <?php if( $user['rol'] < 3):  ?> 
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>                           
                    <?php endif; ?>
                    
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
                            <?php if( $user['rol'] < 3):  ?> 
                                <td class="modify1"><a name="edit" id="" class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount']; ?> " role="button"> Editar</td>
                                <!-- <td class="delete"><a name="id" id="" class="bdelete" href="delete.php?id=<?php echo $row['id'] ?>" role="button">Eliminar</a></td>                         -->
                                <script>
                                    function eliminar(prueba){
                                    var respuesta=confirm("¿Desea eliminar el producto?");
                                    if(respuesta==true)
                                        window.location=prueba;
                                    else
                                        return 0;
                                    }
                                </script>
                                <td class="delete"><a name="id" id="" type="button" class="bdelete" role="button"  onclick="eliminar('delete.php?id=<?php echo $row['id'] ?>')">
                                        Eliminar
                                </a></td>
                            <?php endif; ?>
                            
                        </tr>
                    <?php
                        $idpro++;
                    } ?>
                </tbody>

                
                
            </table>
            <br>
            <!-- <a name="" id="" class="Addlist" style="float:right" href="addlist.php" role="button">Agregar Producto</a> -->
            <?php if( $user['rol'] < 3):  ?> 
                <!-- Inicio Programación del modal -->
                <!-- Inicio Boton add product -->
                <div class="addproduct">
                    
                    <div class="containerModal">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@nombreDeUsuario" style="float:right; margin-right: 80px;margin-bottom:100px; font-size: 20px;">Agregar Inventario</button>
                        <!-- <a name="" id="" class="btn btn-warning" href="pagina_principal.php" role="button" style="float:left; font-size: 20px; margin-left:80px">Volver</a> -->
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
                                    <form method="POST" action="php/addlist1.php">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="col-form-label">Nombre de Producto:</label>
                                            <!-- <input type="text" class="form-control" id="recipient-name" name="name" required> -->
                                            <select name="name" id="">
                                                <option value="0">Seleccione</option>
                                                    <?php
                                                        
                                                        $sql_fetch_todos = "SELECT * FROM productos_marcas ORDER BY id ASC";
                                                        $query = mysqli_query($connn, $sql_fetch_todos);
                                                        
                                                        while($row = mysqli_fetch_array($query)){
                                                        echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';

                                                        }
                                                    ?>
                                            </select>  
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="col-form-label">Cantidad</label>
                                            <input type="number" class="form-control" name="amount" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="float:right; margin-right:120px">Guardar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float:left; margin-left:120px">Cancelar</button>
                                    </form>
                                </div>             
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Programación del modal -->
                <!-- Fin Boton add product -->
            <?php endif; ?>
            <div class="containerModal">                
                <a name="" id="" class="btn btn-warning" href="pagina_principal.php" role="button" style="float:left; font-size: 20px; margin-left:80px">Volver</a>
            </div>

        </div>

    </div>
    <?php
    mysqli_close($connn);
    ?>
    <!--inventario end-->
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
    <script src="../jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="../popper/popper.min.js"></script>	 	 	 
    <script src="bootstrap4/js/bootstrap.min.js"></script>   	
    <script src="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="codigo.js"></script> 	
    <script src="js/main.js"></script>

    <!-- Add button Libraries             -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="../popper/popper.min.js"></script>	 	 	 
    <script src="bootstrap4/js/bootstrap.min.js"></script>   	
    <script src="jqueryUI/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="codigo.js"></script> 	


</body>

</html>