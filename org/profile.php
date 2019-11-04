<style>
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}





</style>
<?php
include "header.php";
?>
    <?php
    $a = mysql_query('SELECT * FROM compte c,personne p WHERE p.id_pers="'.$_SESSION['id'].'" AND c.id_pers=p.id_pers') or die(mysql_error());
    $r= mysql_fetch_assoc($a);
    ?>

      <br>

        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="..." >
                <div class="btn-group" role="group">
                        <button type="button" id="stars" class="btn btn-primary"  href="#tab1" data-toggle="tab"><span class="fa fa-address-card-o" aria-hidden="true"></span>
                                <div class="hidden-xs">Informations Personnel</div>
                        </button>
                </div>

                <div class="btn-group" role="group">
                        <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <div class="hidden-xs">Compte</div>
                        </button>
                </div>
        </div>

                <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                     <table  style="width: 100%" class="table-hover general-table">
                      <tr style=" ">
                        <td style="width: 50%; padding-top: 1%;">Nom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td style="width: 50%; padding-top: 1%;"><?php echo $r['nom']; ?></td>
                      </tr>
                      <tr>
                        <td style="width: 50%; padding-top: 1%;">Prénom &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td style="width: 50%; padding-top: 1%;"><?php echo $r['prenom']; ?></td>
                      </tr>
                      <tr>
                        <td style="width: 50%; padding-top: 1%;">CIN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td style="width: 50%; padding-top: 1%;"><?php echo $r['cin']; ?></td>
                      </tr>
                      <tr>
                        <td style="width: 50%; padding-top: 1%;">E-mail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <td style="width: 50%; padding-top: 1%;"><?php echo $r['email']; ?></td>
                      </tr>


                  </table>

                </div>

                <div class="tab-pane fade in" id="tab3">

                <form class="form-inline" id="" method="post">
                     <div class="form-group">
                          <label >New UserName&nbsp;&nbsp;</label>
                          <input name="user" class="form-control"  placeholder="<?php echo $r['username'];   ?>" type="text">
                     </div>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-group">
                    <label >&nbsp;New Password&nbsp;&nbsp;</label>

                    <div class="input-group">
                        <input name="pass" id="password_show" type="password" class="form-control" placeholder="<?php echo $r['password'];   ?>">
                        <span style="width:0%" id="password_show_button" class="input-group-addon"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                    </div>

                </div>



                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" value="Update" id="actua" name="do" class="btn btn-default" style=" background: #005DCC; color: #FFFFFF" />

    	</form>
<?php

      if(isset($_POST['do'])){
      $username=$_POST['user'];
      $password=$_POST['pass'];

       $r=mysql_query("UPDATE compte set username='$username' , password='$password' WHERE id_pers='".$_SESSION['id']."'") or die(mysql_error());

               if($r){
               header('Refresh: 1;URL=profile.php');
               break;
                }


     }
 ?>

                </div>
            </div>
        </div>
















<?php
include "footer.php";
?>
<script>
$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below
    $(this).removeClass("btn-default").addClass("btn-primary");
});
});


                         $(document).ready(function(){
                            $("#password_show_button").mouseup(function(){
                                $("#password_show").attr("type", "password");
                            });
                            $("#password_show_button").mousedown(function(){
                                $("#password_show").attr("type", "text");
                            });
                        });


</script>