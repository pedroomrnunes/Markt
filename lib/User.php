<?php

class User{

public static function getUserByEmail($email){

	$conn = connect();

	$query = "SELECT id_user, name, password, id_country_code, phone, id_verification_user, phone, points, email_paypal, balance, mode, timecreated
	       FROM user WHERE email='{$email}' LIMIT 1" ;

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$user = array();

	while ($row = mysqli_fetch_assoc($result)) {

	// echo $row["name"]." ".$row["password"]." ".$row["id_country_code"]." ".$row["phone"]." ".$row["facebook"]." ".$row["id_verification_user"];

	   $user["id"] = $row["id_user"];

	   $user["name"] = $row["name"];

	   $user["password"] = $row["password"];

	   $user["id_country_code"] = $row["id_country_code"];

	   $user["phone"] = $row["phone"];

	   $user["id_verification_user"] = $row["id_verification_user"];

	   $user["phone"] = $row["phone"];

	   $user["points"] = $row["points"];

	   $user["balance"] = $row["balance"];

	   $user["mode"] = $row["mode"];

	   $user["timecreated"] = $row["timecreated"];
	}

	mysqli_close($conn);

	return $user;
}

public static function getUserById($id){

	$conn = connect();

	$query = "SELECT name, email, password, id_country, id_country_code,  phone, id_verification_user, points, email_paypal, balance,mode,timecreated
	       FROM user WHERE id_user='{$id}' LIMIT 1" ;


    $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$user = array();

	while ($row = mysqli_fetch_assoc($result)) {

   	 $user["name"] = $row["name"];

	 $user["email"] = $row["email"];

	 $user["password"] = $row["password"];
	 $user["id_country"] = $row["id_country"];
	 $user["id_country_code"] = $row["id_country_code"];

	 $user["phone"] = $row["phone"];

	 $user["id_verification_user"] = $row["id_verification_user"];

	 $user["points"] = $row["points"];

	 $user["email_paypal"] = $row["email_paypal"];

	 $user["balance"] = $row["balance"];

	 $user["mode"] = $row["mode"];

	 $user["timecreated"] = $row["timecreated"];

	}

	mysqli_close($conn);

	return $user;
}

public static function getUsers(){

	$conn = connect();

	$query = "SELECT id_user, name, email,  id_country_code, phone, id_verification_user, phone, points, email_paypal, balance, mode, timecreated  FROM user" ;

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	$users = array();
	$count = 0;
	while ($row = mysqli_fetch_assoc($result)) {

      //  echo $row["name"]." ".$row["password"]." ".$row["id_country_code"]." ".$row["phone"]." ".$row["id_verification_user"].'<br>';
	    $users[$count]["id"] = $row["id_user"];
	   $users[$count]["name"] = $row["name"];
	   	   $users[$count]["email"] = $row["email"];

	   $users[$count]["id_country_code"] = $row["id_country_code"];

	   $users[$count]["phone"] = $row["phone"];

	   $users[$count]["id_verification_user"] = $row["id_verification_user"];

	   $users[$count]["points"] = $row["points"];

	   $users[$count]["email_paypal"] = $row["email_paypal"];
	   $users[$count]["timecreated"] = $row["timecreated"];
	   $users[$count]["balance"] = $row["balance"];
    $count++;
	}

	mysqli_close($conn);

	return $users;
}

public static function getMode($id_user){

	$conn = connect();

	$query = "SELECT mode FROM user WHERE email = '{$id_user}' LIMIT 1";

	$is_g_user = false;

	$result = mysqli_query($conn,$query) or die ("didn't query".mysql_error());

    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

	$row = mysqli_fetch_assoc($result);


    return $row['mode'];
}



public static function insertUser($email, $password_register, $name_register, $id_country_code, $phone_register, $id_country, $email_paypal){

    $conn = connect();

	$options = [
    'cost' => 12,  'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
	];

	$password_register = password_hash( $password_register, PASSWORD_BCRYPT, $options);

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );  $now = $now->format("Y-m-d H:i:s");

    $query = "INSERT INTO user (email, password, name, id_country_code, phone, id_country,   email_paypal, mode, timecreated)
		VALUES (  '{$email}', '{$password_register}',   '{$name_register}',   '{$id_country_code}',   '{$phone_register}',   '{$id_country}',
		'{$email_paypal}', 'email' , '{$now}')";

	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));


	echo "Registo guardado.";

	mysqli_close($conn);
}

public static function insertGUser($email, $name,  $id_country, $id_verification_user ){


	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );  $now = $now->format("Y-m-d H:i:s");

	$conn = connect();


	$query = "INSERT INTO `user` (email, name, id_country,  id_verification_user,  active, mode, timecreated)
		VALUES ( '{$email}',  '{$name}',  '{$id_country}',  {$id_verification_user},  1, 'google', '{$now}' )";


	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	$id = mysqli_insert_id($conn);

	//  echo "Registo guardado.";

	mysqli_close($conn);
	return $id;
}

public static function insertFBUser( $email,  $name,   $id_country_code, $id_verification_user ){

	$conn = connect();

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );  $now = $now->format("Y-m-d H:i:s");

	$query = "INSERT INTO `user` (email, name, id_country_code, id_country_code, id_verification_user, active, mode, timecreated  )
		VALUES ( '{$email}',  '{$name}',  '{$id_country_code}', {$id_verification_user}, 1, 'facebook', '{$now}' )";


	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$id = mysqli_insert_id($conn);

	echo "Registo guardado.";

	mysqli_close($conn);

	return $id;
}

function insertVerification($email){

	$conn = connect();

	$id = getIdUser($email);

	$query = "INSERT INTO `verification_user` (id_user)
		VALUES ('{$id}')";

	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	echo "Registo guardado.";

	mysqli_close($conn);
}


public function updateUser( $id, $name,  $id_country,  $email_paypal){
	$conn = connect();
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );   $now = $now->format("Y-m-d H-i-s");
	$query = "UPDATE user SET name = '{$name}',id_country = '{$id_country}',  email_paypal='{$email_paypal}', timemodified='{$now}'
	WHERE  id_user = '{$id}' ";



	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$user = array();

    if (!$result){
		echo 'Could not run query: ' . mysql_error();
        exit;
	}

	echo "Utilizador actualizado.";

	mysqli_close($conn);
}

public static function updatePassword($id,$password){

	$conn = connect();

	$options = [
    'cost' => 12,  'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
	];

	$password = password_hash($password, PASSWORD_BCRYPT, $options);

	$query = "UPDATE user SET password = '{$password}'
	 WHERE 	id_user = '{$id}' ";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	if (!$result) {
	    echo 'Could not run query: ' . mysql_error();
        exit;
	}

	echo "Password alterada.";

	mysqli_close($conn);

	return true;
}

public static function updateIdVerification($id,    $id_verification_user){

	$conn = connect();

	$query = "UPDATE user SET  id_verification_user = {$id_verification_user}	 WHERE   id_user = '{$id}' ";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
        exit;
    }

	echo "Id verificação actualizado.";

	mysqli_close($conn);

	return true;
}


public static function updatePhoneNumber($id, $phonenumber){

	$conn = connect();

	$query = "UPDATE user SET  phone = '{$phonenumber}'	 WHERE   id_user = '{$id}' ";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
        exit;
    }

	echo "Número de telemovel actualizado actualizado.";

	mysqli_close($conn);

	return true;
}

public static function updateBalance($id, $value){

	$conn = connect();

	$query = "UPDATE user SET  balance = '{$value}'	 WHERE   id_user = '{$id}' ";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
        exit;
    }

	 echo "Saldo actualizado.";

	mysqli_close($conn);

	return true;
}

 public static function updatePoints($id, $points ){

	$conn = connect();
	$user = SELF::getUserById($id); $actual_points = $user['points']; $points = $actual_points + $points;
	$query = "UPDATE user SET  points = {$points}	 WHERE   id_user = '{$id}' ";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
        exit;
    }

	echo "Foram adicionados ".$points." ao utilizador com Id: ".$id;

	mysqli_close($conn);

	return true;
}



 public static function activateUser($id){

	$conn = connect();

	$query = "UPDATE user SET active=1 	 WHERE      id_user = '{$id}'";

	//run query
	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	//validate if query run correctly
    if (!$result) {
		echo 'Could not run query: ' . mysql_error();
        exit;
    }

	echo "Utilizador activo.";

	mysqli_close($conn);

	return true;
}

public static function desactivateUser($id){

	$conn = connect();

	$query = "UPDATE user SET active = 0 	 WHERE 	id_user = '{$id}' ";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	if (!$result) {
	    echo 'Could not run query: ' . mysql_error();
        exit;
	}

	echo "O utilizador foi desactivado.";

	mysqli_close($conn);

	return true;
}



public function existPhone($country_code, $phone){

    $conn = connect();


	$existPhone = false;

	$query = "SELECT phone FROM user WHERE phone = '{$phone}' LIMIT 1";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysql_error($conn));

    if (!$result) {
        echo 'Could not run query: ' . mysql_error($conn);
        exit;
    }

	$row = mysqli_fetch_assoc($result);

	if(($country_code.$row['phone'])==$phone){

	    $existPhone = true;

	}else{

		$existPhone = false;
	}
	return $existPhone;
}

public static function existEmail($email){

	$conn = connect();

	$query = "SELECT email FROM user WHERE email = '{$email}' LIMIT 1";

     $result = mysqli_query($conn,$query) or die ("didn't query".mysql_error($conn));

    if (!$result) {
	    echo 'Could not run query: ' . mysql_error($conn);
        exit;
    }

	$row = mysqli_fetch_assoc($result);

	if($row['email']==$email){

		mysqli_close($conn);

		return true;

	}else{

		mysqli_close($conn);

		return false;
	}
}

public static function checkLogin($email,$password){

	$conn = connect();

	$query = "SELECT password FROM user WHERE email = '{$email}' LIMIT 1";

	$result = mysqli_query($conn,$query) or die ("didn't query".mysql_error());

    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }

	$row = mysqli_fetch_assoc($result);

	if($password = password_verify($password,$row['password'])){

	    $query = "SELECT name FROM user WHERE email = '{$email}' LIMIT 1";


		$result = mysqli_query(connect(),$query) or die ("didn't query".mysql_error());

		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}

		return true;

    } else {

		return false;

    }
}

public static function activationLink($email){

   $salt = "15498#2D83B631%3800EBD!801600D*7E3CC12";

   $token = hash('sha512', $salt.$email);



   return $token;

}

public static function getToken( $id_user, $token){


}


/*
public static function checkCuppon($id,$name){
    $cuppon = getCupponByName($name);
    $id = $cuppon['id'];

	if(Cuppon::checkExpirationTime($date)==true){
	$usercuppons =  Cuppon:getUserCupponsByCuppon($name);


	}
	return true;
}*/


}
?>
