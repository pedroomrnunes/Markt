<?php
session_start(); 
include "../pages/conn.php";
include "../lib/FbAccount.php";
include "../lib/VerificationUser.php";
include "../lib/User.php";
 include "../lib/Country.php";
 //   $userData = json_decode($_POST['userData']);	
  



  
 
$name = isset( $_POST['name'] )  ? 	 $_POST['name'] : null;

$email = isset( $_POST['email'] ) ? $_POST['email']  : null;

$gender = isset( $_POST['gender'] ) ? $_POST['gender'] : null;

$country = isset( $_POST['country'] ) ? $_POST['country'] : null;

$photo = isset( $_POST['photo'] ) ?  $_POST['photo'] : null;
$profile = isset( $_POST['profile'] ) ? $_POST['profile'] : null;



if( $name != null && $email != null && $gender != null && $country != null && $photo != null && $profile != null ){ 
 
  $user = User::getUserByEmail($email);						

  if($user == null){
      
	/*  $country =  substr($country,3,5);
	 
	 $country = Country::getCountryByIso($country);
	 
	 $id_country_code = $country['id'];  */
	 
	 $id_verification_user =  VerificationUser::insertVerification();	    
  // echo "<br><br>".$email." ".$name." ".$id_country_code." ".$id_verification_user."<br><br>";
	 $id = User::insertFBUser( $email,  $name,  $country, $id_verification_user );

	 $points = 50;    

	 User::updatePoints($id, $points);  

     $fb = FbAccount::getFbAccountByUserId($id);

	 if($fb !=null){  
	  
		FbAccount::update( $fb['id'], $name, $email, $gender, $country, $photo, $profile );

     }else{
      
		$facebookid = FbAccount::insert(  $name, $email, $gender, $country, $photo, $profile );
     
		$verificationid = User::getUserById($id);

		VerificationUser::updateFacebook( $id , $facebookid );    
	}
		
		
	$_SESSION['sucess'] = "verification-fb"; 
	
	$_SESSION['id-user'] = $id;
	 
	$_SESSION['email'] = $email;
	 
	$_SESSION['name-user'] = $name;
	
	header( "Location: ../pages/welcome.php");
	
  }else{
	
	$_SESSION['id-user'] = $user['id'];
	
	$_SESSION['email'] = $email;
	
	$_SESSION['name-user'] = $user['name'];
	   header( "Location: ../pages/welcome.php");
  
  }
} 
 
   

   
   ?>