<?php

class FbAccount{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;





public static function getFbAccountById($id){
	
	
	$conn = connect();
	
	$query = "SELECT id, name, email, gender, country, photo, profile,  timecreated FROM fb_account WHERE id ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$fb_account = array();
	
	
	while ($row = mysqli_fetch_assoc($result)) {

      $fb_account["id"] = $row["id"];
	  $fb_account["name"] = $row["name"];
	  $fb_account["email"] = $row["email"];
	  $fb_account["gender"] = $row["gender"];
	  $fb_account["country"] = $row["country"];	
	  $fb_account["photo"] = $row["photo"];	 	 
	  $fb_account["profile"] = $row["profile"];	 	 
	  
	  $fb_account["timecreated"] = $row["timecreated"];	 	 
    
	}
	
	mysqli_close($conn);
	
	return $fb_account; 	
}



public static function getFbAccountByUserId($id){
	
	$conn = connect();	
	$query = "SELECT fb_account.id, fb_account.name, fb_account.email, fb_account.gender, fb_account.country, fb_account.photo,fb_account.profile,
	fb_account.timecreated ,                verification_user.id_verification_user  
	FROM   fb_account,  user,  verification_user  
	WHERE fb_account.id = verification_user.facebook     AND        verification_user.id_verification_user =  user.id_verification_user                    
	AND user.id_user='{$id}' LIMIT 1 ";
		
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$fb_account = array();
	

	while ($row = mysqli_fetch_assoc($result)) {

      $fb_account["id"] = $row["id"];
	  $fb_account["name"] = $row["name"];
	  $fb_account["email"] = $row["email"];
	  $fb_account["gender"] = $row["gender"];
	  $fb_account["country"] = $row["country"];	
	  $fb_account["photo"] = $row["photo"];	 	 	 
	  $fb_account["profile"] = $row["profile"];	 	 
	  $fb_account["timecreated"] = $row["timecreated"];	 	 
	  $fb_account["id_verification_user"] =    $row["id_verification_user"];
	}
	
	mysqli_close($conn);
	
	return $fb_account; 	
}

public static function insert($name,$email, $gender, $country, $photo, $profile){
   
   $conn = connect();
   
   
  $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
   
   $now = $now->format("Y-m-d H:i:s");
   
   mysqli_query($conn, "set names 'utf8'"); 
	
   $query = "INSERT INTO `fb_account` ( name , email , gender, country, photo, profile,  timecreated )  
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
	
	$query = "UPDATE fb_account  SET  name = '{$name}',  email = '{$email}', gender = '{$gender}',  country = '{$country}', photo ='{$photo}', profile = '{$profile}',  timecreated = '{$now}'  
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