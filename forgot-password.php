<?php include "config.php";
      include "function.php";

if(isset($_POST['do']))
{
    $uemail = $_POST['mail'];
    $uemail = mysql_real_escape_string($uemail);

    if(checkUser($uemail) == "true")
    {
        $userID = UserID($uemail);
        $token = generateRandomString();

        $query = mysql_query("update compte set token='$token' where id_pers='$userID'") or die(mysql_error());

        if($query)
        {
             $send_mail = send_mail($uemail, $token);


            if($send_mail === 'success')
            {
                 $msg = 'A mail with recovery instruction has sent to your email.';
                 $msgclass = 'bg-success';
            }else{
                $msg = 'There is something wrong.';
                $msgclass = 'bg-danger';
            }



        }else
        {
                $msg = 'There is something wrong.';
                 $msgclass = 'bg-danger';
        }

    }else
    {
        $msg = "This email doesn't exist in our database.";
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

        <title>Forgot Password</title>

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
            <div class="sign-container">
                <div class="text-center">

                    <h2 class="logo">FST Fès</h2>

                    <p>Entrez votre adresse email pour récupérer un nouveau mot de passe.</p>
                </div>

                <form class="sign-in-form" role="form" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="mail">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Send New Password " name="do"/> <br><br>
                <?php if(isset($msg)) {?>
                    <div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></div>
                <?php } ?>
                </form>
                <div class="text-center copyright-txt">
                    <small><a href="https://web.facebook.com/younes.ettoualy" target="_blank" style="text-decoration : none;">Youness Ettoualy</a> - Copyright © 2017</small>
                </div>
            </div>
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
