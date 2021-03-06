<link rel="stylesheet" href="dist/css/lightbox.min.css">
<script src="dist/js/lightbox-plus-jquery.min.js"></script>
<style>
.card {
  padding-top: 20px;
  margin: 10px 0 20px 0;
  background-color: #ffffff;
  border: 1px solid #d8d8d8;
  border-top-width: 0;
  border-bottom-width: 2px;
  -webkit-border-radius: 3px;
     -moz-border-radius: 3px;
          border-radius: 3px;
  -webkit-box-shadow: none;
     -moz-box-shadow: none;
          box-shadow: none;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}


.card.hovercard {
  position: relative;
  width: 300px;
  padding-top: 0;
  overflow: hidden;
  text-align: center;
  background-color: #fff;
}

.card.hovercard img {
  width: 300px;
  height: 200px;
}

.card.hovercard .avatar {
  position: relative;
  top: -40px;
  margin-bottom: -40px;
}

.card.hovercard .avatar img {
  width: 80px;
  height: 80px;
  max-width: 80px;
  max-height: 80px;
  -webkit-border-radius: 50%;
     -moz-border-radius: 50%;
          border-radius: 50%;
}

.card.hovercard .info {
  padding: 4px 8px 10px;
}

.card.hovercard .info .title {
  margin-bottom: 4px;
  font-size: 24px;
  line-height: 1;
  color: #262626;
  vertical-align: middle;
}

.card.hovercard .info .desc {
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

.card.people .card-bottom {
  position: absolute;
  bottom: 0;
  left: 0;
  display: inline-block;
  width: 100%;
  padding: 10px 20px;
  line-height: 29px;
  text-align: center;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;


</style>

<?php

function box($title,$body){
    echo '
                               <div class="panel">
                                    <header class="panel-heading">
                                        '.$title.'

                                    </header>
                                    <div class="panel-body text-center">
                                        '.$body.'
                                    </div>
                                </div>
    ';
}

function nav_item($name,$icon,$url){
    echo '
                    <li>
                        <a href="'.$url.'"><i class="fa fa-'.$icon.'"></i><span> '.$name.' </span></a>
                        
                    </li>
    ';
}

function hall($title,$img,$content,$cap,$id){

 $rr=mysql_fetch_assoc($content);
 $v = implode(",",$rr);
 $eaeaea = str_replace(","," , ",$v);

     echo'
     <div class="col-md-4" style="margin-bottom : 20px;">

<div class="container">
<div class="card hovercard">
      <a class="example-image-link" href="'.$img.'" data-lightbox="example-1">
 <img src="'.$img.'" alt=""/> </a>
   <div class="avatar">
    <img style="border: 2px solid #D6CDFF;" src="'.$img.'" alt="" />
   </div>
   <div class="info">
      <div class="title">
        <a href="info.php?id='.$id.'"  style="text-decoration: none;"> '.$title.' </a>


      </div>
      <div class="desc"><b>Capacite :</b> '.$cap.' </div>
      <div class="desc"><b>Equipements :</b> '.$eaeaea.' </div>
   </div>

</div>
</div>
</div>';

}



?>


