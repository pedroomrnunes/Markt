<?php

class ComissionVendor{

/* private $tour = array();
private $id, $iso, $name, $nicename, $iso3, $numcode, $phonecode; */





public static function getComissions(){
	
	$conn = connect();
	
	$query = "SELECT id_comission_vendor, percentage, value, bonus, received, id_user, id_receipt  FROM comission_vendor";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$comissions = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
     echo   $row["id_comission_vendor"]." ".$row["value"]." ".$row["bonus"]." ".$row["received"]." ".$row["id_user"]." ".$row["id_receipt "];
	 
	 $comissions["id_comission_vendor"] = $row["id_comission_vendor"];
	 $comissions["percentage"] = $row["percentage"];
	 $comissions["value"] = $row["value"];
	 $comissions["bonus"] = $row["bonus"];
	 $comissions["received"] = $row["received"];
	 $comissions["id_user"] = $row["id_user"];
	 $comissions["id_receipt"] = $row["id_receipt"];
    }	
	mysqli_close($conn);
	
	return $comissions;	
}

public static function getComissionById($id){
	
	$conn = connect();
	
	$query = "SELECT id_comission_vendor, value, bonus, received, id_user  FROM comission_vendor WHERE id_comission_vendor ='{$id}' LIMIT 1";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$comissions = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
   
	 $comissions["id_comission_vendor"] = $row["id_comission_vendor"];
	 $comissions["value"] = $row["value"];
	 $comissions["bonus"] = $row["bonus"];
	 $comissions["received"] = $row["received"];
	 $comissions["id_user"] = $row["id_user"];	 
    }	
	mysqli_close($conn);
	
	return $comissions;
}

public static function getComissionsByUser($id){
	
	$conn = connect();
	
	$query = "SELECT id_comission_vendor, value, bonus, received, id_user, id_receipt  FROM comission_vendor WHERE id_user ='{$id}'";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $comissions = array();
	$count = 0;
	while ($row = mysqli_fetch_assoc($result)) {		
   //  echo   $row["id_comission_vendor"]." ".$row["value"]." ".$row["bonus"]." ".$row["received"]." ".$row["id_user"]." ".$row["id_receipt "];
	 
	 $comissions[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $comissions[$count]["value"] = $row["value"];
	 $comissions[$count]["bonus"] = $row["bonus"];
	 $comissions[$count]["received"] = $row["received"];
	 $comissions[$count]["id_user"] = $row["id_user"];	 
     $count++;
	}	
	mysqli_close($conn);
	
	return $comissions;	
}

public static function insertComission($percentage, $bonus, $value,  $id_user){

	$conn = connect();
		
	$query = "INSERT INTO comission_vendor ( percentage, value, bonus,  id_user)
				VALUES ('{$percentage}', '{$value}', '{$bonus}', '{$id_user}')";  
		  	
	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id comission vendor ".$id."<br>";
	
	echo "Comissão vendor guardada.<br>";
	
	mysqli_close($conn);
	
	return $id;
}
 
public static function insertComissionComplete($percentage, $bonus, $value,  $received, $id_user, $id_receipt){

	$conn = connect();
		
	$query = "INSERT INTO comission_vendor ( percentage, value, bonus, received, id_user, id_receipt)
				VALUES ('{$percentage}', '{$value}', '{$bonus}',  '{$received}', '{$id_user}', '{$id_receipt}')";  
		  	
	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id comission vendor ".$id."<br>";
	
	echo "Comissão vendor guardada.";
	
	mysqli_close($conn);
	
	return $id;
}

public static function getValueTotalByUser($id){
	
	$comissions = self::getComissionsByUser($id);
	
	$count = 0;
	$arrayTotal = count($comissions);
	$valueTotal=0;
	
	while($count!=$arrayTotal){
		$valueTotal += $comissions[$count]['value'];

		$count++;
	}
	
	return $valueTotal;
}



}
?>