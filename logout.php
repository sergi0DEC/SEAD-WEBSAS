<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /SEAD-WEBSAS-php/index.php');
?>