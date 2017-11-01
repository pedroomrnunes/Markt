<?php

class Comission{

/* private $tour = array();
private $id, $iso, $name, $nicename, $iso3, $numcode, $phonecode; */








public static function getPercentagesComission(){
	
 $comissions = array();
 $config = parse_ini_file('../config.ini');
 $comissions['total']  = $config['percentage_total'];
 $comissions['markt'] = $config['percentage_markt'];
 $comissions['bonus'] = $config['bonus'];	
  return $comissions;
}
/*
public function getPercentageTotal(){  	
	return $percentage_total;
}
public function getPercentageMarkt(){
	return $percentage_markt;
	
}
public function getPercentageVendor(){
	return 1-$percentage_markt;
}
*/

public static function getComissionVendor(){
	
	
}
public static function getPriceBuyer(){
	
	
}
public static function getComissionMarkt(){
	
	
}

}
?>