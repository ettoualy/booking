<?php
ob_start();
session_start();
include "config.php";
if(!isset($_SESSION['loggeduser']) and !isset($_SESSION['loggedpass']) and !isset($_SESSION['role'])){

header("Location: ../");
    exit();
}else{

   session_destroy();
   header("location: ../");
   exit();
}
mysql_close();
ob_end_flush();
?>
