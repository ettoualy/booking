<?php include "header.php"; ?>
<style>
.image-preview-input {
    position: relative;
    overflow: hidden;
    margin: 0px;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.image-preview-input input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}

</style>
 <div class="col-md-12">
                                    <div class="panel">
                                        <header class="panel-heading">
                                            Ajouter salle de réunion :
                                            <span class="tools pull-right">
                                                <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                                <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="close-box fa fa-times" href="javascript:;"></a>
                                            </span>
                                        </header>
                                        <div class="panel-body">
                                        <form class="form-horizontal form-variance" enctype="multipart/form-data" method="post" >

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Intitulé</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" type="text" name="int">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Capacité</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control u-rounded" type="text" name="cap">
                                                    </div>
                                                </div>
                                               <div class="form-group">
                                                    <label for="tags_1" class="col-sm-3 control-label">Equipements</label>
                                                    <div class="col-sm-6">
                                                    <input class="form-control tags" id="tags_1" placeholder="" type="text" value="tableau,vidéo projecteur,climatisation" name="eq">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tags_1" class="col-sm-3 control-label">Image</label>
                                                    <div class="col-sm-6">
                                                                <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" name="fileToUpload"> <!-- rename it -->
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]-->


            </div>
            </div>
                 <center>
                 <input type="submit" class="btn btn-success" value="Ajouter" name="do">  &nbsp;&nbsp;
                 <button class="btn btn-danger"><a href="index.php" style="text-decoration: none">Annuler</a></button>

                 </center>

     </form>
     </div>


     <br>


  <?php



$target_dir = "imgs/";
$target_file = $target_dir . basename(@$_FILES["fileToUpload"]["name"]);
//echo $target_dir;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["do"])) {
    if($_POST['int'] != "" && $_POST['cap'] != "" && $_POST['eq'] != ""){
    $check = getimagesize(@$_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<div class='alert alert-warning'>File is not an image.</div>";
        $uploadOk = 0;
    }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "<div class='alert alert-warning'>Sorry, your image is too large.</div>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "JPEG" && $imageFileType != "jpeg" && $imageFileType != "jpg"
&& $imageFileType != "gif" ) {
    echo "<div class='alert alert-warning'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<div class='alert alert-danger'>Sorry, your image was not uploaded.</div>";
// if everything is ok, try to upload file
}else {
    if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $titre = mysql_real_escape_string($_POST['int']);
    $cap = mysql_real_escape_string($_POST['cap']);
    $e =mysql_real_escape_string($_POST['eq']);
    //echo $e;
    $tab = explode(",",$e);

    //print_r($tab);
    $img = 'imgs/'.basename($_FILES["fileToUpload"]["name"]);

    $q = mysql_query("
    INSERT INTO `local` (`capacite`, `intitule_local`, `img`) VALUES ('$cap', '$titre', '$img')")or die(mysql_error());

    $i = mysql_query("SELECT id_local FROM local WHERE id_local = (SELECT MAX(id_local) FROM local)") or die (mysql_error());
    $ii=mysql_fetch_assoc($i);
    $id=$ii['id_local'];
    $l = mysql_query("INSERT INTO `affectation_typel` (`id_local`, `id_type`) VALUES ('$id', 1) ") or die (mysql_error());

    foreach($tab as $val){
    $l = mysql_query("INSERT INTO `equipement` (`intitule_eq`, `id_local`) VALUES ('$val', '$id') ") or die (mysql_error());
    }

    if(isset($q) && isset($i) && isset($l)){
        echo '<div class="alert alert-success">Salle ajoutée avec succès</div>';
    }else{
       echo '<div class="alert alert-danger">Error </div>';
    }


        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
}
  }else{

            echo '<div class="alert alert-danger">Certains champs sont vide </div>';

    }
}




?>










</div>
 </div>



<script>
$(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        },
         function () {
           $('.image-preview').popover('hide');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});

</script>









<?php include "footer.php"; ?>