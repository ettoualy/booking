<?php


if($role == "resp_activite"){
    nav_item ('Accueil','home','index.php');
    nav_item ('Profile','user-o','profile.php');
    nav_item ('Liste Des Salles','window-maximize','salles.php');
    nav_item ('Réserver une salle','calendar-plus-o','res.php');
    nav_item ('Mes reservations','list-alt','mesres.php');

}else if($role == "resp_val_re"){
    nav_item ('Accueil','home','index.php');
    nav_item ('Profile','user-o','profile.php');
    nav_item ('Liste Des Salles','window-maximize','salles.php');
    nav_item ('Ajouter une salle','building-o','addre.php');
    nav_item ('Réserver une salle','calendar-plus-o','res.php');
    nav_item ('Mes reservation','list-alt','mesres.php');
 }else if( $role == "resp_val_conf" ){
    nav_item ('Accueil','home','index.php');
    nav_item ('Profile','user-o','profile.php');
    nav_item ('Liste Des Salles','window-maximize','salles.php');
    nav_item ('Ajouter une salle','building-o','addconf.php');
    nav_item ('Réserver une salle','calendar-plus-o','res.php');
    nav_item ('Mes reservations','list-alt','mesres.php');

 } elseif($role == "admin"){
    nav_item ('List Des users','users','users.php');
    nav_item ('Add user','user-plus','adduser.php');
    nav_item ('Banned Users','user-times','bannedusers.php');

  }

?>