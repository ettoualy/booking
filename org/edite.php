<?php
include "header.php";

$id = mysql_real_escape_string($_GET['id']);

$qc = mysql_query("SELECT * FROM admin WHERE id='$id'")or die(mysql_error());
$rc = mysql_fetch_assoc($qc);

?>

 <div class="col-md-16">


                                        <div class="panel panel-primary">

                                                     <div class="panel-body"></br>
                                            <form class="form-horizontal form-variance" method="post">

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" type="text" value="<?php echo $rc['lname'] ?>" name="nom">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Prénom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" value="<?php echo $rc['fname'] ?>" type="text" name="pre">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">E-mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" value="<?php echo $rc['email'] ?>" type="text" name="email">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" value="<?php echo $rc['username'] ?>" type="text" name="username">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Mot de Passe :</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" value="<?php echo $rc['pwd'] ?>" type="text" name="mdp">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Role Actuel &nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" id="disabledInput" value="<?php if($rc['admin']==0) echo'Simple user'; elseif($rc['admin']==1) echo'Super Admin'; elseif($rc['admin']==2) echo'Super moderator'; ?>" disabled="" type="text">
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
                                                        <span class="help-block">&nbsp;&nbsp;&nbsp;Choisir la nouvelle role.</span>

                                                    </div>
                                                </div>

                                                        <center> <input type="submit" value="&nbsp;Modifier&nbsp;" class="btn btn-primary" name="do">
                                                        <a href="users.php"><button class="btn btn-danger" name="do">&nbsp;Annuler&nbsp;</button></a>
                                                        </center>



                                            </form>
                                          </div>
                                        </div>
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


 $r=mysql_query("UPDATE admin set lname='$nom' , fname='$prenom' , email='$email' , username='$username', pwd='$password' , password='$cypt' , admin='$role' WHERE id='$id'")or die(mysql_error());
 if($r){

    header("Location: users.php");
    die();
    exit();

 }
 }


?>

<?php
include "footer.php";
?>