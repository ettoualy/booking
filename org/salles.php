

<?php
include "header.php";


if($role == "resp_activite" ){
echo'<center><h3><u>Salles de conférence </u></h3></center><br>';
  echo '<div class="col-md-12">';
   $a = mysql_query("SELECT * FROM local l,affectation_typel t WHERE t.id_type=2 AND l.id_local=t.id_local") or die(mysql_error());

   while($r=mysql_fetch_assoc($a)){
 $f=$r['id_local'];
 $h=$r['capacite'];
 $b = mysql_query("select GROUP_CONCAT(intitule_eq) from equipement where id_local='$f'") or die(mysql_error());
hall($r['intitule_local'],$r['img'],$b,$h,$f);
   }

    echo '</div>';
       echo '<div class="col-md-12">';
        echo'<br><center><h3><u>Salles de réunion </u></h3></center><br>';
                $a = mysql_query("SELECT * FROM local l,affectation_typel t WHERE t.id_type=1 AND l.id_local=t.id_local") or die(mysql_error());


   while($rr=mysql_fetch_assoc($a)){
 $g=$rr['id_local'];
 $c=$rr['capacite'];
 $b = mysql_query("select GROUP_CONCAT(intitule_eq) from equipement where id_local='$g'") or die(mysql_error());
hall($rr['intitule_local'],$rr['img'],$b,$c,$g);
 }

  echo '</div>';


}else if($role == "resp_val_re" ){

    echo'<center><h3>Salles de réunion </h3></center><br>';

 $a = mysql_query("SELECT * FROM local l,affectation_typel t WHERE t.id_type=1 AND l.id_local=t.id_local") or die(mysql_error());

  echo '<div class="col-md-12">';
   while($r=mysql_fetch_assoc($a)){
 $g=$r['id_local'];
 $c=$r['capacite'];
 $b = mysql_query("select GROUP_CONCAT(intitule_eq) from equipement where id_local='$g'") or die(mysql_error());
hall($r['intitule_local'],$r['img'],$b,$c,$g);

}
  echo '</div>';

  }else if($role == "resp_val_conf"){
$a = mysql_query("SELECT * FROM local l,affectation_typel t WHERE t.id_type=2 AND l.id_local=t.id_local") or die(mysql_error());

        echo'<center><h3>Salles de conférence </h3></center><br>';
  echo '<div class="col-md-12">';
   while($r=mysql_fetch_assoc($a)){
 $g=$r['id_local'];
 $c=$r['capacite'];
 $b = mysql_query("select GROUP_CONCAT(intitule_eq) from equipement where id_local='$g'") or die(mysql_error());
hall($r['intitule_local'],$r['img'],$b,$c,$g);

}
  echo '</div>';
   }



include "footer.php";
?>