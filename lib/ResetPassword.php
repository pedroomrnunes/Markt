<?php

class ResetPassword{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;





public static function getTokenById($id){
	$conn = connect();
	
	$query = "SELECT token_password FROM reset_password WHERE id_rp ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $token_password = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $token_password["id_token_password"] = $row["id_token_password"];
	 $token_password["name"] = $row["name"];
	 $token_password["phone"] = $row["phone"];
	 $token_password["language"] = $row["language"];	
	 $token_password["country"] = $row["country"];	 	 
    }	
	mysqli_close($conn);
	
	return $token_password; 	
}


public static function getTokenEmailActive($token_email){
	$conn = connect();
	
	$query = "SELECT token_password FROM reset_password WHERE id_rp ='{$id}' AND active=1 LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $token_password = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $token_password["id_rp"] = $row["id_token_password"];
	 $token_password["token_password"] = $row["token_password"];	 
    }	
	mysqli_close($conn);	
	return $token_password; 	
}
public static function getTokensActive($token_password,$token_email){
	$conn = connect();	
	$query = "SELECT token_password, token_email FROM reset_password WHERE token_password ='{$token_password}' AND  token_email = '{$token_email}' AND active=1 LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $reset_password = array();
	 while ($row = mysqli_fetch_assoc($result)) {

	 $reset_password["token-email"] =  $row["token_email"];             
	 $reset_password['token-password'] = $row["token_password"];	 
    }	
	mysqli_close($conn);	
	return $reset_password;	
}


public static function insertTokens($token_password,$token_email){
    $id = null;

    $conn = connect();
	
	$query = "INSERT INTO `reset_password` ( token_password, token_email, active )  VALUES ( '{$token_password}', '{$token_email}', 1 )";  

	if(mysqli_query($conn, $query)){
		
	    $id = mysqli_insert_id($conn);	
		
		echo "O token_password ".$token_password."<br> usado pelo utilzador de id ".$token_email." foi inserido.<br>";
	    	
     }else{
		 
		die ("didn't query".mysqli_error($conn));	 
	}
	
	mysqli_close($conn);
	
	return $id;
}


public static function insertActivationToken($token_password){
    $id = null;

    $conn = connect();
	
	$query = "INSERT INTO `reset_password` ( token_password, active )  VALUES ( '{$token_password}', 1 )";  

	if(mysqli_query($conn, $query)){
		
	    $id = mysqli_insert_id($conn);	
		
		echo "O token_password ".$token_password."<br>  foi inserido.<br>";
	    	
     }else{
	
    	die ("didn't query".mysqli_error($conn));	 
	}
	
	mysqli_close($conn);
	
	
	return $id;
}


function desactivate($id_token_password, $token_email){
    $conn = connect();

	$query = "UPDATE reset_password  SET  id_token_password = '{$id_token_password}'  WHERE id_token_password = '{$id_token_password}' AND token_email = '{$token_email}' ";  	
    
	if(mysqli_query($conn, $query)){
		
	  echo "O token_password: ".$token_password." foi desactivado.";
		
    }else{
		 
	  die ("didn't query".mysqli_error($conn));
	}
	
	mysqli_close($conn);
 }

 public static function getTokenActivateAccount($token_password){

	$conn = connect();	

	$query = "SELECT token_password  FROM reset_password WHERE token_password = '{$token_password}' AND active=1 LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $reset_password = array();

	 while ($row = mysqli_fetch_assoc($result)) {
	 

	 $reset_password['token-password'] = $row["token_password"];	 

	 }	

    mysqli_close($conn);	

	return $reset_password;	
 }
 

public static function getDesencryptedHash($hash){
	
	
}

 


}
?>