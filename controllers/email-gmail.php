<?php
    require("../vendor/phpmailer/autoload.php");
	
	try{
	  $mail = new PHPMailer\PHPMailer\PHPMailer(true);
	//  $mail = new PHPMailer();
       $mail->SMTPDebug = 4; 
       
	   
	   
	   $mail->Username = "pedroomrnunes@gmail.com"; // your GMail user name
       $mail->Password = "katemoss"; 
       
	   $mail->AddAddress("pedroomrnunes@gmail.com"); // recipients email
     //   $mail->From = $mail->Username; 
	   $mail->IsHTML(false); 	   
	   $mail->setFrom("pedroomrnunes@gmail.com");
	   
	   $mail->Subject = "Activation";
       $mail->Body    = "Here is the message you want to send to your friend."; 
  
    $mail->SMTPAuth = true;	
	$mail->SMTPSecure = 'tls';
      $mail->Host = "tls://smtp.gmail.com"; // GMail
      $mail->Port = 587;
     $mail->IsSMTP(); // use SMTP
       $mail->SMTPAutoTLS = false; 
	
  	if($mail->preSend()) echo "Sent."; else echo "Not sent.";	   
      if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
      else
        echo "Message has been sent";
	}catch( phpmailerException $e){
		$errors[] = $e->errorMessage();  echo $e->getMessage();  //Pretty error messages from PHPMailer
	}catch( Exception $e){
		 $errors[] = $e->getMessage(); echo $e->getMessage();
	}
?>
