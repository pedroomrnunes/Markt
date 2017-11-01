<?php
session_start(); 
include("../pages/conn.php");  include("../lib/User.php"); include("../lib/Validation.php");
$con = connect();
$id = $_SESSION['id-user'];  $user = User::getUserById($id); $email = $user['email'];
$name = isset($_POST['name-update']) ?  mysqli_real_escape_string($con, $_POST['name-update'])      : null;
$id_country = isset($_POST['country-update']) ?      $_POST['country-update']      : null; 
$id_country_code = isset($_POST['countrycode-update']) ?  $_POST['countrycode-update']      : null;



$phone = isset($_POST['phone-update']) ?  mysqli_real_escape_string($con, $_POST['phone-update'])       : null;


$facebook = isset($_POST['facebook-update']) ?  mysqli_real_escape_string($con, $_POST['facebook-update'])       : null;
$email_paypal = isset($_POST['paypal-update']) ?  mysqli_real_escape_string($con, $_POST['paypal-update'])       : null;
$id_verification_user = '';
 
$is_correct = true;


  
 $is_correct = Validation::editUser( $name ,  $id_country, $phone,  $email_paypal);
  
   // getUser($email);
   if($is_correct == true ){
	   echo $id;  
	   User::updateUser($id, $name,  $id_country,    $phone, $email_paypal);
	   echo "Utilizador editado."; $_SESSION['sucess'] = "edit-user";   header("Location: ../pages/welcome.php"); 
   }else{	   
	   echo "Dados de utilizador nao carregados.";     header("Location: ../pages/update-user.php"); 
   
   } 

?>