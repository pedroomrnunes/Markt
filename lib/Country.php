<?php

class Country{

private $country = array();
private $id, $iso, $name, $nicename, $iso3, $numcode, $phonecode;




public static function getCountries(){
	$conn = connect();
	
	$query = "SELECT id, iso, name, nicename, iso3, numcode, phonecode  FROM country ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	
	$user = array();
	$count = 0;
	while ($row = mysqli_fetch_assoc($result)) {		
    

  	//  echo $row["id"]." ".$row["iso"]." ".$row["name"]." ".$row["nicename"]." ".$row["iso"]." ".$row["numcode"]." ".$row["phonecode"];
	 
	 $countrys[$count]["id"] = $row["id"];
	 $countrys[$count]["iso"] = $row["iso"];
	 $countrys[$count]["name"] = $row["name"];
	 $countrys[$count]["nicename"] = $row["nicename"];
	 $countrys[$count]["iso"] = $row["iso"];
	 $countrys[$count]["numcode"] = $row["numcode"];
	 $countrys[$count]["phonecode"] = $row["phonecode"];
     $count++;
	}	
	mysqli_close($conn);
	
	return $countrys; 	
}

public function getCountryById($id){
	$conn = connect();
	
	$query = "SELECT id, iso, name, nicename, iso3, numcode, phonecode FROM country WHERE id ='{$id}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$country = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
     echo $row["id"]." ".$row["iso"]." ".$row["name"]." ".$row["nicename"]." ".$row["iso"]." ".$row["numcode"]." ".$row["phonecode"];
	 $country["id"] = $row["id"];
	 $country["iso"] = $row["iso"];
	 $country["name"] = $row["name"];
	 $country["nicename"] = $row["nicename"];
	 $country["iso"] = $row["iso"];
	 $country["numcode"] = $row["numcode"];
	 $country["phonecode"] = $row["phonecode"];
    }	
	mysqli_close($conn);
	
	return $country;	
}

public function getCountryByIso($iso){
	$conn = connect();
	
	$query = "SELECT id, iso, name, nicename, iso3, numcode, phonecode FROM country WHERE iso ='{$iso}' LIMIT 1 ";
	
	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	$country = array();
	
	while ($row = mysqli_fetch_assoc($result)) {		
    //  echo $row["id"]." ".$row["iso"]." ".$row["name"]." ".$row["nicename"]." ".$row["iso"]." ".$row["numcode"]." ".$row["phonecode"];
	 $country["id"] = $row["id"];
	 $country["iso"] = $row["iso"];
	 $country["name"] = $row["name"];
	 $country["nicename"] = $row["nicename"];
	 $country["iso"] = $row["iso"];
	 $country["numcode"] = $row["numcode"];
	 $country["phonecode"] = $row["phonecode"];
    }	
	mysqli_close($conn);
	
	return  $country;	
}
public function insertTour($name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user){

	$conn = connect();
		
	$query = "INSERT INTO `tour` (name_tour,description, date_tour, departure_place, duration, price, id_user)
		VALUES ('{$name}', '{$description}', STR_TO_DATE('{$date}','%d/%m/%Y'), '{$departure_place}', '{$duration}', '{$price}', '{$id_user}' )";  
		  	
	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	
	$id = mysqli_insert_id($conn);	
	echo "Id tour: ".$id."<br>";
	
	echo "Registo guardado.";
	
	mysqli_close($conn);
	
	return $id;
}



}


?>