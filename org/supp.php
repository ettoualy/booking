<?php
include "../config.php";

?>


<?php
$code = $_GET['id'];
   
    $q=mysql_query("DELETE FROM admin WHERE id='$code'");
   if($q){
    header("Location: users.php");
    die();
    exit();
          }


?>  