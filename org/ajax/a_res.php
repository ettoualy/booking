<?php
ob_start();
session_start();
include '../../config.php';
       $role = $_SESSION['role'];
    $idd = $_SESSION['id'];
  //  echo $role;
?>

<script>
function buttonnumber1(id){

 var idlocal = $("#idlocal"+id).val();
 var idact = $("#idact"+id).val();
 var titre = $("#titre"+id).val();
 var descr = $("#descr"+id).val();
 var d_date = $("#daten1").val();
 var f_date = $("#daten2").val();

if (titre == "" | descr == ""){
    alert('Completer tous les champs');
}else{

 $.ajax({
     type:'GET',
     url:'ajax/a_post.php?idl='+btoa(idlocal)+"&idact="+btoa(idact)+"&titre="+btoa(titre)+"&descr="+btoa(descr)+"&dd="+btoa(d_date)+"&df="+btoa(f_date),
     success:function(data){
       $("#modalreservercontent").html(data).show();
    }
 });

}
}

function buttonnumber2(id){

 var idlocal2 = $("#idlocal2"+id).val();
 var idact2 = $("#idact2"+id).val();
 var titre2 = $("#titre2"+id).val();
 var descr2 = $("#descr2"+id).val();
 var d_date = $("#daten1").val();
 var f_date = $("#daten2").val();

if (titre2 == "" | descr2 == ""){
    alert('Completer tous les champs');
}else{

 $.ajax({
     type:'GET',
     url:'ajax/a_post2.php?idl='+btoa(idlocal2)+"&idact="+btoa(idact2)+"&titre="+btoa(titre2)+"&descr="+btoa(descr2)+"&dd="+btoa(d_date)+"&df="+btoa(f_date),
     success:function(data){
       $("#modalreservercontent2").html(data).show();
    }
 });

}
}



</script>
<?php
echo '<br><br>';
$source1= base64_decode($_GET['d1']);
$time1= base64_decode($_GET['t1']);
$source2= base64_decode($_GET['d2']);
$time2= base64_decode($_GET['t2']);

$date1 = new DateTime($source1);
$dt1 =  $date1->format('Y-m-d');
$date2 = new DateTime($source2);
$dt2 =  $date2->format('Y-m-d');

$date_d = $dt1.' '.$time1;
$date_f = $dt2." ".$time2;

echo '<input type="hidden" id="daten1" value="'.$date_d.'">';
echo '<input type="hidden" id="daten2" value="'.$date_f.'">';
/*$u = mysql_query("select l.id_local from local l,reserver r,type_local t
where l.id_local = r.id_local and r.date_deb <= '$date_d' and r.date_fin >='$date_f'
and t.id_type=l.id_type and t.intitule_type='reunion' ") or die(mysql_error());
$gg= mysql_fetch_assoc($u);
echo $gg['id_local'];   */

/*
 echo $date_d."<br>";
 echo $date_f."<br>";*/
 $f = mysql_query("SELECT * FROM vacance where '$dt1' between date_D and date_F or '$dt2' between date_D and date_F ")  or die(mysql_error());


if(mysql_num_rows($f) == 0){
if($dt1 <= $dt2){
if($role == "resp_val_conf"){


 // $l = mysql_query("create or replace view local_res as select id_local from reserver where ('$date_d' between date_deb and date_fin or '$date_f' between date_deb and date_fin ) and  date_val is not null")or die(mysql_error());
  $l = mysql_query("create or replace view local_res as select id_local from reserver where
  (('$date_d'>= date_deb and '$date_d' < date_fin) or ('$date_f' >= date_deb and '$date_f' <= date_fin ) OR ('$date_d' <= date_deb and '$date_f' >= date_fin)) and  date_val is not null")or die(mysql_error());



 $ll = mysql_query("SELECT * from local l,affectation_typel a WHERE a.id_type=2 and l.id_local=a.id_local and l.id_local not in (select * from local_res)")or die(mysql_error());



 if(mysql_num_rows($ll) > 0){

 echo '

 <div class="col-md-1"></div>
 <div class="col-md-10">
 <table class="table table-bordered table-striped">
 <tr>
 <td>#</td>
 <td>Intitulé</td>
 <td>Capacité</td>
 <td>Resérver</td>
 </tr>
 ';

    while($rr = mysql_fetch_assoc($ll)){
    $id = $rr['id_local'];
    //echo $id ;
    echo '<tr>
    <td>'.$rr['id_local'].'</td>
    <td>'.$rr['intitule_local'].'</td>
    <td>'.$rr['capacite'].'</td>
    <td><button href="#myModalp'.$id.'" data-toggle="modal" class="btn btn-xs btn-info"><span class="fa fa-calendar-plus-o"></span>&nbsp;Reserver</button></td>
    </tr>';



    //echo '<option value="'.$id.'">'.$rr['intitule_local'].'</option>';

    echo '

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalp'.$id.'" class="modal fade" style="display: none;">
                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Reserver </h4>
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    </div>
                                                    <div class="modal-body" id="modalreservercontent">
                                 <form id="formrevact2" class="form-group">
                                 <label for="exampleInputEmail1">Type Activite</label>

                                 <select id="idact'.$id.'" class="form-control" name="idact">
                                 ';

                                        $qc = mysql_query("SELECT * FROM type_activite")or die(mysql_error());
                                        while($rc = mysql_fetch_assoc($qc)){
                                            echo '<option value="'.$rc['id_tp'].'">'.$rc['designation'].'</option>';
                                        }

                                 echo '
                                 </select>
                                 <br>
                                 <label for="exampleInputEmail1">Titre</label>
                                 <input type="text" id="titre'.$id.'" class="form-control" name="titre">
                                 <br>
                                 <label for="exampleInputEmail1">Description</label>
                                 <textarea placeholder="description here" id="descr'.$id.'" class="form-control" rows="4" name="descr"></textarea>
                                  <input type="hidden" value="'.$id.'" id="idlocal'.$id.'" name="idlocal">
                                 </form><br>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success" id="reserveraa" data-dismiss="modal" onclick="buttonnumber1('.$id.')">Reserver</button>
         </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

    ';

        }

echo '
 </table>
</div>
 <div class="col-md-1"></div>
';
 }else{
     echo '                             <div class="alert alert-info alert-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Warning!</strong>&nbsp;&nbsp;Tous les salles sont resérvés .
                                         </div> ';
 }

}else if($role == "resp_val_re"){


  $l = mysql_query("create or replace view local_res as select id_local from reserver where
  (('$date_d'>= date_deb and '$date_d' < date_fin) or ('$date_f' > date_deb and '$date_f' <= date_fin ) OR ('$date_d' <= date_deb and '$date_f' >= date_fin) )")or die(mysql_error());



 $ll = mysql_query("SELECT * from local l,affectation_typel a WHERE a.id_type=1 and l.id_local=a.id_local and l.id_local not in (select * from local_res)")or die(mysql_error());



 if(mysql_num_rows($ll) > 0){

 echo '

 <div class="col-md-1"></div>
 <div class="col-md-10">
 <table class="table table-bordered table-striped">
 <tr>
 <td>#</td>
 <td>Intitulé</td>
 <td>Capacité</td>
 <td>Resérver</td>
 </tr>
 ';

    while($rr = mysql_fetch_assoc($ll)){
    $id = $rr['id_local'];
    //echo $id ;
    echo '<tr>
    <td>'.$rr['id_local'].'</td>
    <td>'.$rr['intitule_local'].'</td>
    <td>'.$rr['capacite'].'</td>
    <td><button href="#myModalp'.$id.'" data-toggle="modal" class="btn btn-xs btn-info"><span class="fa fa-calendar-plus-o"></span>&nbsp;Reserver</button></td>
    </tr>';



    //echo '<option value="'.$id.'">'.$rr['intitule_local'].'</option>';

      echo '

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalp'.$id.'" class="modal fade" style="display: none;">
                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Reserver </h4>
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    </div>
                                                    <div class="modal-body" id="modalreservercontent">
                                 <form id="formrevact2" class="form-group">
                                 <label for="exampleInputEmail1">Type Activite</label>

                                 <select id="idact'.$id.'" class="form-control" name="idact">
                                 ';

                                        $qc = mysql_query("SELECT * FROM type_activite")or die(mysql_error());
                                        while($rc = mysql_fetch_assoc($qc)){
                                            echo '<option value="'.$rc['id_tp'].'">'.$rc['designation'].'</option>';
                                        }

                                 echo '
                                 </select>
                                 <br>
                                 <label for="exampleInputEmail1">Titre</label>
                                 <input type="text" id="titre'.$id.'" class="form-control" name="titre">
                                 <br>
                                 <label for="exampleInputEmail1">Description</label>
                                 <textarea placeholder="description here" id="descr'.$id.'" class="form-control" rows="4" name="descr"></textarea>
                                  <input type="hidden" value="'.$id.'" id="idlocal'.$id.'" name="idlocal">
                                 </form><br>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" id="reserveraa" onclick="buttonnumber1('.$id.')">Reserver</button>
         </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

    ';

        }

echo '
 </table>
</div>
 <div class="col-md-1"></div>
';
 }else{
     echo '                             <div class="alert alert-info alert-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Warning!</strong>&nbsp;&nbsp;Tous les salles sont resérvés .
                                         </div> ';
 }








}else if($role == "resp_activite"){

  $l = mysql_query("create or replace view local_res_conf as select id_local from reserver where
 (('$date_d'>=date_deb and '$date_d' < date_fin) or ('$date_f' > date_deb and '$date_f' <= date_fin ) OR ('$date_d' <= date_deb and '$date_f' >= date_fin)) and  date_val is not null")or die(mysql_error());
 $v = mysql_query("create or replace view local_res_re as select id_local from reserver where
  (('$date_d'>= date_deb and '$date_d' < date_fin) or ('$date_f' > date_deb and '$date_f' <= date_fin ) OR ('$date_d' <= date_deb and '$date_f' >= date_fin))") or die(mysql_error());

 $ll = mysql_query("SELECT * from local l,affectation_typel a WHERE a.id_type=2 and l.id_local=a.id_local and l.id_local not in (select * from local_res_conf)")or die(mysql_error());
 $vv = mysql_query("SELECT * from local l,affectation_typel a WHERE a.id_type=1 and l.id_local=a.id_local and l.id_local not in (select * from local_res_re)")or die(mysql_error());



 if(mysql_num_rows($ll) > 0 or mysql_num_rows($vv) > 0){

 echo '

 <div class="col-md-1"></div>
 <div class="col-md-10">
 <table class="table table-bordered table-striped">
 <tr>
 <td>#</td>
 <td>Intitulé</td>
 <td>Capacité</td>
 <td>Type</td>
 <td>Resérver</td>
 </tr>
 ';

     //conference
    while($rr = mysql_fetch_assoc($ll)){
    $id = $rr['id_local'];
    //echo $id ;
    echo '<tr>
    <td>'.$rr['id_local'].'</td>
    <td>'.$rr['intitule_local'].'</td>
    <td>'.$rr['capacite'].'</td>
    <td><span style="color:#CC0000 ">Conférence</span></td>';

    echo'
    <td><button href="#myModalp'.$id.'" data-toggle="modal" class="btn btn-xs btn-info"><span class="fa fa-calendar-plus-o"></span>&nbsp;Reserver</button></td>
    </tr> ';

           echo '

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalp'.$id.'" class="modal fade" style="display: none;">
                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="font-family: \'Comic Sans MS\', cursive, sans-serif; color: #62549A">Reserver </h4>
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    </div>
                                                    <div class="modal-body" id="modalreservercontent">
                                 <form id="formrevact2" class="form-group">
                                 <label for="exampleInputEmail1">Type Activite</label>

                                 <select id="idact'.$id.'" class="form-control" name="idact">
                                 ';

                                        $qc = mysql_query("SELECT * FROM type_activite")or die(mysql_error());
                                        while($rc = mysql_fetch_assoc($qc)){
                                            echo '<option value="'.$rc['id_tp'].'">'.$rc['designation'].'</option>';
                                        }

                                 echo '
                                 </select>
                                 <br>
                                 <label for="exampleInputEmail1">Titre</label>
                                 <input type="text" id="titre'.$id.'" class="form-control" name="titre">
                                 <br>
                                 <label for="exampleInputEmail1">Description</label>
                                 <textarea placeholder="description here" id="descr'.$id.'" class="form-control" rows="4" name="descr"></textarea>
                                  <input type="hidden" value="'.$id.'" id="idlocal'.$id.'" name="idlocal">
                                 </form><br>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" id="reserveraa" onclick="buttonnumber1('.$id.')">Reserver</button>
         </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

    ';

       }

      //reunion

      while($rrr = mysql_fetch_assoc($vv)){
    $idd = $rrr['id_local'];
    //echo $id ;
    echo '<tr>
    <td>'.$rrr['id_local'].'</td>
    <td>'.$rrr['intitule_local'].'</td>
    <td>'.$rrr['capacite'].'</td>
    <td><span style="color:#4BCC44 ">Réunion</span></td>';

    echo'
    <td><button href="#myModalppp'.$idd.'" data-toggle="modal" class="btn btn-xs btn-info"><span class="fa fa-calendar-plus-o"></span>&nbsp;Reserver</button></td>
    </tr> ';


         echo '

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalppp'.$idd.'" class="modal fade" style="display: none;">
                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="font-family: \'Comic Sans MS\', cursive, sans-serif; color: #62549A">Reserver </h4>
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    </div>
                                                    <div class="modal-body" id="modalreservercontent2">
                                 <form id="formrevact2" class="form-group">
                                 <label for="exampleInputEmail1">Type Activite</label>

                                 <select id="idact2'.$idd.'" class="form-control" name="idact">
                                 ';

                                        $qc = mysql_query("SELECT * FROM type_activite")or die(mysql_error());
                                        while($rc = mysql_fetch_assoc($qc)){
                                            echo '<option value="'.$rc['id_tp'].'">'.$rc['designation'].'</option>';
                                        }

                                 echo '
                                 </select>
                                 <br>
                                 <label for="exampleInputEmail1">Titre</label>
                                 <input type="text" id="titre2'.$idd.'" class="form-control" name="titre">
                                 <br>
                                 <label for="exampleInputEmail1">Description</label>
                                 <textarea placeholder="description here" id="descr2'.$idd.'" class="form-control" rows="4" name="descr"></textarea>
                                  <input type="hidden" value="'.$idd.'" id="idlocal2'.$idd.'" name="idlocal">
                                 </form><br>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" id="reserveraa" onclick="buttonnumber2('.$idd.')">Reserver</button>
         </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

    ';
       }



echo '
 </table>
</div>
 <div class="col-md-1"></div>
';
 }else{
     echo '                             <div class="alert alert-info alert-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Warning!</strong>&nbsp;&nbsp;Tous les salles sont resérvés .
                                         </div> ';
 }










}



}else{

echo'<script>swal("Erreur!", "Vérifier Dates!", "error")</script>';

}
}else{

echo '                                  <div class="alert alert-danger alert-dismissible fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Warning!</strong>&nbsp;&nbsp;dates incorrect : vacance .
                                        </div>';// vacance



}

?>
