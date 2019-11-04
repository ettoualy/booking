<?php
include "header.php";



if($role == "resp_activite" ){

        echo'<h2>Responsable d\'activité</h2>';


                             echo'  <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <aside class="col-md-12">
                                                <div id="calendar"></div>
                                            </aside>
                                        </div>
                                    </div>
                                </div> ';




}else if( $role == "resp_val_re"){

            echo'<h2>Responsable Reunion</h2>';
                       echo'  <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <aside class="col-md-12">
                                                <div id="calendar"></div>
                                            </aside>
                                        </div>
                                    </div>
                                </div> ';

}else if($role == "resp_val_conf"){


            echo'<h2>Responsable conference</h2>';

echo'  <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <aside class="col-md-12">
                                                <div id="calendar"></div>
                                            </aside>
                                        </div>
                                    </div>
                                </div> ';



}elseif($role == "admin"){
    header("Location: users.php");
    die();
    exit();

}




include "footer.php";
?>