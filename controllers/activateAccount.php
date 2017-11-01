<?php
session_start();

include("../pages/conn.php");
include("../lib/User.php");

  $salt = "15498#2D83B631%3800EBD!801600D*7E3CC12";
   $password = hash('sha512', $salt.$email);
	$pwrurl = "../pages/activateAccount.php?q=".$password;   
	
   
    $message =  Email::message($name,"ACTIVATION_ACCOUNT",$pwrurl);
    Email::sendEmail("pedroomrnunes@gmail.com","Activação de conta",$message);
    	
	echo "<a href='". $pwrurl."'>Link de activação</a>";
	echo "Your password recovery key has been sent to your e-mail address.";
	






?>