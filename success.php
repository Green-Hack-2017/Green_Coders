<?php

require_once 'dbconnect.php';
require 'PHPMailer/PHPMailerAutoload.php';

if(isset($_POST['submit'])) {
    if(isset($_POST['mediafile']))
    {
      $mediafile = $_POST['mediafile'];
    }
    else
    {
      $mediafile='';
    }
    $message = $_POST['message'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $state=$_POST['state'];
    $exactloc=$_POST['exactloc'];

    $complaint_id = rand(100000,999999);
    while(true){
    	$query = $DBcon->query("SELECT * FROM complaint WHERE complaint_id = '$complaint_id'");
    	if($query->num_rows==1){
    		$complaint_id = rand(100000,999999);
    	} else {
    		break;
    	}
    }

    $DBcon->query("INSERT INTO complaint(complaint_id, media, message, latitude, longitude,state, exactloc,progress) VALUES('$complaint_id', '$mediafile', '$message', '$latitude', '$longitude','$state','$exactloc', 'Not solved')");


$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'rksehara95@gmail.com';          // SMTP username
$mail->Password = 'ramkesh@9672'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to
$mail->setFrom('rksehara95@gmail.com', 'CodexWorld');
$mail->addAddress('rksehara95@gmail.com');   // Add a recipient


$mail->isHTML(true);  // Set email format to HTML

$bodyContent = $message;
$bodyContent.= '<br><p><b>Location:- </b></p><br>';
$bodyContent .= $exactloc;

$mail->Subject = 'Regarding Forest complaint';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

    
}

$DBcon->close();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maindiv">
      <div class="insidediv3">&nbsp;</div>
      <span class="thankyou"></span>
      <hr class="custhr">
      <a href="status.php"><button class="btn btn-success">Find your ticket status</button></a>
      <div class="insidediv3">&nbsp;</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('.thankyou').html("<b>Your complaint has been taken. Your complaint id is <u>"+ <?= @$complaint_id ?> +"</u>. You can check its status at any time.</b>")
    	
    		var cname = 'ticket';
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			var n=0;
			var ticket = "";
			for(var i = 0; i <ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					ticket = c.substring(name.length, c.length);
					//$('#tickets').text(c.substring(name.length, c.length));
					n=1;
					if(n==1){
					  break;
					}
					  //return c.substring(name.length, c.length);
				}
			}
			if(n==0){
				var cvalue = '<?= @$complaint_id ?>';
				var d = new Date();
				d.setTime(d.getTime() + (365*24*60*60*1000));
				var expires = "expires="+ d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
				//$('#tickets').text("N/A");
			} else {
				var cvalue2 = '<?= @$complaint_id ?>';
				var cvalue = ticket + ',' + cvalue2;
				var d = new Date();
				d.setTime(d.getTime() + (365*24*60*60*1000));
				var expires = "expires="+ d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}

    	});

    </script>
  </body>
</html>

