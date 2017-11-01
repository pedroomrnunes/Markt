<?php
session_start();
include("../pages/conn.php");
include("../lib/Email.php");
include("../lib/Client.php");
include("../lib/Annoucement.php");
include("../lib/Validation.php");

  
  
    $conn = connect();	
	$name = mysqli_real_escape_string($conn, $_POST['name']);		
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	
	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$message = mysqli_real_escape_string($conn, $_POST['message']);
	$is_correct = true;
    
	$address = "pedroomrnunes@gmail.com";
	
	
	
	
	$error = Validation::contacts($name, $email, $subject, $message);
	if($error!='') $is_correct = false;	
    mysqli_close($conn);
	if($is_correct == true){	   	   
	  //  $id = Contact::insertContact($name, $email, $subject, $message);		  
	    
		// SEND ME EMAIL OF THE CONTACT
	      $message = Email::message("Pedro","SEND_CONTACT",$message);		 
	      Email::sendEmail($address, $subject, $message);
	   // SEND USER EMAIL RECEIVED
	      $message = Email::message($name,"CONTACTS","");		 
		  Email::sendEmail($email, $subject, $message);

	   $_SESSION['sucess'] = "contacts";
	   header("Location: ../pages/welcome.php");
	   echo "Dados correctos.";	   
    }else{ 	  
	  header("Location: ../pages/support/contacts.php");
	  echo "O registo tem erros.";
	}	
 ?>