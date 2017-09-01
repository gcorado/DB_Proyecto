<?php
  session_start();
  if (isset($_SESSION['username'])) {
    session_destroy();
    echo "OK";
    header("Location: ../client/index.html");
    die();
  }
 ?>
