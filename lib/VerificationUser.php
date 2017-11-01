<?php

class VerificationUser{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;




public static function getVerifcationUserById($id){
	
	$conn = connect();
	
	$query = "SELECT id_verification_user, email, phone, facebook, google, timecreated, timemodified FROM verification_user WHERE id_verification_user ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $verification = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $verification["id_verification_user"] = $row["id_verification_user"];
	 $verification["email"] = $row["email"];
	 $verification["phone"] = $row["phone"];
	 $verification["facebook"] = $row["facebook"];	
	 $verification["google"] = $row["google"];	 	 
	 $verification["timecreated"] = $row["timecreated"];	 	 
	 $verification["timemodified"] = $row["timemodified"];	 	 
    }	
	mysqli_close($conn);
	
	return $client; 	
}

public static function getVerificationUserByIdUser($id){
	
	$conn = connect();
	
	$query = "SELECT verification_user.id_verification_user, verification_user.email, verification_user.phone, verification_user.facebook,
					verification_user.google, verification_user.timecreated, verification_user.timemodified 
			 FROM      verification_user            INNER JOIN   user     ON   verification_user.id_verification_user = user.id_verification_user
			 WHERE   user.id_user = {$id}";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $verification = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $verification["id_verification_user"] = $row["id_verification_user"];
	 $verification["email"] = $row["email"];
	 $verification["phone"] = $row["phone"];
	 $verification["facebook"] = $row["facebook"];	
	 $verification["google"] = $row["google"];	 	 
	 $verification["timecreated"] = $row["timecreated"];	 	 
	 $verification["timemodified"] = $row["timemodified"];	 	 
    }	
	mysqli_close($conn);
	
	return $verification;	
}


public static function insertVerification(){
   $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
   
   $now = $now->format("Y-m-d H:i:s");
   $conn = connect();
	mysqli_query($conn, "set names 'utf8'"); 
	//run query
	$query = "INSERT INTO verification_user ( email , timecreated)  VALUES ( 1 , '{$now}' )";  

	if(mysqli_query($conn, $query)){
		
	$id = mysqli_insert_id($conn);	
			
		echo "Registo Verificação guardado.";
	    return $id;	
     }else{
		 
		die ("didn't query".mysqli_error($conn));	 
	}
	mysqli_close($conn);
	
	return $id;
}

public static function insertVerificationComplete ( $id_user, $email,$phone, $google, $facebook){
   $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
   
   $now = $now->format("Y-m-d H:i:s");
   $conn = connect();
	mysqli_query($conn, "set names 'utf8'"); 
	//run query
	$query = "INSERT INTO verification_user ( email , phone , google, facebook, timecreated )  VALUES ( '{$email}', '{$phone}', '{$google}', '{$facebook}', '{$now}' )";  

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

public static function updateEmail($id_user){
	
	$conn = connect();
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");      
	
	$query = "UPDATE 
				verification_user v 
				INNER JOIN user u ON v.id_verification_user = u.id_verification_user 
			SET 
				v.email = 1, 
				v.timemodified = '{$now}' 
			WHERE 
				u.id_user = {$id_user} ";
				
	 if(mysqli_query($conn, $query)){
		
	  echo "Upadate  cliente guardado. ";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
  
}


public static function updatePhone($id_user, $phonenumber ){
	$conn = connect();
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");      
	$query = "UPDATE 
				verification_user v 
				INNER JOIN user u ON v.id_verification_user = u.id_verification_user 
			SET 
				v.phone = '{$phonenumber}', 
				v.timemodified = '{$now}' 
			WHERE 
				u.id_user = {$id_user} ";
	
	
    if(mysqli_query($conn, $query)){
		
	  echo "Número de telemovel guardado. ";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
  
}
// No RegisterUser, UpdateUser, LoginFB mode 
public static  function updateFacebook($id_user,    $facebook){
	$conn = connect();
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");      
	$query = "UPDATE 
				verification_user v 
				INNER JOIN user u ON v.id_verification_user = u.id_verification_user 
			SET 
				v.facebook = '{$facebook}', 
				v.timemodified = '{$now}' 
			WHERE 
				u.id_user = {$id_user} ";
				
	
    if(mysqli_query($conn, $query)){
		
	  echo "Upadate  cliente guardado. ";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
  
}

public static function updateGoogle($id_user, $google){
	
	$conn = connect();
	
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");      
	
	
	$query = "UPDATE 
				verification_user v 
				INNER JOIN user u ON v.id_verification_user = u.id_verification_user 
			SET 
				v.google = '{$google}', 
				v.timemodified = '{$now}' 
			WHERE 
				u.id_user = {$id_user} ";
	
	if(mysqli_query($conn, $query)){
		
	  echo "Upadate  cliente guardado. ";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
  
}

}



?>