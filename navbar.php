<?php
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
  }
?>

    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="media/icono.ico" alt="" height="46">
            <h2 class="m-2 text-primary">WEB-SAS</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <?php if(!empty($user)): ?>
                    <a href="index.php" class="nav-item nav-link">Inicio</a>
                    <a href="list.php" class="nav-item nav-link">Inventario</a>
                    <a href="productos.php" class="nav-item nav-link">Productos</a>
                <?php endif; ?> 
                <div class="nav-item dropdown">
                    <?php if(!empty($user)): ?>
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Hola: <?= $user['name']; ?></a>
                        <div class="dropdown-menu fade-down m-0">
                            <a href="my-account.php" class="dropdown-item">Mi cuenta</a>
                            <?php if( $user['rol'] == 1):  ?> 
                                <a href="signup.php" class="dropdown-item">Agregar Cuenta</a>
                            <?php endif; ?>
                            <a href="#" class="dropdown-item">Ajustes</a>
                            <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>                       
                        </div>                   
                    </a>
                    <?php else: ?>
                        <a href="index.php" class="nav-item nav-link ">Iniciar Sesión</a>
                    <?php endif; ?>                
                </div>
            </div>
            <?php if(!empty($user)): ?>
                <a href="productos.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Nuevo Producto<i class="fa fa-arrow-right ms-3"></i></a>
            <?php endif; ?> 
        </div>
    </nav>