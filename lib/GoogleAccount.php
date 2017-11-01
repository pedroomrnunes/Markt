<?php

class GoogleAccount{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;





public static function getGoogleAccountById($id){
	
	
	$conn = connect();
	
	$query = "SELECT id, name, email, gender, country, photo, profile,  timecreated FROM g_account WHERE id ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$g_account = array();
	
	
	while ($row = mysqli_fetch_assoc($result)) {

      $g_account["id"] = $row["id"];
	  $g_account["name"] = $row["name"];
	  $g_account["email"] = $row["email"];
	  $g_account["gender"] = $row["gender"];
	  $g_account["country"] = $row["country"];	
	  $g_account["photo"] = $row["photo"];	 	 
	  $g_account["profile"] = $row["profile"];	 	 
	  
	  $g_account["timecreated"] = $row["timecreated"];	 	 
    
	}
	
	mysqli_close($conn);
	
	return $g_account; 	
}



public static function getgAccountByUserId($id){
	
	$conn = connect();	
	$query = "SELECT g_account.id, g_account.name, g_account.email, g_account.gender, g_account.country, g_account.photo,g_account.profile,
	g_account.timecreated ,                verification_user.id_verification_user  
	FROM   g_account,  user,  verification_user  
	WHERE g_account.id = verification_user.google      AND        verification_user.id_verification_user =  user.id_verification_user                    
	AND user.id_user='{$id}' LIMIT 1 ";
		
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$g_account = array();
	

	while ($row = mysqli_fetch_assoc($result)) {

      $g_account["id"] = $row["id"];
	  $g_account["name"] = $row["name"];
	  $g_account["email"] = $row["email"];
	  $g_account["gender"] = $row["gender"];
	  $g_account["country"] = $row["country"];	
	  $g_account["photo"] = $row["photo"];	 	 	 
	  $g_account["profile"] = $row["profile"];	 	 
	  $g_account["timecreated"] = $row["timecreated"];	 	 
	  $g_account["id_verification_user"] =    $row["id_verification_user"];
	}
	
	mysqli_close($conn);
	
	return $g_account; 	
}

public static function insert($name,$email, $gender, $country, $photo, $profile){
   
   $conn = connect();
   
   
  $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
   
   $now = $now->format("Y-m-d H:i:s");
   
   mysqli_query($conn, "set names 'utf8'"); 
	
   $query = "INSERT INTO `g_account` ( name , email , gender, country, photo, profile,  timecreated )  
   VALUES ( '{$name}', '{$email}', '{$gender}', '{$country}', '{$photo}', '{$profile}',  '{$now}' )";  

   if(mysqli_query($conn, $query)){
		
	  $id = mysqli_insert_id($conn);	
			
	  echo "Registo conta facebook guardado.";
		
	  return $id;	
		
   }else{
		 
	   die ("didn't query".mysqli_error($conn));	 
	
	}
	
	mysqli_close($conn);
	
	return $id;
}

public static function update($id, $name, $email, $gender, $country, $photo, $profile ){
	
	$conn = connect();
	
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");      
	
	$query = "UPDATE g_account  SET  name = '{$name}',  email = '{$email}', gender = '{$gender}',  country = '{$country}', photo ='{$photo}', profile = '{$profile}',  timecreated = '{$now}'  
	WHERE 	id = '{$id}' ";  
	
	
    if(mysqli_query($conn, $query)){
		
	  echo "Conta Facebook actualizada.";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
}



 
}
?>