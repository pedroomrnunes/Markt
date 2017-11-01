<?php
session_start();
include("../pages/conn.php");
include("../lib/User.php");
include("../lib/ResetPassword.php");
include ( "../lib/Email.php");
$correct_email = true;
$email = isset($_POST['email-recovery']) ? mysqli_real_escape_string(connect(), $_POST['email-recovery']) : null;
$_SESSION['email']= $email;


$user = User::getUserByEmail($email);

echo "email: ".$email."<br>";

$correct_email =  User::existEmail($email);


if($correct_email==false || $_POST['email-recovery']==''){ 

   $_SESSION['error'] ="Insira um email valido";

    
	  header("Location: ../pages/recoverPassword.php");   

}else{
	
   if(User::desactivateUser($user['id'])){       

     $salt = "15498#2D83B631%3800EBD!801600D*7E3CC12";
      
     $tokenpwr = hash('sha512', $salt.$email);
     $tokenemail = hash('sha512', $salt.$email); 
	 $tokenurl = "http://localhost/markt/pages/reset-password.php?q=".$tokenpwr."&e=".$tokenemail;
	 
     ResetPassword::insertTokens($tokenpwr,$tokenemail);
	$name = $user['name'];
	 $message =  Email::message($name,"RECOVER_PASSWORD",$tokenurl);          
	 Email::sendEmail("pedroomrnunes@gmail.com","Recuperação de Password",$message);
	 
	 $user = User::getUserByEmail($email);	
	 
	 

	 
	$_SESSION['sucess'] = "recovery-password";           	
	 header("Location: ../pages/login.php");   
	 
	 echo "<br>Token password: ".$tokenpwr." Token email: ".$tokenemail;    	
	
	 echo "<br><br><a href='". $tokenurl."'>Link de Confiramção </a><br><br>";
	 echo "A chave da sua palavra-chave foi enviada pra o seu endereço de email.";
   }
}
?>