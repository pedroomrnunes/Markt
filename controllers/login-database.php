<?php
session_start();

include("../pages/conn.php");

$conn = connect();

$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if ($email !== null && $password !== null){

	$options = [    'cost' => 12, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];

    $hash =  password_hash($password, PASSWORD_BCRYPT, $options );

	$query = "SELECT id_user, name, password FROM user WHERE  email = '{$email}' and active = 1   LIMIT 1";


    $result = mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

    if (!$result) {
        echo 'Could not run query: ' . mysqli_error($conn);
        exit;
    }

	$row = mysqli_fetch_assoc($result);

	if(  password_verify($password, $row['password'] ) ){


		echo "correct";

		$_SESSION['id-user']=$row['id_user'];

		$_SESSION['name-user']=$row['name'];

		$_SESSION['email']= $email;

		mysqli_close($conn);

		echo "Id <br>"; var_dump($_SESSION['id-user']);
		if(isset($_SESSION['id-user'])){

	 		  header("Location: ../pages/welcome.php");

		}else{
		    $_SESSION['error']="A conta não está activa. Verifique a sua caixa de correio electrónico.";

	 	    header("Location: ../pages/login.php?error=login");
		}

    } else {

  		  $_SESSION['error']="login";

		  mysqli_close($conn);

	     header("Location: ../pages/login.php?error=login"); 
     }
}

?>
