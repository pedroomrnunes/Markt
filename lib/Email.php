<?php
require("../vendor/phpmailer/autoload.php");
class Email{

public static function getEmailById($id){

	$conn = connect();
	
	$query = "SELECT id_email, headers, email, subject, message FROM email WHERE id_email ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $email = array();

	 while ($row = mysqli_fetch_assoc($result)) {

       $email["id_email"] = $row["id_email"];
	   $email["headers"] = $row["headers"];
	   $email["email"] = $row["email"];
	   $email["subject"] = $row["subject"];	
	   $email["message"] = $row["message"];	 	 
    }
	
	mysqli_close($conn);
	
	return $email; 	
}

public static function insertEmail($headers,$email, $message, $subject){

    $conn = connect();
	
	$query = "INSERT INTO `email` ( headers , email , message, subject )  VALUES ( '{$headers}', '{$email}', '{$message}', '{$subject}' )";  

	if(mysqli_query($conn, $query)){
		
	$id = mysqli_insert_id($conn);	
			
		echo "Registo guardado.";
	
		return $id;	
		
     }else{
		 
		die ("didn't query".mysqli_error($conn));	 
	}
	mysqli_close($conn);
	
	return $id;
}



public static function sendEmail($address, $subject, $message){
	
  $config = parse_ini_file('../config.ini');
  $username = $config['email_username'];
  $password = $config['email_password'];
  $host = $config['email_host'];
  		
  try{
	  
	$mail = new PHPMailer\PHPMailer\PHPMailer(true);
	  $mail->Username = "pedroomrnunes@gmail.com";
    //    $mail->SMTPDebug = 4; 
       
    $mail->Username = $username;
    $mail->Password = $password;
       
     $mail->AddAddress($address); // recipients email
	 //   $mail->From = $mail->Username; 
    $mail->IsHTML(true); 	   
    
	$mail->setFrom($username);
	   
    $mail->Subject = $subject;
    
	$mail->Body    =  $message;
  
    $mail->SMTPAuth = true;	
	
	$mail->SMTPSecure = 'tls';
    
	$mail->Host = "tls://smtp.gmail.com"; // GMail
    
	$mail->Port = 587;
    
	$mail->IsSMTP(); // use SMTP
    
	$mail->SMTPAutoTLS = false; 
	
	if(!$mail->Send())
    
		echo "Mailer Error: " . $mail->ErrorInfo;
    
	else
    
		echo "Message has been sent";
   
  }catch( phpmailerException $e){
	
		$errors[] = $e->errorMessage();  echo $e->getMessage();  //Pretty error messages from PHPMailer
		
  }catch( Exception $e){
	  
		 $errors[] = $e->getMessage(); echo $e->getMessage();
  }
}
public static function loadingSetting(){
	$config = parse_ini_file('../pages/db.ini');
	$username = $config['email_username'];
	$password = $config['email_password'];
	$host = $config['email_host'];
	$formatedMessage = '';	
}

public static function message($name,$type,$content){
	
  $subject = '';
	
  $message = '';
	
  $tokenurl = $id_trasaction = $content;
  
 switch($type){
		
    case 'ACTIVATION_ACCOUNT' :  					
	     
		$message = "Caro, ".$name.",<br><br>
					 A sua conta foi   criada com sucesso no entanto precisa de activar a sua conta.
					   Clique no link de Confirmação: <br><br><a href='".$tokenurl."'>".$tokenurl."</a><br><br>Obrigado pelo seu registo <br><br>";				
		$message .= "Os melhores cumprimentos, <br> Administração FindTour";
		
		break;
	
	case 'BUY' :
		 
		 $message = "Caro ".$name.",<br><br>
				   A sua compra foi realizada com sucesso. A informação relativa do cliente relativa à compra realizada já está disponivel na sua Conta em
				   Perfil -> Minhas compras->Tour . Ver a compra com id: ".$id_trasaction;		
	     
		 $message .= "Obrigado pela sua compra.     Desejamos boas faturações. <br><br> Os melhores cumprimentos, <br> Administração FindTour";
	
	     break;
	
	case "SELL": 
		
		$message =  "Caro ".$name.",<br><br>
						 A sua venda foi realizada com sucesso. O anúncio com id: ".$id_trasaction." foi comprado. O pagamento será realizado após a confirmação
						 do Prestador de Serviços   da realização do Tour ou no caso de confirmação até 48 horas após data do Tour. <br>";
	
   	    $message .= " <br> Os melhores cumprimentos, <br> Administração FindTour";	
		
			
		break;	
		
	case "RECOVER_PASSWORD": 
		
		$message =  "Caro ".$name.",<br><br>
						 O Sistema no site detectou uma solictação de alteração de password. Click no link para recuperar a sua password.<br><br>"
						 .$tokenurl."<br><br>";
						 
	  	    $message .= " <br> Os melhores cumprimentos, <br> Administração FindTour";	
			break;	
    
	
	case "CONTACTS": 
		
		$message =  "Caro ".$name.",<br><br>
						 A sua messagem foi recebida.<br><br>";
						 
						 
	  	    $message .= " <br> Os melhores cumprimentos, <br> Administração FindTour";	
			break;
	
	case "SEND_CONTACT": 
		
		$message =  "O utilizador enviou este email.<br><br>"
						 .$content.
						 
	  	    $message .= "<br> <br> Os melhores cumprimentos, <br> Administração FindTour";	
			break;
	}
 
  return $message;
  
 
 
 }
}
?>