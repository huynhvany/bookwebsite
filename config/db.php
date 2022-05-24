<?php
  // include ('config.php');
  // Create database connector
  $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

  // Check connector
  if(mysqli_connect_errno()) {
    echo 'Fail to connect to MySQL '. mysqli_connect_errno(); 
  };

?>