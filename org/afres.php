<?php
  include 'header.php';

$year = mysql_real_escape_string($_GET['y']);
$month = mysql_real_escape_string($_GET['m']);
$day = mysql_real_escape_string($_GET['d']);


$ddate = $year."-".$month."-".$day;




?>
<div class="col-sm-12">

<?php

if($role == "resp_val_conf"){
$qq = mysql_query("SELECT r.id_local,r.id_act,r.date_deb,r.date_fin,r.date_val FROM reserver r,affectation_typel a WHERE r.date_deb LIKE('$ddate%') and r.id_local=a.id_local and a.id_type=2")or die(mysql_error());


                           echo'        <section class="panel">
                                    <header class="panel-heading">
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <tr>
                                                    <th>Date debut</th>
                                                    <th class="hidden-phone">Date fin</th>
                                                    <th>Locale reservé</th>
                                                    <th>Activite</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($tab=mysql_fetch_assoc($qq)){
                                             $id_act=$tab['id_act'];
                                             $id_local=$tab['id_local'];
                                             $dated=$tab['date_deb'];
                                             $datef=$tab['date_fin'];


                                         echo'       <tr>
                                                    <td>'.$dated.'</td>
                                                    <td class="hidden-phone">'.$datef.'</td>';
                            $l = mysql_query("select * from local where id_local='$id_local'") or die(mysql_error());
                            $t= mysql_fetch_assoc($l);
                            $ll = mysql_query("select * from activite where id_act='$id_act'") or die(mysql_error());
                            $tt= mysql_fetch_assoc($ll);


                                         echo'           <td>'.$t['intitule_local'].'</td>
                                                         <td>'.$tt['titre'].'</td>';
                                                         if($tab['date_val'] == null){
                                                         echo'<td><span class="label label-info label-mini">En cours</span></td>';
                                                         }else{
                                                         echo'<td><span class="label label-danger label-mini">Validée</span></td>';
                                                         }
                                                echo'</tr>';
                                                }

                                             echo'
                                            </tbody>
                                        </table>
                                    </div>
                                </section>';



}else if($role == "resp_val_re"){

$qq = mysql_query("SELECT r.id_local,r.id_act,r.date_deb,r.date_fin,r.date_val FROM reserver r,affectation_typel a WHERE r.date_deb LIKE('$ddate%') and r.id_local=a.id_local and a.id_type=1")or die(mysql_error());


                           echo'        <section class="panel">
                                    <header class="panel-heading">
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <tr>
                                                    <th>Date debut</th>
                                                    <th class="hidden-phone">Date fin</th>
                                                    <th>Locale reservé</th>
                                                    <th>Activite</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($tab=mysql_fetch_assoc($qq)){
                                             $id_act=$tab['id_act'];
                                             $id_local=$tab['id_local'];
                                             $dated=$tab['date_deb'];
                                             $datef=$tab['date_fin'];


                                         echo'       <tr>
                                                    <td>'.$dated.'</td>
                                                    <td class="hidden-phone">'.$datef.'</td>';
                            $l = mysql_query("select * from local where id_local='$id_local'") or die(mysql_error());
                            $t= mysql_fetch_assoc($l);
                            $ll = mysql_query("select * from activite where id_act='$id_act'") or die(mysql_error());
                            $tt= mysql_fetch_assoc($ll);


                                         echo'           <td>'.$t['intitule_local'].'</td>
                                                         <td>'.$tt['titre'].'</td>';
                                                         if($tab['date_val'] == null){
                                                         echo'<td><span class="label label-info label-mini">En cours</span></td>';
                                                         }else{
                                                         echo'<td><span class="label label-danger label-mini">Validée</span></td>';
                                                         }
                                                echo'</tr>';
                                                }

                                             echo'
                                            </tbody>
                                        </table>
                                    </div>
                                </section>';



}else if($role == "resp_activite"){
$qq = mysql_query("SELECT r.id_local,r.id_act,r.date_deb,r.date_fin,r.date_val FROM reserver r,affectation_typel a WHERE r.date_deb LIKE('$ddate%') and r.id_local=a.id_local and a.id_type In (1,2)")or die(mysql_error());


                           echo'        <section class="panel">
                                    <header class="panel-heading">
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <tr>
                                                    <th>Date debut</th>
                                                    <th class="hidden-phone">Date fin</th>
                                                    <th>Locale reservé</th>
                                                    <th>Activite</th>
                                                    <th>Type</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($tab=mysql_fetch_assoc($qq)){
                                             $id_act=$tab['id_act'];
                                             $id_local=$tab['id_local'];
                                             $dated=$tab['date_deb'];
                                             $datef=$tab['date_fin'];


                                         echo'       <tr>
                                                    <td>'.$dated.'</td>
                                                    <td class="hidden-phone">'.$datef.'</td>';
                            $l = mysql_query("select * from local where id_local='$id_local'") or die(mysql_error());
                            $t= mysql_fetch_assoc($l);
                            $ll = mysql_query("select * from activite where id_act='$id_act'") or die(mysql_error());
                            $tt= mysql_fetch_assoc($ll);
                            $lll = mysql_query("select * from affectation_typel where id_local='$id_local'") or die(mysql_error());
                            $ttt= mysql_fetch_assoc($lll);


                                         echo'           <td>'.$t['intitule_local'].'</td>
                                                         <td>'.$tt['titre'].'</td>';
                                                         if($ttt['id_type'] == 1){
                                                         echo'<td>Salle de réunion</td>';
                                                         }else if($ttt['id_type'] == 2){
                                                         echo '<td>Salle de conference</td>';
                                                         }
                                                         if($tab['date_val'] == null){
                                                         echo'<td><span class="label label-info label-mini">En cours</span></td>';
                                                         }else{
                                                         echo'<td><span class="label label-danger label-mini">Validée</span></td>';
                                                         }
                                                echo'</tr>';
                                                }

                                             echo'
                                            </tbody>
                                        </table>
                                    </div>
                                </section>';





}

                                ?>
                            </div>
<?php
  include 'footer.php';
?>