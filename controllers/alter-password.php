<?php
session_start(); include("../pages/conn.php");       $conn = connect();  include("../lib/User.php");  include("../lib/Validation.php"); 
$id = $_SESSION['id-user'];  $conn = connect();
$password = isset($_POST['password-profile']) ?     mysqli_real_escape_string($conn, $_POST['password-profile'] ) : null;
$newpwd = isset($_POST['new-password']) ? mysqli_real_escape_string($conn, $_POST['new-password'] )	 : null;
$cnewpwd = isset($_POST['confirm-new-password'])  ?    mysqli_real_escape_string($conn, $_POST['confirm-new-password']) : null;




$user = User::getUserById($id); var_dump($id);

$correct = true;

$correct = Validation::alterPassword($password,    $newpwd, $cnewpwd); 
mysqli_close($conn);
if($correct){
	 User::updatePassword($id,$newpwd);
     
	 echo "Nova password guardada.";	
	 
	 $_SESSION['sucess'] = "alter-password";  
	 
	  header("Location: ../pages/welcome.php"); 
}else{
	
	echo "Nao guardado.";
	
     	header("Location: ../pages/alter-password.php"); 
}

	
?>