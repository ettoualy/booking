
<?php
include "header.php";
?>
   </br><div class="col-sm-16">

                 <section class="panel panel-default">
                    <header class="panel-heading" style="color: #32323A;font-family: 'Comic Sans MS', cursive, sans-serif">Les utilisateurs :

                    </header>


                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Email</th>
                                                    <th>Nom d'utilisateur</th>
                                                    <th>Mot de pass</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
 <?php
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
    $qq = mysql_query("SELECT * FROM admin where bloque=0 ORDER by id DESC")or die(mysql_error());
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
                        <a href="edite.php?id='.$rr['id'].'" data-toggle="tooltip" data-placement="bottom" title="Modifier"><i class="btn btn-success glyphicon glyphicon-pencil btn-xs"></i></a>
                        <a href="supp.php?id='.$rr['id'].'" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="btn btn-danger glyphicon glyphicon-trash btn-xs"></i></a>
                        <a href="bloquer.php?id='.$rr['id'].'" data-toggle="tooltip" data-placement="bottom" title="Bloquer"><i class="btn btn-warning glyphicon glyphicon-ban-circle btn-xs"></i></a>
                             </td>
                           ';
                           echo '</tr>';

     }

 ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </section>

                       </div>


 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>







<?php
include "footer.php";
?>