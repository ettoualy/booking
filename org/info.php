<?php
include "header.php";
$i = mysql_real_escape_string($_GET['id']);
$t=mysql_query("SELECT * FROM reserver WHERE id_local='$i'") or die(mysql_error());
if(mysql_num_rows($t) > 0){


         echo'                       <div class="panel">
                                                                        <header class="panel-heading">
                                                                                Reservations dans cette salle
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
                                                    <th>Date Début</th>
                                                    <th>Date Fin</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ';

                        while($r=mysql_fetch_assoc($t)){
                                         echo' <tr>
                                                    <td>'.$r['date_deb'].'</td>
                                                    <td>'.$r['date_fin'].'</td>';
                                                    if($r['date_val'] == null)
                                                    echo'<td><span class="label label-warning label-mini">En cours</span></td>';
                                                    else
                                                    echo'<td><span class="label label-success label-mini">Validée</span></td>';


                                                echo'</tr> ';
                                               }
                                            echo'
                                            </tbody>
                                        </table>




                                    </div>
                                </div>  ';


}else{
                      echo'
                                       <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                             il n\'y a aucune reservations .
                                        </div> ';


}





include "footer.php";
?>