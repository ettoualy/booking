<?php
  include 'header.php';
?>
<script>
$(document).ready(function(){
$('#valider').click(function(){
    var dat1 = $('#datep1').val();
    var dat2 = $('#datep2').val();
    var tim1 = $('#timeformatExample1').val();
    var tim2 = $('#timeformatExample2').val();

if (dat1 == "" | dat2 == ""){
    alert('please select dates');
}else{

 $.ajax({
     type:'GET',
     url:'ajax/a_res.php?d1='+btoa(dat1)+"&t1="+btoa(tim1)+"&d2="+btoa(dat2)+"&t2="+btoa(tim2),
     success:function(data){
       $("#rez").html(data).show();
    }
 });
}

});



});

</script>
<br>
<table style="width : 100%">

  <tr style="width : 100%">
      <td style="width : 6%;">&nbsp;&nbsp;<label class=" control-label">Du :&nbsp;</label></td>
      <td style="width : 20%"><input  id="datep1" class="form-control js-datepicker" type="text" placeholder="mm/dd/yyyy"></td>
      <td style="width : 20%"><input id="timeformatExample1" type="text" class="form-control" /></td>
      <td style="width : 5%">&nbsp;&nbsp;&nbsp;<label class=" control-label">Au &nbsp;:</label></td>
      <td style="width : 20%"><input  id="datep2" class="form-control js-datepicker" type="text" placeholder="mm/dd/yyyy"></td>
      <td style="width : 40%" ><div class="input-group" style="width : 98%"><input id="timeformatExample2" type="text" class="form-control" />
      <span class="input-group-btn" ><button  id="valider" class="btn btn-info">Rechercher!</button> </span></div></td>

  </tr>
</table>
            <script>
                $(function() {
                    $('#timeformatExample1').timepicker({ 'timeFormat': 'H:i:s' });
                    $('#timeformatExample2').timepicker({ 'timeFormat': 'H:i:s' });
                });
            </script>




<div id="rez"></div>

<?php
/*
$source = '05/16/2017';
$date = new DateTime($source);
echo $date->format('Y/m/d')."<br>"; // 31.07.2012
echo $date->format('d-m-Y'); // 31-07-2012
*/
?>
<?php

  include 'footer.php';
?>