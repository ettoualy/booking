<link href="org/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="org/dist/css/main.css" rel="stylesheet">
<?php

function checkUser($email)
{

	
	$query = mysql_query("SELECT * FROM compte WHERE email = '$email'") or die (mysql_error());

	if(mysql_num_rows($query) > 0)
	{
		return 'true';
	}else
	{
		return 'false';
	}
}

function UserID($email)
{


	$query = mysql_query("SELECT * FROM compte WHERE email = '$email'") or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	
	return $row['id_pers'];
}


function generateRandomString($length = 20) {
	// This function has taken from stackoverflow.com
    
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return md5($randomString);
   }



function send_mail($to, $token)
{


	$subject = 'Password Recovery Instruction';
	$link = 'http://localhost/yp/forget.php?email='.$to.'&token='.$token;
    $headers = "From: younes.ettoualyy@gmail.com \r\n";
    $headers .= "Reply-To: ". $to . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    @$body .= "<b style='color: #407DBF'>Reset Password</b><br><br>You have requested for your password recovery.
    <a href='$link' target='_blank'>Click here</a> to reset your password.";


    if(mail($to,$subject,$body,$headers)){
        return "success";
    }else{
        return "fail";

}
}

function verifytoken($userID, $token)
{

	$query = mysql_query("SELECT * FROM compte WHERE id_pers = $userID AND token = '$token'") or die (mysql_error());
	$row = mysql_fetch_assoc($query);

	if(mysql_num_rows($query) > 0)
	{
			return 1;

	}else
	{
		return 0;
	}

}
?>