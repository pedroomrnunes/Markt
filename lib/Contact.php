<?php

class Contact{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;




public static function getContactById($id){
	$conn = connect();
	
	$query = "SELECT id_contact, name, email,  subject, message, timecreated FROM contact WHERE id_contact ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $contact = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $contact["id_contact"] = $row["id_contact"];
	 $contact["name"] = $row["name"];
	 $contact["email"] = $row["email"];
	 $contact["subject"] = $row["subject"];	
	 $contact["message"] = $row["message"];	 	 
	 $contact["timecreated"] = $row["timecreated"];	 	 
    }	
	mysqli_close($conn);
	
	return $contact; 	
}

public static function insertContact($name,$email, $message, $subject){
    $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
    $conn = connect();
	
	//run query
	$query = "INSERT INTO `contact` ( name , email , message, subject, timecreated )  VALUES ( '{$name}', '{$email}', '{$message}', '{$subject}' , '{$now}' )";  

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
}
?>