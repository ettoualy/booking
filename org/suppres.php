<?php
include "../config.php";

?>


<?php
$code = $_GET['id'];
$dt = $_GET['dtr'];
$idl=$_GET['idl'];
$ida=$_GET['ida'];

    $q=mysql_query("DELETE FROM reserver WHERE id_pers='$code' and date_res='$dt' and id_local='$idl' and id_act='$ida'") or die(mysql_error());
    if($q){
    header("Location: mesres.php");
    die();
    exit();
          }


?>