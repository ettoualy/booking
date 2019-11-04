<?php

 $a=@mysql_connect('localhost','root','') or die('Erreur de connexion '.mysql_error());
 mysql_set_charset('utf8',$a);
 $b=@mysql_select_db('stage',$a) or die('Erreur de connexion '.mysql_error());

?>
