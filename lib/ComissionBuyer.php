<?php
class ComissionBuyer{

/* private $tour = array();
private $id, $iso, $name, $nicename, $iso3, $numcode, $phonecode; */






public function getComissions(){
	
	$conn = connect();
	
	$query = "SELECT id_comission_buyer,  percentage,bonus, value, payed, id_user  FROM comission_buyer";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$comissions = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
     echo   $row["id_comission_vendor"]." ".$row["value"]." ".$row["bonus"]." ".$row["payed"]." ".$row["id_user"]." ".$row["id_payment"];
	 
	 $comissions["id_comission_buyer"] = $row["id_comission_buyer"];
	 $comissions["percentage"] = $row["percentage"];
	 $comissions["bonus"] = $row["bonus"];
	 $comissions["value"] = $row["value"];
	 $comissions["payed"] = $row["payed"];
	 $comissions["id_user"] = $row["id_user"];
	 $comissions["id_payment"] = $row["id_payment"];        
	 
    }
	
	mysqli_close($conn);
	return $comissions;
}


public static function getComissionById($id){
	
	$conn = connect();
	
	$query = "SELECT id_comission_buyer, percentage  , value, bonus, payed, id_user  FROM comission_buyer WHERE id_comission_buyer = '{$id}'  ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$comission = array();	
	while ($row = mysqli_fetch_assoc($result)) {		
   // echo   $row["id_comission_buyer"]." ".$row["value"]." ".$row["bonus"]." ".$row["received"]." ".$row["id_user"]." ".$row["id_comission_markt "];
	 
	 $comission["id_comission_buyer"] = $row["id_comission_buyer"];
	 $comission["percentage"] = $row["percentage"];
	 $comission["value"] = $row["value"];
	 $comission["bonus"] = $row["bonus"];
	 $comission["payed"] = $row["payed"];
	 $comission["id_user"] = $row["id_user"];
	 //  $comissions["id_comission_markt"] = $row["id_comission_markt "];
    }
	
	mysqli_close($conn);
	
	return $comission;
}


public function insertComissionBuyer( $percentage, $value, $bonus, $payed, $id_user, $id_payment){

	$conn = connect();
		
	$query = "INSERT INTO comission_buyer (percentage,  value, bonus, payed, id_user, id_comission_markt)
				VALUES ( '{$percentage}' '{$value}', '{$bonus}',  '{$payed}', '{$id_user}', '{$id_payment}')";  
		  	
	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id comission buyer: ".$id."<br>";	
	echo "Comissão buyer guardada.";
	
	mysqli_close($conn);	
	return $id;
}

public static function insertComission( $percentage, $value, $bonus){

	$conn = connect();
		
	$query = "INSERT INTO comission_buyer (percentage,  value, bonus)
				VALUES ( '{$percentage}', '{$value}', '{$bonus}')";  
		  	
	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id comission buyer: ".$id."<br>";	
	echo "Comissão buyer guardada.<br>";
	
	mysqli_close($conn);	
	return $id;
}

}

?>