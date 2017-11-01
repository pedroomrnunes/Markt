<?php 
session_start();

include("../pages/conn.php");
include("../lib/User.php"); 
include("../lib/ResetPassword.php");
include("../lib/Validation.php");
include("../lib/VerificationUser.php");
$con = connect();


    $password = isset($_POST['password-recovery']) ? mysqli_real_escape_string($con,$_POST['password-recovery']) : null;
	
	$cpassword = isset($_POST['cpassword-recovery']) ? mysqli_real_escape_string($con,$_POST['cpassword-recovery']) : null;
	
	$error = Validation::validationPassword($password);
	
	$error .= Validation::checkPassword($password, $cpassword);		 
	
	if($error=='') 
		$is_correct= true; 
	 else	
		 $is_correct = false;

if (isset($_GET["q"]) && isset($_GET["e"])) {
	
	$token_email =  mysqli_real_escape_string($con, $_GET["e"]);
	
	$token_password = mysqli_real_escape_string($con, $_GET["q"]);									  
	
	$email = $_SESSION['email'] ;   
	
	$rp = ResetPassword::getTokensActive($token_password, $token_email);
    
	echo "Email: ".$email;
	
    if($rp!=null && $password!=null && $is_correct){										     
		$user = User::getUserByEmail($email);
		$id = $user['id'];
		User::updatePassword($id,$password);
		User::activateUser($id);
	    				
	  
	    $_SESSION['sucess'] = "reset-password";
		header("Location: ../pages/login.php"); 
		// unset session email
	}else{
		$_SESSION['error'] = $error;
		 header("Location: ../pages/reset-password.php?q=".$token_password."&e=".$token_email); 
		var_dump($rp);   		 
	}									  									  									  
}


if (isset($_GET["activation"]) && isset($_GET["g"]) ){

	$token_password = mysqli_real_escape_string($con, $_GET["activation"]);

	$rp = ResetPassword::getTokenActivateAccount(   $token_password);
	
    if($rp!=null){										    
	
		
	  $email =  $_GET["g"];
		
	  $user = User::getUserByEmail($email);		
		
	 $id = $user['id'];
		
		
	  if(VerificationUser::getVerificationUserByIdUser($id) == null){
		
		$id_verification_user =  VerificationUser::insertVerification();	   
		User::updateIdVerification($id, $id_verification_user);				
		User::activateUser($id);
		
        $_SESSION['sucess'] = "activation-user";
       
	    header("Location: ../pages/login.php"); 
	    
	  }else{
		  $_SESSION['error'] = "A sua conta já está activa!";
		  
		  
		  header("Location: ../pages/error.php"); 
		  
		  echo "A conta já está activa.";
	  }
		 // unset session email
	}else{
		echo $token_password;
		$_SESSION['error'] = "Ocorreu um erro de autenticação.";
		header("Location: ../pages/error.php"); 
		var_dump($rp);   		 
	}
}
?>		