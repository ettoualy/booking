<?php
ob_start();
session_start();
include '../../config.php';
       $role = $_SESSION['role'];
    $idd = $_SESSION['id'];
  //  echo $role;

$idl=base64_decode($_GET['idl']);
$ida= base64_decode($_GET['idact']);
$titre= base64_decode($_GET['titre']);
$desc= base64_decode($_GET['descr']);
$date_d= base64_decode($_GET['dd']);
$date_f= base64_decode($_GET['df']);

 $i = mysql_query("INSERT INTO activite  (titre,description,id_tp,id_pers)
 VALUES ('$titre','$desc','$ida','$idd')") or die(mysql_error());

 $ii=mysql_query("SELECT * FROM activite WHERE id_act=(select MAX(id_act) from activite)") or die(mysql_error());
 $r=mysql_fetch_assoc($ii);
 $id_act_last=$r['id_act'];

 $l = mysql_query("INSERT INTO reserver (date_res,date_val,date_deb,date_fin,id_act,id_pers,id_local)
 VALUES (now(),null,'$date_d','$date_f','$id_act_last','$idd','$idl')") or die(mysql_error());
 if($i && $l){
     echo'<script>swal("Demande envoyée !", "", "success")</script>';
 }else{
    echo'<script>swal("la reservation est annulé", "", "error")</script>';

 }



?>