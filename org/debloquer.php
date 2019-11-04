<?php
include "../config.php";

?>


<?php
$code = $_GET['id'];

    $q=mysql_query("UPDATE admin set bloque=0 WHERE id='$code'");
   if($q){
    header("Location: users.php");
    die();
    exit();
          }


?>