<?php
session_start();

include("../pages/conn.php");
include("../lib/User.php");
include("../lib/Validation.php"); 
include ( "../lib/Email.php");
include("../lib/ResetPassword.php");
$conn = connect();


$email = mysqli_real_escape_string($conn, $_POST['email-register']);

$password_register =  isset($_POST['password-register']) ?  mysqli_real_escape_string($conn, $_POST['password-register']) : null;

$cpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword-register']);

$name = mysqli_real_escape_string($conn, $_POST['name-register']);		

if (isset($_POST['country-register'])) $id_country = $_POST['country-register'];		

if (isset($_POST['countrycode-register'])) $id_country_code = $_POST['countrycode-register'];		

$phone_register = mysqli_real_escape_string($conn, $_POST['phone-register']);

$facebook_register = mysqli_real_escape_string($conn, $_POST['facebook-register']);		

$vendor = $buyer = $privacy = null;

if (isset($_POST['privacy'])) $privacy = $_POST['privacy'];

if (isset($_POST['vendor-register'])) $vendor = $_POST['vendor-register'];     

if (isset($_POST['buyer-register'])) $buyer = $_POST['buyer-register'];

$email_paypal = mysqli_real_escape_string($conn, $_POST['paypal']);

$is_correct = true;	

$is_correct = Validation::user($email, $password_register, $cpassword,$name,$phone_register,$facebook_register,$vendor,$buyer, $privacy, $email_paypal );

$is_correct = true;	    


mysqli_close($conn);
 
if($is_correct == true){
	   
    $id = User::insertUser($email,  $password_register, $name, $id_country_code,  $phone_register, $id_country,  $email_paypal);  
     	 
	$token = User::activationLink($email);
	
	
	$tokenurl = "http://localhost/markt/controllers/reset-password.php?activation=".$token."&g=".$email;
	
	ResetPassword::insertActivationToken($token);
	
	$message =  Email::message($name,"ACTIVATION_ACCOUNT",$tokenurl);          
	
	
	Email::sendEmail("pedroomrnunes@gmail.com","Recuperação de Password",$message);
    
	$_SESSION['sucess'] = "register-user";           
	 
	$_SESSION['email'] = $email; 
	 
	header("Location: ../pages/login.php"); //  header("Location: ../pages/login.php");
	  
}else{	   	   
	   header("Location: ../pages/register-user.php"); 
	  // echo  "Session email: ".$_SESSION['error-register-email'];
}
 ?>