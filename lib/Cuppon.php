<?php

class Cuppon{

private $cuppon = array();
private $id, $name,$token, $quantity, $value, $expiration_time;




public static function getCupponById($id){
	$conn = connect();
	
	$query = "SELECT  name,token,quantity, value, expiration_time FROM cuppon WHERE id_cuppon ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $cuppon = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $cuppon["name"] = $row["name"];
	 $cuppon["token"] = $row["token"];
	 $cuppon["quantity"] = $row["quantity"];
	 $cuppon["value"] = $row["value"];	 
	 $cuppon["expiration_time"] = $row["expiration_time"];
    }	
	mysqli_close($conn);
	
	return $cuppon; 	
}

public static function getCupponByName($name){
	$conn = connect();
	
	$query = "SELECT id_cuppon, name,token,quantity, value, expiration_time FROM cuppon WHERE name ='{$name}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $cuppon = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $cuppon["id"] = $row["id_cuppon"];
	 $cuppon["name"] = $row["name"];
	 $cuppon["token"] = $row["token"];
	 $cuppon["quantity"] = $row["quantity"];
	 $cuppon["value"] = $row["value"];	 
	 $cuppon["expiration_time"] = $row["expiration_time"];
    }	
	mysqli_close($conn);
	
	return $cuppon; 	
}

public static function getUserCupponsByUser($id){
	$conn = connect();
	
	$query = "SELECT  id_usercuppon, id_cuppon,  id_user, ntimes FROM usercuppon WHERE id_user ='{$id}' ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $cuppons = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $cuppons["id_usercuppon"] =  $row["id_usercuppon"];
	 $cuppons["id_cuppon"] = $row["id_cuppon"];
	 $cuppons["id_user"] = $row["id_user"];
	 $cuppons["ntimes"] = $row["ntimes"];
     echo "Id: ".$cuppons["id_usercuppon"]." Cuppon:".$cuppons["id_cuppon"]." User: ".$cuppons["id_user"]." N times: ".$cuppons["ntimes"]."<br>";
    }	
	mysqli_close($conn);
	
	return $cuppons; 	
}

public static function getUserCupponByCuppon($id){
	$conn = connect();
	
	$query = "SELECT id_usercuppon, id_cuppon,  id_user, ntimes  FROM usercuppon WHERE id_cuppon ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $cuppon = array();
	 while ($row = mysqli_fetch_assoc($result)) {
       $cuppon["id_user"] = $row["id_user"];
	   $cuppon["id_cuppon"] = $row["id_cuppon"];	   
	   $cuppon["ntimes"] = $row["ntimes"];
	   echo "User: ". $cuppon["id_user"]." Cuppon: ".$cuppon["id_cuppon"]." N times: ".$cuppon["ntimes"];
    }	
	mysqli_close($conn);
	
	return $cuppon; 	
}
public static function getUserCupponUnique($id_user, $id_cuppon){
	$conn = connect();
	
	$query = "SELECT id_usercuppon, id_cuppon,  id_user, ntimes  FROM usercuppon WHERE id_cuppon ='{$id_cuppon}' AND id_user = '{$id_user}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $usercuppon = array();
	 while ($row = mysqli_fetch_assoc($result)) {
       $usercuppon["id_user"] = $row["id_user"];
	   $usercuppon["id_cuppon"] = $row["id_cuppon"];	   
	   $usercuppon["ntimes"] = $row["ntimes"];
	   echo "User: ". $usercuppon["id_user"]." Cuppon: ".$usercuppon["id_cuppon"]." N times: ".$usercuppon["ntimes"];
    }	
	mysqli_close($conn);
	
	return $usercuppon;	
}

public static function insertCuppon($name,$token, $quantity, $value, $expiration_time){

    $conn = connect();
	
	//run query
	$query = "INSERT INTO `client` ( name,token,quantity, value, expiration_time )  VALUES ( '{$name}', '{$token}', '{$quantity}', '{$value}','{$expiration_time}' )";  

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

public static function insertUserCuppon(  $id_user, $id_cuppon, $ntimes){

    $conn = connect();
	
	//run query
	// $query = "INSERT INTO usercuppon (  id_user, , id_cuppon,  ntimes )  VALUES ( '{$id_user}','{$id_cuppon}','{$ntimes}' )";  
    $query = "INSERT INTO `usercuppon`( `id_user`, `id_cuppon`, `ntimes`) VALUES ('{$id_user}','{$id_cuppon}','{$ntimes}')";  
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

public static function checkExpirationTime($date){

    $today =  strtotime(date("Y-m-d")); $date = strtotime($date);    $subtract = $today - $date;
	
	$subtractDays = floor($subtract/(60*60*24));
	
	if($subtractDays>=0){  
	    echo "Dias: ".$subtractDays; 
		return true;
	}
	return false;
}

}
?>