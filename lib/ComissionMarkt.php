<?php

class ComissionMarkt{

/* private $tour = array();
private $id, $iso, $name, $nicename, $iso3, $numcode, $phonecode; */





public static function getComissions(){
	
	$conn = connect();
	
	$query = "SELECT id_comission_markt, percentage value, received   FROM comission_markt";	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	$comissions = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
     echo   $row["id_comission_markt"]." ".$row["value"]." ".$row["received"];	 
	 $comissions["id_comission_markt"] = $row["id_comission_markt"];
	 $comissions["percentage"] = $row["percentage"];
	 $comissions["value"] = $row["value"];
	 $comissions["received"] = $row["received"];
    }	
	mysqli_close($conn);
	
	return $comissions;	
}

public static function getComissionMarktById($id){
	
	$conn = connect();
	
	$query = "SELECT id_comission_markt, percentage, value, received   FROM comission_markt WHERE id_comission_markt = '{$id}' ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$comission = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
     echo   $row["id_comission_markt"]." ".$row["value"]." ".$row["received"];
	 
	 $comission["id_comission_markt"] = $row["id_comission_markt"];
	 $comission["percentage"] = $row["percentage"];
	 $comission["value"] = $row["value"];
	 $comission["received"] = $row["received"];
    }	
	mysqli_close($conn);
	
	return $comission;
}
/*
public static function getComissionsMarktByUser($id){
	
	$conn = connect();

	$query = "SELECT id_comission_markt, value, received   FROM comission_markt WHERE id_user ="{$id}" LIMIT 1";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $comissions = array();
	$count++;
	while ($row = mysqli_fetch_assoc($result)) {		
     echo   $row["id_comission_markt"]." ".$row["value"]." ".$row["received"];
	 
	 $comissions[$count]["id_comission_markt"] = $row["id_comission_markt"];
	 $comissions[$count]["value"] = $row["value"];
	 $comissions[$count]["received"] = $row["received"];
	 $count++;
    }	
	mysqli_close($conn);
	
	return  $comissions;	
}
*/

public static function insertComissionComplete($percentage,  $value, $received, $id_receipt){

	$conn = connect();
		
	$query = "INSERT INTO comission_vendor ( percentage, value, received, id_receipt)
				VALUES ('{$percentage}', '{$value}', '{$received}', '{$id_receipt}')";  
		  	
	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id comission Markt ".$id."<br>";
	
	echo "Comissão Markt guardada.";
	
	mysqli_close($conn);
	
	return $id;
}

public static function insertComission($percentage,  $value){

	$conn = connect();
		
	$query = "INSERT INTO comission_markt ( percentage, value)
				VALUES ('{$percentage}', '{$value}')";  
		  		//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id comission markt: ".$id."<br>";
	
	echo "Comissão markt guardada.<br>";
	
	mysqli_close($conn);
	
	return $id;
}

}
?>