<?php
    include"../config.php";


$idp= $_GET['idpers'];
$dtr= $_GET['dateres'];
$ida= $_GET['ida'];

$p=mysql_query("select * from compte where id_pers='$idp'") or die(mysql_error());
$pp=mysql_fetch_assoc($p);
$mail=$pp['email'];


$i=mysql_query("select * from reserver where id_pers='$idp' and id_act='$ida' and date_res='$dtr'") or die(mysql_error());
$ii=mysql_fetch_assoc($i);
$dtd=$ii['date_deb'];
$dtf=$ii['date_fin'];


$l=mysql_query("select id_local from reserver where id_pers='$idp' and id_act='$ida' and date_res='$dtr'") or die(mysql_error());
$ll=mysql_fetch_assoc($l);
$idlocal=$ll['id_local'];


$k=mysql_query("select intitule_local from local where id_local='$idlocal' ") or die(mysql_error());
$kk=mysql_fetch_assoc($k);

$intitule=$kk['intitule_local'];





   function send_mail($to,$date_deb,$date_fin,$salle)
{


    $subject = 'Confirmation de la reservation';
    $headers = "From: younes.ettoualyy@gmail.com \r\n";
    $headers .= "Reply-To: ". $to . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    @$body .= "<b style='color: #407DBF'>Reservation annulé</b><br><br>.<p></p>la salle ".$salle." de ".$date_deb." jusqu'a ".$date_fin;


    mail($to,$subject,$body,$headers);

}


$a = mysql_query("DELETE FROM reserver where id_pers='$idp' AND id_act='$ida' AND date_res='$dtr' ") or die(mysql_error());
if(isset($a)){
        send_mail($mail,$dtd,$dtf,$intitule);
header("Location: all.php");
    die();
    exit();
}



 ?>
