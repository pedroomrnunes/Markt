<?php
session_start(); 
include "../pages/conn.php";
include "../lib/FbAccount.php";
include "../lib/VerificationUser.php";
include "../lib/User.php";
 //   $userData = json_decode($_POST['userData']);	
  


$name = $_POST['name'];

$email = $_POST['email']; 

$gender = $_POST['gender'];

$country = $_POST['country'];

$photo = $_POST['photo']; 


$profile = $_POST['profile'];

$id  =   $_SESSION['id-user'];	  
$fb = FbAccount::getFbAccountByUserId($id);

 //  var_dump($fb);

 if($fb!=null && $fb!=0){  
	  FbAccount::update( $fb['id'], $name, $email, $gender, $country, $photo, $profile);

	header( "Location: ../pages/verification-user.php");
	  }else if($fb==null || $fb==0){
 
      //    echo "<br><br>".$name."<br>".$email."<br>".$gender."<br>".$country."<br>".$profile."<br>".  $photo."<br>";
    $facebookid = FbAccount::insert(  $name,$email, $gender, $country, $photo, $profile);
   
	 $verificationid = User::getUserById($id);
	 VerificationUser::updateFacebook( $id , $facebookid); 
   
     $points = 50;
     User::updatePoints($id, $points);

    
	$_SESSION['sucess'] = "A Verificação pelo Google foi efectudada com sucesso. Foram creditados ".$points." à sua conta";
	header( "Location: ../pages/welcome.php");
   }
	  
	  

?>