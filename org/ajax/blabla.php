<?php
ob_start();
session_start();
include '../../config.php';
       $role = $_SESSION['role'];
      $idd = $_SESSION['id'];
  //  echo $role;
?>

<?php

$source1= base64_decode($_GET['d1']);
$source2= base64_decode($_GET['d2']);

$date1 = new DateTime($source1);
$dt1 =  $date1->format('Y-m-d');
$date2 = new DateTime($source2);
$dt2 =  $date2->format('Y-m-d');





if($dt1 <= $dt2){
if($role == "resp_val_conf"){

 $y = mysql_query("select * from reserver r,affectation_typel l where date(r.date_deb) >= '$dt1' and
 date(r.date_fin) <= '$dt2' and r.id_local=l.id_local and l.id_type=2 ") or die(mysql_error());
 if(mysql_num_rows($y) > 0){
     echo'<section class="panel">
                                    <header class="panel-heading">
                                       <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Local</th>
                                                    <th>Date debut</th>
                                                    <th>Date fin</th>
                                                    <th>Date reservation</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                         while($t=mysql_fetch_assoc($y)){
                                             $id=$t['id_local'];
                                             $j=mysql_query("select * from local where id_local='$id'");
                                             $jj=mysql_fetch_assoc($j);
                                               echo'
                                                <tr>
                                                    <td>'.$jj['intitule_local'].'</td>
                                                    <td>'.$t['date_deb'].'</td>
                                                    <td>'.$t['date_fin'].'</td>
                                                    <td>'.$t['date_res'].'</td>';
                                                    if($t['date_val'] == null)
                                                    echo'<td style="Color: #35B646">En cours</td>';
                                                    else
                                                    echo'<td style="Color: #CC0000">Validée</td>';

                                               echo' </tr>';

                                                }
                                        echo' </tbody>
                                        </table>
                                    </div>
                                </section>';
        }else{
                        echo '           <div class="alert alert-info info-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            &nbsp;&nbsp;Aucune salle reserve dans cette periode .
                                         </div> ';
             }

}else if($role == "resp_val_re"){



$y = mysql_query("select * from reserver r,affectation_typel l where date(r.date_deb) >= '$dt1' and
 date(r.date_fin) <= '$dt2' and r.id_local=l.id_local and l.id_type=1 ") or die(mysql_error());
 if(mysql_num_rows($y) > 0){
     echo'<section class="panel">
                                    <header class="panel-heading">
                                       <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Local</th>
                                                    <th>Date debut</th>
                                                    <th>Date fin</th>
                                                    <th>Date reservation</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                         while($t=mysql_fetch_assoc($y)){
                                             $id=$t['id_local'];
                                             $j=mysql_query("select * from local where id_local='$id'");
                                             $jj=mysql_fetch_assoc($j);
                                               echo'
                                                <tr>
                                                    <td>'.$jj['intitule_local'].'</td>
                                                    <td>'.$t['date_deb'].'</td>
                                                    <td>'.$t['date_fin'].'</td>
                                                    <td>'.$t['date_res'].'</td>';
                                                    if($t['date_val'] == null)
                                                    echo'<td style="Color: #35B646">En cours</td>';
                                                    else
                                                    echo'<td style="Color: #CC0000">Validée</td>';

                                               echo' </tr>';

                                                }
                                        echo' </tbody>
                                        </table>
                                    </div>
                                </section>';
        }else{
                        echo '           <div class="alert alert-info info-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            &nbsp;&nbsp;Aucune salle reserve dans cette periode .
                                         </div> ';
             }







}else if($role == "resp_activite"){


 $y = mysql_query("select * from reserver r where date(r.date_deb) >= '$dt1' and date(r.date_fin) <= '$dt2'") or die(mysql_error());
 if(mysql_num_rows($y) > 0){
     echo'<section class="panel">
                                    <header class="panel-heading">
                                       <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Local</th>
                                                    <th>Type</th>
                                                    <th>Date debut</th>
                                                    <th>Date fin</th>
                                                    <th>Date reservation</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                         while($t=mysql_fetch_assoc($y)){
                                             $id=$t['id_local'];
                                             $j=mysql_query("select * from local where id_local='$id'");
                                             $jj=mysql_fetch_assoc($j);
                                             $l=mysql_query("select * from affectation_typel where id_local='$id'");
                                             $ll=mysql_fetch_assoc($l);
                                               echo'
                                                <tr>
                                                    <td>'.$jj['intitule_local'].'</td>';
                                                     if($ll['id_type']==1)
                                                     echo'<td>Réunion</td>';
                                                     else if($ll['id_type']==2)
                                                     echo'<td>Conférence</td>';

                                                    echo'<td>'.$t['date_deb'].'</td>
                                                    <td>'.$t['date_fin'].'</td>
                                                    <td>'.$t['date_res'].'</td>';
                                                    if($t['date_val'] == null)
                                                    echo'<td style="Color: #35B646">En cours</td>';
                                                    else
                                                    echo'<td style="Color: #CC0000">Validée</td>';

                                               echo' </tr>';

                                                }
                                        echo' </tbody>
                                        </table>
                                    </div>
                                </section>';
        }else{
                        echo '           <div class="alert alert-info info-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            &nbsp;&nbsp;Aucune salle reserve dans cette periode .
                                         </div> ';
             }

}


}else
echo'<script>swal("Erreur!", "Vérifier les dates!", "error")</script>';



 ?>