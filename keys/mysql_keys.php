<?php
  $conn = mysqli_connect("35.187.54.208", "root", "password", "pastbook_demo", 3306);
  // Evaluate the connection
  if (mysqli_connect_errno()) {
      echo mysqli_connect_error();
      exit();
  }

  global $conn;
?>
