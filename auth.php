
<?php

//session_start();

if(!isset($_SESSION['user'])) {
 
  //header('WWW-Authenticate: Basic realm="My Realm"');
header('HTTP/1.0 401 Unauthorized');
echo 'please login to access the site';
header("Location: http://localhost/medicalstore/login.php");
die();

} 
?>
