<?php
include "header.php";
?>
   <div class="col-sm-16">

                 <section class="panel panel-primary" style="box-shadow: 3px 4px 12px #D1D1D1">
                     <div class="panel-body"></br>
                      <form class="form-horizontal form-variance" method="post">

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" type="text"  name="nom">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Prénom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded"  type="text" name="pre">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">E-mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded"  type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded"  type="text" name="username">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Mot de Passe :</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded"  type="text" name="mdp">
                                                    </div>
                                                </div>


                                                 <div class="form-group">
                                                    <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Role &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control mb-10 u-rounded" name="role">
                                                            <option>Simple user</option>
                                                            <option>Super Admin</option>
                                                            <option>Super moderator</option>

                                                        </select>
                                                        <span class="help-block">&nbsp;&nbsp;&nbsp;Choisir le role.</span>

                                                    </div>
                                                </div>

                                                        <center> <input type="submit" value="&nbsp;Ajouter&nbsp;" class="btn btn-primary" name="do">
                                                        <a href="users.php"><button class="btn btn-danger" name="do">&nbsp;Annuler&nbsp;</button></a>
                                                        </center>



                                            </form></br>


                                 </div>





                 </section>

    </div>

<?php
if(isset($_POST['do'])){

 $nom=$_POST['nom'];
 $prenom=$_POST['pre'];
 $email=$_POST['email'];
 $username=$_POST['username'];
 $password=$_POST['mdp'];
 $cypt=md5($password);

  if($_POST['role']=="Simple user")
    $role=0;
  else if($_POST['role']=="Super Admin")
    $role=1;
  else if($_POST['role']=="Super moderator")
    $role=2;

 if($nom!="" && $prenom!="" && $email!="" && $username!="" && $password!=""){


  $r=mysql_query("INSERT INTO admin(username, email ,password ,pwd ,admin ,fname ,lname ,bloque) VALUES ('$username','$email','$cypt','$password','$role','$prenom','$nom','0') ")
  or die(mysql_error());
   if($r){
    header("Location: users.php");
    die();
    exit();
    }

 }else{
     echo'
     <div class="alert alert-danger alert-dismissible">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <strong>&nbsp;Erreur !&nbsp;</strong> Veuillez remplir tous les champs .
       <a href="users.php" class="alert-link"> Retour</a>
     </div>
     ';
 }



}


?>


<?php
include "footer.php";
?>