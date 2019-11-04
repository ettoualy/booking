<?php
//Include database connection here
include"../config.php";
$idpers = $_GET["id"]; //escape the string if you like
$dateres = $_GET["d"]; //escape the string if you like
$idact = $_GET["a"]; //escape the string if you like
session_start();

    $role = $_SESSION['role'];
    $idd = $_SESSION['id'];

?>

<div class="modal-header" style="">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3 class="modal-title" style="color: #62549A">Veuillez verifier les dates avant la decision</h3>
</div>
<div class="modal-body" id="here">

        <form class="form-horizontal form-variance" >
    <?php $e = mysql_query("SELECT * FROM reserver WHERE id_pers='$idpers' AND date_res='$dateres'") or die(mysql_error());
          $r=mysql_fetch_assoc($e);
          $idlocal=$r['id_local'];
     ?>
                                                <div class="form-group">
         <?php $u = mysql_query("SELECT * FROM activite WHERE id_act='$idact'") or die(mysql_error());
               $h = mysql_fetch_assoc($u);

         ?>
                                                    <label class=" col-sm-3 control-label">Titre</label>
                                                    <div class="col-lg-6">
                                                        <p class="form-control-static"><?php echo $h['titre']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" col-sm-3 control-label">Description</label>
                                                    <div class="col-lg-6">
                                                        <p class="form-control-static"><?php echo $h['description']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" col-sm-3 control-label">Date Debut</label>
                                                    <div class="col-lg-6">
                                                        <p class="form-control-static"><?php echo $r['date_deb']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" col-sm-3 control-label">Date Fin</label>
                                                    <div class="col-lg-6">
                                                        <p class="form-control-static"><?php echo $r['date_fin']; ?></p>
                                                    </div>
                                                </div>
        <?php $o = mysql_query("SELECT * FROM personne WHERE id_pers='$idpers'") or die(mysql_erreur());
              $rr=mysql_fetch_assoc($o);
        ?>
                                                <div class="form-group">
                                                    <label class=" col-sm-3 control-label">Personne</label>
                                                    <div class="col-lg-6">
                                                        <p class="form-control-static"><?php echo $rr['prenom']." ".$rr['nom']; ?></p>
                                                    </div>
                                                </div>
         <?php $p=mysql_query("SELECT * FROM local where id_local='$idlocal'") or die(mysql_error());
               $pp=mysql_fetch_assoc($p);
         ?>
                                                <div class="form-group">
                                                    <label class=" col-sm-3 control-label">Local</label>
                                                    <div class="col-lg-6">
                                                        <p class="form-control-static"><?php echo $pp['intitule_local']; ?></p>
                                                    </div>
                                                </div>

</div>
<div class="modal-footer">
    <center>
    <input type="button" class="btn btn-success" data-dismiss="modal"  value="Valider" nom="val" id="val">
    <input type="button" class="btn btn-danger"  data-dismiss="modal"  value="Refuser" nom="ref" id="ref">
    </center>
</div>
 </form>


  <script>

  $(document).ready(function(){
$('#val').click(function(){
      var idp='<?php  echo $idpers;  ?>' ;
      var dtr='<?php  echo $dateres;  ?>' ;
      var ida='<?php  echo $idact;  ?>' ;

 $.ajax({
     type:'GET',
     url:'sql1.php?idpers='+btoa(idp)+"&dateres="+btoa(dtr)+"&ida="+btoa(ida),
     success:function(data){
       $("#here").html(data).show();
    }
 });



});


$('#ref').click(function(){
      var idp2='<?php  echo $idpers;  ?>' ;
      var dtr2='<?php  echo $dateres;  ?>' ;
      var ida2='<?php  echo $idact;  ?>' ;

 $.ajax({
     type:'GET',
     url:'sql2.php?idpers='+btoa(idp2)+"&dateres="+btoa(dtr2)+"&ida="+btoa(ida2),
     success:function(data){
       $("#here").html(data).show();
    }
 });



});


});





  </script>