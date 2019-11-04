<?php include "header.php"; ?>
<div class="col-sm-12">

<?php

if($role == "resp_val_conf"){
    $r = mysql_query("select * from reserver where id_pers='$idd'") or die(mysql_error());
    $n=mysql_num_rows($r);
                if($n > 0){
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
                                                    <th>Titre</th>
                                                    <th>Salle</th>
                                                    <th>Date Reservation</th>
                                                    <th>Date Debut</th>
                                                    <th>Date Fin</th>
                                                    <th>Etat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($t=mysql_fetch_assoc($r)){
                                             $id=$t['id_act'];
                                             $id2=$t['id_local'];

                                             $g=mysql_query("select * from activite where id_act='$id'");
                                             $gg=mysql_query("select * from local where id_local='$id2'");

                                             $v=mysql_fetch_assoc($g);
                                             $vv=mysql_fetch_assoc($gg);
                                            echo'<tr>
                                                    <td>'.$v['titre'].'</td>
                                                    <td>'.$vv['intitule_local'].'</td>
                                                    <td>'.$t['date_res'].'</td>
                                                    <td class="hidden-phone">'.$t['date_deb'].'</td>
                                                    <td>'.$t['date_fin'].'</td>';
                                                    if($t['date_val'] == null){
                                                    echo'<td><span class="label label-warning label-mini">En cours</span></td>';
                                                    }else{
                                                    echo'<td><span class="label label-success label-mini">Validé</span></td>';
                                                    }
                                            echo'   <td>
                                                                                      
                                            <a href="suppres.php?id='.$idd.'&dtr='.$t['date_res'].'&idl='.$id2.'&ida='.$id.'"><li class="btn btn-danger glyphicon glyphicon-trash btn-xs" ></li></a>


                                            </td>
                                            </tr>';


                                            }

                        echo'                    </tbody>
                                        </table>
                                    </div>
                                </section>';
                }else if($n == 0){
                    echo'<div class="alert alert-danger">Il n y a aucune reservations.</div>';
                }
}else if($role == "resp_val_re"){
      $r = mysql_query("select * from reserver where id_pers='$idd'") or die(mysql_error());
    $n=mysql_num_rows($r);
                if($n > 0){
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
                                                    <th>Titre</th>
                                                    <th>Salle</th>
                                                    <th>Date Reservation</th>
                                                    <th>Date Debut</th>
                                                    <th>Date Fin</th>
                                                    <th>Etat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($t=mysql_fetch_assoc($r)){
                                                 $id=$t['id_act'];
                                                 $id2=$t['id_local'];

                                                 $g=mysql_query("select * from activite where id_act='$id'");
                                                 $gg=mysql_query("select * from local where id_local='$id2'");

                                                 $v=mysql_fetch_assoc($g);
                                                 $vv=mysql_fetch_assoc($gg);
                                            echo'<tr>
                                                    <td>'.$v['titre'].'</td>
                                                    <td>'.$vv['intitule_local'].'</td>
                                                    <td>'.$t['date_res'].'</td>
                                                    <td class="hidden-phone">'.$t['date_deb'].'</td>
                                                    <td>'.$t['date_fin'].'</td>';
                                                    if($t['date_val'] == null){
                                                    echo'<td><span class="label label-warning label-mini">En cours</span></td>';
                                                    }else{
                                                    echo'<td><span class="label label-success label-mini">Validé</span></td>';
                                                    }
                                            echo'   <td>

                                            <a href="suppres.php?id='.$idd.'&dtr='.$t['date_res'].'&idl='.$id2.'&ida='.$id.'"><li class="btn btn-danger glyphicon glyphicon-trash btn-xs" ></li></a>


                                            </td>
                                            </tr>';


                                            }

                        echo'                    </tbody>
                                        </table>
                                    </div>
                                </section>';
                }else if($n == 0){
                    echo'<div class="alert alert-danger">Il n y a aucune reservations.</div>';
                }

}else if($role == "resp_activite"){
    $r = mysql_query("select * from reserver where id_pers='$idd'") or die(mysql_error());
    $n=mysql_num_rows($r);
                if($n > 0){
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
                                                    <th>Titre</th>
                                                    <th>Salle</th>
                                                    <th>Date Reservation</th>
                                                    <th>Date Debut</th>
                                                    <th>Date Fin</th>
                                                    <th>Type Local</th>
                                                    <th>Etat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($t=mysql_fetch_assoc($r)){
                                                $id=$t['id_act'];
                                                $id2=$t['id_local'];
                                                $g=mysql_query("select * from activite where id_act='$id'");
                                                $gg=mysql_query("select * from local where id_local='$id2'");
                                                $ggg=mysql_query("select * from affectation_typel where id_local='$id2'");
                                                $vvv=mysql_fetch_assoc($ggg);
                                                $vv=mysql_fetch_assoc($gg);
                                                $v=mysql_fetch_assoc($g);
                                            echo'<tr>
                                                    <td>'.$v['titre'].'</td>
                                                    <td>'.$vv['intitule_local'].'</td>
                                                    <td>'.$t['date_res'].'</td>
                                                    <td class="hidden-phone">'.$t['date_deb'].'</td>
                                                    <td>'.$t['date_fin'].'</td>';
                                                    if($vvv['id_type'] == 1){
                                                    echo'<td>Réunion</td>';
                                                    }else if($vvv['id_type'] == 2){
                                                    echo'<td>Conférence</td>';
                                                    }


                                                    if($t['date_val'] == null){
                                                    echo'<td><span class="label label-warning label-mini">En cours</span></td>';
                                                    }else{
                                                    echo'<td><span class="label label-success label-mini">Validé</span></td>';
                                                    }
                                            echo'   <td>

                                            <a href="suppres.php?id='.$idd.'&dtr='.$t['date_res'].'&idl='.$id2.'&ida='.$id.'" ><li class="btn btn-danger glyphicon glyphicon-trash btn-xs" ></li></a>


                                            </td>
                                            </tr>';


                                            }

                        echo'                    </tbody>
                                        </table>
                                    </div>
                                </section>';
                }else if($n == 0){
                    echo'<div class="alert alert-danger">Il n y a aucune reservations.</div>';
                }
}

                                ?>
</div>

<?php include "footer.php"; ?>
