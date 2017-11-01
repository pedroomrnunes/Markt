<?php

class PhoneCode{

 public static function getRecentCodeByIdUser($id){
	$conn = connect();
	
	$query = "SELECT id_phonecode, code , expire , timecreated FROM phonecode WHERE id_user = {$id} ORDER BY timecreated DESC LIMIT 1";
	
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $phonecode = array();
	 
	 while ($row = mysqli_fetch_assoc($result)) {

     $phonecode["id"] = $row["id_phonecode"];
	 $phonecode["code"] = $row["code"];
	 $phonecode["expire"] = $row["expire"];	 
	 $phonecode["timecreated"] = $row["timecreated"];	 	 
     
	
	}	
	mysqli_close($conn);
	
	return $phonecode; 	
}


 public static function insertPhoneCode( $code, $expire   , $id_user   ) {
   $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') ); 
   
   $now = $now->format("Y-m-d H:i:s");
   $conn = connect();
	mysqli_query($conn, "set names 'utf8'"); 
	//run query
	$query = "INSERT INTO phonecode ( code , expire , id_user,  timecreated )  VALUES ( '{$code}', '{$expire}', '{$id_user}', '{$now}' )";  

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
public static function sendPhoneCode( $number, $message){
	
	$phonecodePhoneCode = new SmsPhoneCode('pedroomrnunes@gmail.com', 'katemoss');
	
	$deviceID = 64370;
	
	$options = [
		'send_at' => strtotime('+1 minutes'), // Send the message in 10 minutes
		'expires_at' => strtotime('+5 hour') // Cancel the message in 1 hour if the message is not yet sent
	];

    $result = $phonecodePhoneCode->sendMessageToNumber($number, $message, $deviceID, $options);
	
	if($result['response'])
		return true;
	else
		return false;
 }

 public static  function phonecodeReceipt($name, $comission, $email){
	
	$phonecode = "Caro ".$name.", o  FindTour efectuou o pagamento da sua comissão no valor de ".$comission."€ na sua conta Paypal
		por meio do endereço de email inserido".$email."/n Continue as boas vendas. Os melhores cumprimentos, /n Administração FindTour";
	
	
	return $phonecode;
	
}
 
 public static function phonecodeVerification($codeverification){
	
    $phonecode = "FindTour \n  Código de verificação: ".$codeverification;	
	
	return $phonecode;
	
 }

public static function generateCode(){
		
	$code = mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
	return $code;
}



public static function checkCode($code){
    
    $phonecode = SELF::getCodeByIdUser($id); 
    
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') ); 
	
	$now = $now->format("Y-m-d H:i:s");
	
	$expired = $phonecode['expired'];	
	
	
	
	if($phonecode['code'] && $expired == false){
		
		return true;
		
	}else{
		
		return false;
	
	}
}
}


?>