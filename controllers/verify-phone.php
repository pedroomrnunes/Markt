<?php
session_start(); 

if(isset($_SESSION['id-user'])){  
	$id = $_SESSION['id-user']; 
}else{    $_SESSION['error'] = "Sessão não iniciada";   
         header("Location: ../error.php");    
}


include("../pages/conn.php");  
include("../lib/User.php"); 
include("../lib/Validation.php");
include("../lib/PhoneCode.php");
include("../lib/Gateway.php");
include("../lib/VerificationUser.php");
$con = connect();
$sent = 0;
if(isset($_POST['countrycode']) && isset($_POST['phonenumber'])   ){
	$countrycode  = isset($_POST['countrycode'])  ?      $_POST['countrycode']     : null;  
	$phonenumber = isset($_POST['phonenumber']) ?   mysqli_real_escape_string($con, $_POST['phonenumber'] )  : null; 

	$correct = true;

	$error = Validation::validationPhone($phonenumber) ;

	if($error==''){

		$correct = true; 

	}else{ 
		$correct = false;
		$_SESSION['error-sent'] = $error; 

	}


	$user = User::getUserById($id); 

	if($user != null && $correct){

		$name = $user['name']; 

		$status = "send";

		$phonenumber = $countrycode.$phonenumber;

		$code = PhoneCode::generateCode();

		$expire = new DateTime("now", new DateTimeZone('Europe/Lisbon') ); //  $expire = $expire->format("Y-m-d H:i:s");
	/*
		$hour = $now->format("H:i"); 

		$hourexpire = $hour+5;
		if($hourexpire>24)
			$hourexpire = $hourexpire - 24;
	*/
	 	 
		$expire->add(new DateInterval('PT5H'));
		 $expire = $expire->format("Y-m-d H:i:s"); $message = Gateway::smsVerification($code); echo "Expire date: ".$expire;

		PhoneCode::insertPhoneCode( $code,  $expire, $id  ); 

		$sent =  Gateway::sendSMS( $phonenumber, $message);

  
		if($sent){
			Gateway::insertSMS($name, $phonenumber, $message, $status);
		
	        User::updatePhoneNumber($id, $phonenumber);
	
		   $_SESSION['sucess'] = "sms-sent";
	
	
	 	   header("Location: ../pages/verification-user.php");    
	
		}else{
			echo "A SMS não foi enviada.";
		}
   
	}else{
		echo "A Sessão nao foi iniciada.";
	
	}

}

if(isset($_POST['code']) ){
	$code = $_POST['code'];
	$phonecode = PhoneCode::getRecentCodeByIdUser($id);
    
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') ); 
	
	$expired = $phonecode['expire']; $expired = new DateTime($expired, new DateTimeZone('Europe/Lisbon'));
	
	if($now > $expired ){ 
	
	    $_SESSION['error-code'] = "O código de verificação expirou após 5 horas do envio da mensagem via SMS."; 
	     header("Location: ../pages/verification-user.php");    	
	}else{ 
	
	    if( $code ==  $phonecode['code']){
			$user = User::getUserById($id);
			VerificationUser::updatePhone($id,      $user['phone'] );
			User::updatePoints($id,50);
			$_SESSION['sucess'] = "verification-phone" ;
		 	header("Location: ../pages/welcome.php");    			
		 }else{
			 $_SESSION['error-code'] = "O código de verificação inserido não é valido." ;
			  header("Location: ../pages/verification-user.php");    
		 }
	}
	
}else{
	$_SESSION['error-code'] = "Insira um código de verificação valido." ;
}



mysqli_close($con);
?>