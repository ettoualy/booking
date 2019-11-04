<?php

include ('config.php');
include ('function.php');

$uemail = $_GET['email'];
$token = $_GET['token'];

$userID = UserID($uemail);

$verifytoken = verifytoken($userID, $token);




if(isset($_POST['do']))
{
    $p1 = $_POST['pass1'];
    $p2 = $_POST['pass2'];

    $new_password = $_POST['pass1'];

    $retype_password = $_POST['pass2'];


    if($new_password == $retype_password)
    {
        $update_password = mysql_query("UPDATE compte SET password = '$new_password' WHERE id_pers = $userID") or die(mysql_error());
        if($update_password)
        {
                mysql_query("UPDATE compte SET token=null WHERE id_pers = $userID") or die(mysql_error());
                $msg = 'Your password has changed successfully. Please login with your new passowrd.';
                $msgclass = 'bg-success';
        }
    }else
    {
         $msg = "Password doesn't match";
         $msgclass = 'bg-danger';
    }

}


?>




<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="img/icon.png" />

        <title>Update Password</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="org/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="org/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="org/dist/css/main.css">

        <script src="org/assets/js/modernizr-custom.js"></script>
       </head>
        <body>


        <div class="sign-in-wrapper">
            <?php if($verifytoken == 1) { ?>
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo">FST Fès</h2>

                    <p>Entrer votre nouveau mot de passe.</p>
                </div>

                <form class="sign-in-form" role="form" action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="password" name="pass1">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="confirm password" name="pass2">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Send New Password " name="do"/>  <br><br>
                <?php if(isset($msg)) { ?>
                    <div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></br></br><center><span class="label label-primary"><a href="index.php" class="alert-link" style="text-decoration: none">LogIn Page</a></span></center></div>
                <?php } ?>
                </form>


               <div class="text-center copyright-txt">
                    <small><a href="https://web.facebook.com/younes.ettoualy" target="_blank" style="text-decoration : none;">Youness Ettoualy</a> - Copyright © 2017</small>
                </div>
            </div>
        <?php }else {?>
        	<div class="col-lg-4 col-lg-offset-4">
   		       	<h2>Invalid or Broken Token</h2>
                <p>Opps! The link you have come with is maybe broken or already used. Please make sure that you copied the link correctly or request another token from <a href="index.php">here</a>.</p>
            </div>
        <?php }?>
        </div>

        <!-- inject:js -->
        <script src="org/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="org/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="org/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="org/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="org/dist/js/main.js"></script>

    </body>
</html>
