<?php

  include "header.php";
 ?>

     <?php

$ev = mysql_query("SELECT * FROM reserver r, affectation_typel a WHERE r.id_local=a.id_local AND a.id_type=1 AND r.date_val is NULL ") or die(mysql_error());
$e = mysql_query("SELECT * FROM reserver r, affectation_typel a WHERE r.id_local=a.id_local AND a.id_type=2 AND r.date_val is NULL ") or die(mysql_error());

     if($role == "resp_val_conf"){
           if(mysql_num_rows($e) > 0){


      echo'<section class="panel">
                                    <header class="panel-heading">
                                        <h4 style="color: #62549A">Veuillez verifier les dates avant la decision</h4>

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
                                                    <th>Description</th>
                                                    <th>Date Debut</th>
                                                    <th>Date Fin</th>
                                                    <th>Personne</th>
                                                    <th>Local</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($r=mysql_fetch_assoc($e)){

                                 $idlocal=$r['id_local'];
                                 $idacct = $r['id_act'];
                                 $idpres = $r['id_pers'];
                                 $dtres=$r['date_res'];
                                 $dd = $r['date_deb'];
                                 $df= $r['date_fin'];

           $u = mysql_query("SELECT * FROM activite WHERE id_act='$idacct'") or die(mysql_error());
           $h = mysql_fetch_assoc($u);
           $titre = $h['titre'];
           $desc = $h['description'];


           $o = mysql_query("SELECT * FROM personne WHERE id_pers='$idpres'") or die(mysql_erreur());
           $rr=mysql_fetch_assoc($o);
           $pre = $rr['prenom'];
           $nom = $rr['nom'];

           $jh= mysql_query("SELECT * FROM local WHERE id_local='$idlocal'") or die(mysql_error());
           $jjh=mysql_fetch_assoc($jh);
           $in_local=$jjh['intitule_local'];
                                            echo' <tr>
                                                  <td>'.$titre.'</td>
                                                  <td>'.$desc.'</td>
                                                  <td>'.$dd.'</td>
                                                  <td>'.$df.'</td>
                                                  <td>'.$pre." ".$nom.'</td>
                                                  <td>'.$in_local.'</td>
                                                  <td>


                                    <a href="sql11.php?idpers='.$idpres.'&dateres='.$dtres.'&ida='.$idacct.'"><li class="btn btn-success glyphicon glyphicon-ok btn-xs" ></li></a>
                                    <a href="sql22.php?idpers='.$idpres.'&dateres='.$dtres.'&ida='.$idacct.'"><li class="btn btn-danger glyphicon glyphicon-remove btn-xs" ></li></a>


                                                  </td>


                                                </tr>';
                                         }

                                           echo'</tbody>
                                        </table>

                                      </div>
 </section> ';
              }else{

                     echo'
                                       <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                             il n\'y a aucune demande .
                                        </div>

        ';


              }




    }else  if($role == "resp_val_re"){
       if( mysql_num_rows($ev) > 0){



      echo'<section class="panel">
                                    <header class="panel-heading">
                                    <h4 style="color: #62549A">Veuillez verifier les dates avant la decision</h4>

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
                                                    <th>Description</th>
                                                    <th>Date Debut</th>
                                                    <th>Date Fin</th>
                                                    <th>Personne</th>
                                                    <th>Local</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
                                            while($r=mysql_fetch_assoc($ev)){
                                 $idlocal=$r['id_local'];
                                 $idacct = $r['id_act'];
                                 $idpres = $r['id_pers'];
                                 $dtres=$r['date_res'];
                                 $dd = $r['date_deb'];
                                 $df= $r['date_fin'];

           $u = mysql_query("SELECT * FROM activite WHERE id_act='$idacct'") or die(mysql_error());
           $h = mysql_fetch_assoc($u);
           $titre = $h['titre'];
           $desc = $h['description'];


           $o = mysql_query("SELECT * FROM personne WHERE id_pers='$idpres'") or die(mysql_erreur());
           $rr=mysql_fetch_assoc($o);
           $pre = $rr['prenom'];
           $nom = $rr['nom'];

           $jh= mysql_query("SELECT * FROM local WHERE id_local='$idlocal'") or die(mysql_error());
           $jjh=mysql_fetch_assoc($jh);
           $in_local=$jjh['intitule_local'];
                                                echo'
                                                <tr>
                                                  <td>'.$titre.'</td>
                                                  <td>'.$desc.'</td>
                                                  <td>'.$dd.'</td>
                                                  <td>'.$df.'</td>
                                                  <td>'.$pre." ".$nom.'</td>
                                                  <td>'.$in_local.'</td>
                                                  <td>


                                    <a href="sql11.php?idpers='.$idpres.'&dateres='.$dtres.'&ida='.$idacct.'"><li class="btn btn-success glyphicon glyphicon-ok btn-xs" ></li></a>
                                    <a href="sql22.php?idpers='.$idpres.'&dateres='.$dtres.'&ida='.$idacct.'"><li class="btn btn-danger glyphicon glyphicon-remove btn-xs" ></li></a>


                                                  </td>


                                                </tr> ';
                                                }

                                       echo'     </tbody>
                                        </table>

                                      </div>
 </section> ';






    }else{
        echo'
                                       <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                             il n\'y a aucune demande .
                                        </div>

        ';
    }

     }

   ?>


<?php

include "footer.php";

 ?>