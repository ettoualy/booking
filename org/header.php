<?php
ob_start();
session_start();
ini_set('session.cookie_lifetime',  0);
error_reporting();
date_default_timezone_set('UTC');
include "../config.php";
 

if(!isset($_SESSION['loggeduser']) and !isset($_SESSION['loggedpass']) and !isset($_SESSION['role']) and !isset($_SESSION['id'])){

header("Location: ../");
    exit();

}else{
    $role = $_SESSION['role'];
    $idd = $_SESSION['id'];

}

include "functions/design.php";

?>
<!DOCTYPE html>
<html>

<!-- Mirrored from bootkit-admin.themebucket.net/demo/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Mar 2017 15:04:28 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="imgs/admin1.png" />
        <title>Home</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="dist/css/custom.css">
        <link rel="stylesheet" href="dist/css/main.css">
        <link rel="stylesheet" href="dist/css/sweetalert.css" />



        <!-- Rickshaw Chart Depencencies -->
        <link rel="stylesheet" href="bower_components/rickshaw/rickshaw.min.css">
        <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">


        <!-- Bootstrap DatePicker Dependencies  -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">

        <!-- Bootstrap TimePicker Dependencies  -->
        <link rel="stylesheet" href="bower_components/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

        <!-- Bootstrap Date Range Picker Dependencies -->
        <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">


        <script src="assets/js/jquery.min.js"></script>
        <script src="dist/js/sweetalert.min.js"></script>
        <script src="dist/js/sweetalert-dev.js"></script>
        <script src="assets/js/modernizr-custom.js"></script>


    </head>
    <body>

        <div id="ui" class="ui">

            <!--header start-->
                <!--<header id="header" class="ui-header ui-header--green text-white">  -->
               <!-- <header id="header" class="ui-header ui-header--dark text-white">-->   <!-- dark -->
           <header id="header" class="ui-header ui-header--purple text-white">  <!--purple    -->
               <!-- <header id="header" class="ui-header ui-header--dark-- text-white--"> white   -->
                <div class="navbar-header">
                    <!--logo start-->
                    <a href="index.php" class="navbar-brand">
                       <div style="width: 50%; height: 100%"><span class="logo"><img src="imgs/fstfes.png" style="width: 50%; height: 100%" alt=""/>&nbsp; FST Fès</span></div>
                    </a>
                    <!--logo end-->
                </div>



                <div class="navbar-collapse nav-responsive-disabled">



                      <?php
                        if($role == "resp_val_conf"){
                        $q00 = mysql_query("
                        SELECT * FROM reserver r, affectation_typel a WHERE r.id_local=a.id_local AND a.id_type=2 AND r.date_val is NULL LIMIT 6")or die(mysql_error());

                      $howmuch = mysql_num_rows($q00);

                      ?>

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge"><?php echo $howmuch; ?></span>
                            </a>
                            <!--dropdown -->
                            <ul class="dropdown-menu dropdown-menu--responsive">
                                <div class="dropdown-header">Notifications (<?php echo $howmuch; ?>)</div>
                                <ul class="Notification-list Notification-list--small niceScroll list-group">

                                <?php
                                while($rou = mysql_fetch_assoc($q00)){
                                 $idacct = $rou['id_act'];
                                 $idpres = $rou['id_pers'];
                                 $dtres=$rou['date_res'];
                                 $qret = mysql_query("SELECT * FROM activite WHERE id_act='$idacct'")or die(mysql_error());
                                  $gfhy = mysql_fetch_assoc($qret);

                                  $qret2 = mysql_query("SELECT * FROM personne WHERE id_pers='$idpres'")or die(mysql_error());
                                  $gfhy2 = mysql_fetch_assoc($qret2);
                                echo '

                                <li class="Notification list-group-item">
                                        <button class="Notification__status Notification__status--read" type="button" name="button"></button>
                                        <a href="not.php?id='.$idpres.'&d='.$dtres.'&a='.$rou['id_act'].'" data-toggle="modal" data-target="#myModal">

                                            <div class="Notification__highlight">
                                                <p class="Notification__highlight-excerpt"><b>'.$gfhy['titre'].'</b></p>
                                                <p class="Notification__highlight-time">'.$gfhy2['nom']." ".$gfhy2['prenom'].'</p>
                                            </div>
                                        </a>

                                    </li>

                                ';

                                }


                                ?>


                                </ul>
                                <div class="dropdown-footer"><a href="all.php" target="_blank">Afficher Tous</a></div>

                            </ul>
                            <!--/ dropdown -->
                        </li>


                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                
                                    <span class="hidden-sm hidden-xs"><?php
                                    $qq = mysql_query('SELECT p.prenom,p.nom FROM personne p WHERE p.id_pers="'.$_SESSION['id'].'"')or die(mysql_error());
                                    $rr = mysql_fetch_assoc($qq);
                                    echo $rr['prenom']." ".$rr['nom'];

                                    ?></span>
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">


                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Se deconnecter</a></li>
                            </ul>
                        </li>


                    </ul>
                    <!--notification end-->
                     <?php }else  if($role == "resp_val_re"){
                        $q00 = mysql_query("
                        SELECT * FROM reserver r, affectation_typel a WHERE r.id_local=a.id_local AND a.id_type=1 AND r.date_val is NULL LIMIT 6")or die(mysql_error());

                      $howmuch = mysql_num_rows($q00);

                      ?>

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge"><?php echo $howmuch; ?></span>
                            </a>
                            <!--dropdown -->
                            <ul class="dropdown-menu dropdown-menu--responsive">
                                <div class="dropdown-header">Notifications (<?php echo $howmuch; ?>)</div>
                                <ul class="Notification-list Notification-list--small niceScroll list-group">

                                <?php
                                while($rou = mysql_fetch_assoc($q00)){
                                 $idacct = $rou['id_act'];
                                 $idpres = $rou['id_pers'];
                                 $dtres=$rou['date_res'];
                                 $qret = mysql_query("SELECT * FROM activite WHERE id_act='$idacct'")or die(mysql_error());
                                  $gfhy = mysql_fetch_assoc($qret);

                                  $qret2 = mysql_query("SELECT * FROM personne WHERE id_pers='$idpres'")or die(mysql_error());
                                  $gfhy2 = mysql_fetch_assoc($qret2);
                                echo '

                                <li class="Notification list-group-item">
                                        <button class="Notification__status Notification__status--read" type="button" name="button"></button>
                                        <a href="not.php?id='.$idpres.'&d='.$dtres.'&a='.$rou['id_act'].'" data-toggle="modal" data-target="#myModal">

                                            <div class="Notification__highlight">
                                                <p class="Notification__highlight-excerpt"><b>'.$gfhy['titre'].'</b></p>
                                                <p class="Notification__highlight-time">'.$gfhy2['nom']." ".$gfhy2['prenom'].'</p>
                                            </div>
                                        </a>

                                    </li>

                                ';

                                }


                                ?>


                                </ul>
                                   <div class="dropdown-footer"><a href="all.php" target="_blank">Afficher Tous</a></div>

                            </ul>
                            <!--/ dropdown -->
                        </li>


                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                                    <span class="hidden-sm hidden-xs"><?php
                                    $qq = mysql_query('SELECT p.prenom,p.nom FROM personne p WHERE p.id_pers="'.$_SESSION['id'].'"')or die(mysql_error());
                                    $rr = mysql_fetch_assoc($qq);
                                    echo $rr['prenom']." ".$rr['nom'];

                                    ?></span>
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">


                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i>Se deconnecter</a></li>
                            </ul>
                        </li>


                    </ul>
                    <!--notification end-->
                      <?php

                         }else if($role == "resp_activite"){
                         echo'<ul class="nav navbar-nav navbar-right">

                            <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                                    <span class="hidden-sm hidden-xs">';

                                    $qq = mysql_query('SELECT p.prenom,p.nom FROM personne p WHERE p.id_pers="'.$_SESSION['id'].'"')or die(mysql_error());
                                    $rr = mysql_fetch_assoc($qq);
                                    echo $rr['prenom']." ".$rr['nom'];

                                    echo'</span>
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">


                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Se deconnecter</a></li>
                            </ul>
                        </li>


                    </ul>';











                         }















                     ?>
                </div>

            </header>
            <!--header end-->

            <!--sidebar start-->
            <aside id="aside" class="ui-aside ui-aside--dark">
          <!-- <aside id="aside" class="ui-aside"> -->

                <ul class="nav" ui-nav>

                   <?php

                    include 'nav.php';

                    ?>


                </ul>
            </aside>
<!--Bootstrap Modal -->
<div class="modal fade" id="myModal">
     <div class="modal-dialog">
        <div class="modal-content">
            <strong>Loading...</strong>
        </div>
    </div>
</div>

<script>
$( document ).ready(function() {
    $('#myModal').on('hidden.bs.modal', function () {
          $(this).removeData('bs.modal');
    });
});
</script>
            <!--sidebar end-->
<div id="content" class="ui-content">
<div class="ui-content-body">
<div class="ui-containery">








