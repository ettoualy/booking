<?php
  include 'header.php';
?>
<style>
/* calendar */
table.calendar		{ border-left:1px solid #999;width : 100%;  }
tr.calendar-row	{  height : 85px;}
td.calendar-row-day{
     height : 80px;
}

td.calendar-day	{
                  min-height:120px;
                  font-size:11px;
                  position:relative;
                  }
* html div.calendar-day { height:80px; }
td.calendar-day:hover	{ background:#eceff5; }
td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
div.day-number	{

padding:5px;
color:#000;
font-weight:bold;

margin:-5px -5px 0 0;
text-align:center;
 }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
</style>
<?php

/* draws a calendar */
function draw_calendar_activ($month,$year){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
	$calendar.= '<tr class="calendar-row-day"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++){
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
            $ddate = $year."-".$month."-".sprintf("%02d", $list_day);
            $newdatabal = sprintf("%02d", $list_day);
            $qq = mysql_query("SELECT * FROM reserver WHERE date_deb LIKE('$ddate%')")or die(mysql_error());

            if(mysql_num_rows($qq) >0){
                $newblabla = $ddate."<br>
                <a href='afres.php?y=".$year."&m=".$month."&d=".$newdatabal."' target='_blank' style='color: #302C87; text-decoration: none'> Il y'a : ".mysql_num_rows($qq).' reservation(s)</a>';
            }else{
                $newblabla = $ddate."<br>no reservations";
            }
			$calendar.= '<div class="day-number">

            '.$newblabla;

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);

		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;


	}

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';

	/* all done, return result */
	return $calendar;


}

function draw_calendar_re($month,$year){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
	$calendar.= '<tr class="calendar-row-day"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++){
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
            $ddate = $year."-".$month."-".sprintf("%02d", $list_day);
            $newdatabal = sprintf("%02d", $list_day);
            $qq = mysql_query("SELECT r.id_local FROM reserver r,affectation_typel a WHERE r.date_deb LIKE('$ddate%') and r.id_local=a.id_local and a.id_type=1")or die(mysql_error());

            if(mysql_num_rows($qq) >0){
                $newblabla = $ddate."<br>
                <a href='afres.php?y=".$year."&m=".$month."&d=".$newdatabal."' target='_blank' style='color: #302C87; text-decoration: none'> Il y'a : ".mysql_num_rows($qq).' reservation(s)</a>';
            }else{
                $newblabla = $ddate."<br>no reservations";
            }
			$calendar.= '<div class="day-number">

            '.$newblabla;

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);

		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;


	}

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';

	/* all done, return result */
	return $calendar;


}


function draw_calendar_conf($month,$year){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
	$calendar.= '<tr class="calendar-row-day"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++){
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
            $ddate = $year."-".$month."-".sprintf("%02d", $list_day);
            $newdatabal = sprintf("%02d", $list_day);
            $qq = mysql_query("SELECT r.id_local FROM reserver r,affectation_typel a WHERE r.date_deb LIKE('$ddate%') and r.id_local=a.id_local and a.id_type=2")or die(mysql_error());

            if(mysql_num_rows($qq) >0){
                $newblabla = $ddate."<br>
                <a href='afres.php?y=".$year."&m=".$month."&d=".$newdatabal."' target='_blank' style='color: #302C87; text-decoration: none'> Il y'a : ".mysql_num_rows($qq).' reservation(s)</a>';
            }else{
                $newblabla = $ddate."<br>no reservations";
            }
			$calendar.= '<div class="day-number">

            '.$newblabla;

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);

		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;


	}

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';

	/* all done, return result */
	return $calendar;


}


if($role == "resp_activite"){
$month = date('m');
$year = date('Y');
echo '<h3>&nbsp;&nbsp;'.date("F Y").'</h3>';
echo draw_calendar_activ($month,$year);
 }else if($role == "resp_val_re"){
 $month = date('m');
$year = date('Y');
echo '<h3>&nbsp;&nbsp;'.date("F Y").'</h3>';
echo draw_calendar_re($month,$year);
 }else if($role == "resp_val_conf"){
 $month = date('m');
$year = date('Y');
echo '<h3>&nbsp;&nbsp;'.date("F Y").'</h3>';
echo draw_calendar_conf($month,$year);
 }
?>

<br>  <br>
<table style="width : 80%">

    <tr style="width : 90%">
            <td style="width : 20%;"></td>
            <td style="width : 7%;">&nbsp;&nbsp;<label class=" control-label">Du :</label></td>
            <td style="width : 21%"><input  id="datep1" class="form-control js-datepicker" type="text" placeholder="mm/dd/yyyy"></td>
            <td style="width : 6%">&nbsp;&nbsp;&nbsp;<label class=" control-label">Au &nbsp;:</label></td>
            <td style="width : 30%"><div class="input-group" style="width : 98%"><input  id="datep2" class="form-control js-datepicker" type="text" placeholder="mm/dd/yyyy"> <span class="input-group-btn" ><button  id="validerr" class="btn btn-primary">Rechercher!</button> </span></div></td>
           </td>

    </tr>
</table><br><br>





<div id="re"></div>

<script>
$(document).ready(function(){
$('#validerr').click(function(){
    var dat1 = $('#datep1').val();
    var dat2 = $('#datep2').val();


if (dat1 == "" | dat2 == ""){
    alert('please select dates');
}else{

 $.ajax({
     type:'GET',
     url:'ajax/blabla.php?d1='+btoa(dat1)+"&d2="+btoa(dat2),
     success:function(data){
       $("#re").html(data).show();
    }
 });
}

});



});

</script>

<?php
  include 'footer.php';
?>