<?php function connect(){


	$config = parse_ini_file('../db.ini');
	// print_r(parse_ini_file('../pages/db.ini'));

	$con = mysqli_connect("localhost",$config['username'],$config['password'],$config['db']);

	if(!$con){
        die("Failed to connect to Database");
    }
	mysqli_select_db($con,$config['db']) or die (mysql_error());
	return $con;
}

?>
