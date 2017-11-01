<?php


// include("../pages/conn.php");

function getCountrysIso(){
	$con = connect();
    // Get all countrys
	$query = "SELECT id,name,nicename, iso, phonecode FROM country ORDER BY id LIMIT 3";	

    //run query
	 $result = mysqli_query($con,$query) or die ("didn't query".mysql_error());
	 
    //validate if query run correctly
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
	
	$arrayCountrysIso = array() ;	
    
	//fetch row
	while($row = $result->fetch_array())
	{			
		$arrayCountrysIso[] = array("id" => $row['id'] , "nicename" => $row['nicename'] , "phonecode" => $row['phonecode']) ;				
	}
	 mysqli_close($conn);
	 return $arrayCountrysIso;
 }
 
 
 /*
  foreach(getCountrysIso() as $row){
	echo $row['id'] . " " . $row['name'];
	echo $row['id'] . " " . $row['phonecode'];
	echo "<br />";	
   } */
	
	
	
	
	
function getPhonecodeFromId($id){
	$con = connect();
    // Get all countrys
	$query = "SELECT phonecode FROM country  WHERE id={$id} LIMIT 1";	

    mysql_select_db("markt") or die (mysql_error());
    
    //run query
	 $result = mysqli_query($con,$query) or die ("didn't query".mysql_error());
	 
    //validate if query run correctly
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
	
	echo "<br />";
		
	$phonecode = 0;
	
    //fetch row
	$row = mysqli_fetch_assoc($result);
	$phonecode = $row['phonecode'];
	mysqli_close($conn);
	 return $phonecode;
 }
	
?>