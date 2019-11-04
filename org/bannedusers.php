
<?php
include "header.php";
?>
<?php
    $v = mysql_query("SELECT * FROM admin where bloque=1")or die(mysql_error());
    $n= mysql_num_rows($v);
    if($n > 0){

 echo'
   </br><div class="col-sm-16">

                 <section class="panel panel-default" style="box-shadow: 2px 4px 27px -5px #808080">
                    <header class="panel-heading" style="color: #32323A;font-family: \'Comic Sans MS\', cursive, sans-serif">Les utilisateurs bloqués :

                    </header>


                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Email</th>
                                                    <th>Nom d\'utilisateur</th>
                                                    <th>Mot de pass</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>   ';

  function role($a){
      if($a == 0){
          $b="simple user";
      }else if($a == 1){
          $b="Super Admin";
      }else if($a == 2){
          $b="Super moderator";
      }
      return $b;
   }
    $qq = mysql_query("SELECT * FROM admin where bloque=1 ORDER by id DESC")or die(mysql_error());
                 while ($rr = mysql_fetch_assoc($qq)) {
                     echo '<tr>';
                      echo '
                             <td>'.$rr['lname'].'</td>
                             <td>'.$rr['fname'].'</td>
                             <td>'.$rr['email'].'</td>
                             <td>'.$rr['username'].'</td>
                             <td>'.$rr['pwd'].'</td>
                             <td>'.role($rr['admin']).'</td>
                             <td>
                        <a href="debloquer.php?id='.$rr['id'].'" data-toggle="tooltip" data-placement="bottom" title="Debloquer"><i class="btn btn-primary glyphicon glyphicon-eye-open btn-xs"></i></a>
                             </td>
                           ';
                           echo '</tr>';

                }

                             echo'

                                            </tbody>
                                        </table>
                                    </div>
                                </section>

                       </div>  ';





 }
 else{
     echo'
                                      <div class="alert alert-info alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Il n\'y a aucun utilisateurs bloqués .</strong>
                                            <a href="users" class="alert-link" style="float: right;">&nbsp;Retour</a>
                                        </div>

     ';
 }

?>



 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>


<?php
include "footer.php";
?>