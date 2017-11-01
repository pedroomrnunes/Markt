<?php
require('../Vendor/sms/SmsGateway.php');
class Gateway{

 public static function getSMSById($id){
	$conn = connect();
	
	$query = "SELECT id_sms, name, phonenumber, message, timecreated FROM sms WHERE id ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $gateway = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $gateway["id"] = $row["id_sms"];
	 $gateway["name"] = $row["name"];
	 $gateway["phonenumber"] = $row["phonenumber"];
	 $gateway["message"] = $row["message"];		 
	 $gateway["timecreated"] = $row["timecreated"];	 	 
    }	
	mysqli_close($conn);
	
	return $gateway; 	
}


 public static function insertSMS($name, $phonenumber, $message, $status){
   $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
   
   $now = $now->format("Y-m-d H:i:s");
   $conn = connect();
	mysqli_query($conn, "set names 'utf8'"); 
	//run query
	$query = "INSERT INTO sms ( name , phonenumber , message, status, timecreated )  VALUES ( '{$name}', '{$phonenumber}', '{$message}', '{$status}', '{$now}' )";  

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


 public static function sendSMS( $number, $message){
	
	$smsGateway = new SmsGateway('pedroomrnunes@gmail.com', 'katemoss');
	
	$deviceID = 64370;
	
	$options = [
		'send_at' => strtotime('+1 minutes'), // Send the message in 10 minutes
		'expires_at' => strtotime('+5 hour') // Cancel the message in 1 hour if the message is not yet sent
	];

    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);
	
	if($result['response'])
		return true;
	else
		return false;
 }

 public static  function smsReceipt($name, $comission, $email){
	
	$sms = "Caro ".$name.", o  FindTour efectuou o pagamento da sua comissão no valor de ".$comission."€ na sua conta Paypal
		por meio do endereço de email inserido".$email."/n Continue as boas vendas. Os melhores cumprimentos, /n Administração FindTour";
	
	
	return $sms;
	
}
 
 
 public static function smsVerification($codeverification){
	
    $sms = "FindTour \n  Código de verificação: ".$codeverification;	
	
	return $sms;
	
 }


}
?>