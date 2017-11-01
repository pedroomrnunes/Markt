<?php

class Client{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;





public static function getClientById($id){
	$conn = connect();
	
	$query = "SELECT id_client, name, phone,  language, country, timecreated FROM client WHERE id_client ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $client = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $client["id_client"] = $row["id_client"];
	 $client["name"] = $row["name"];
	 $client["phone"] = $row["phone"];
	 $client["language"] = $row["language"];	
	 $client["country"] = $row["country"];	 	 
	 $client["timecreated"] = $row["timecreated"];	 	 
    }	
	mysqli_close($conn);
	
	return $client; 	
}

public static function insertClient($name,$phone, $country, $language){
   $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
   
   $now = $now->format("Y-m-d H:i:s");
   $conn = connect();
	mysqli_query($conn, "set names 'utf8'"); 
	//run query
	$query = "INSERT INTO `client` ( name , phone , country, language, timecreated )  VALUES ( '{$name}', '{$phone}', '{$country}', '{$language}', '{$now}' )";  

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

function updateClient($id_client, $name, $email,    $phone       ){
	
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");      
	$query = "UPDATE client  SET  name = '{$name}' AND  email = '{$email}'  AND  phone = '{$phone}' AND timecreated = '{$now}'   WHERE 	id_tour = '{$id_client}' ";  
	// $query = "UPDATE tour  SET  id_client = 15  WHERE 	id_tour = 1 ";  
	
     //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){
		
	  echo "Upadate  cliente guardado. ";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
  }



 


}
?>