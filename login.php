<?php
ob_start();
session_start();
ini_set('session.cookie_lifetime',  0);
error_reporting();
date_default_timezone_set('UTC');
include "config.php";


if(isset($_SESSION['loggeduser']) and isset($_SESSION['logedpass']) and isset($_SESSION['role']) and isset($_SESSION['id'])){

    header("Location: org");
    exit();

}


?>
<form method="post" action="">
    <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="user"><br>
    <input type="password" class="form-control" placeholder="Mot de passe" name="pass"><br>
    <center>
    <input type="submit" class="btn btn-primary btn-block" value="Log In" name="do">
    </center>
</form>
<?php

if(isset($_POST['do'])){
    $user = mysql_real_escape_string($_POST['user']);
    $pass = mysql_real_escape_string($_POST['pass']);
    $crypt = md5($pass);

$q = mysql_query("SELECT * FROM compte WHERE username='$user' AND password='$pass'")or die(mysql_error());
$n = mysql_num_rows($q);
$r = mysql_fetch_assoc($q);
    $id=$r['id_pers'];


if($n >0){
   $v = mysql_query("SELECT * from role r , affecter_role a WHERE a.id_pers = '$id' and a.id_role = r.id_role ") or die(mysql_error());
           $rr = mysql_fetch_assoc($v);



    $username = $r['username'];
    $password = $r['password'];
    $role = $rr['intitule_role'];
    $iddd = $rr['id_pers'];
    
     $_SESSION['loggeduser'] = $username ;
     $_SESSION['logedpass'] = $password;
     $_SESSION['role'] = $role;
     $_SESSION['id'] = $iddd;


    header("Location: org");
    exit();
    

}else{
    echo "<br><div class='alert alert-danger'>Le nom d'utilisateur ou mot de passe est incorrect . </div>";

}
}
    ?>



<?php

 ob_end_flush();
?>