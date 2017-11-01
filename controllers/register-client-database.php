<?php
session_start();
include("../pages/conn.php");
include("../lib/Tour.php");
include("../lib/Client.php");
include("../lib/Annoucement.php");
include("../lib/Validation.php");

  
  
    	
	$name = mysqli_real_escape_string(connect(), $_POST['name-client']);		
	$phone = mysqli_real_escape_string(connect(), $_POST['phone-client']);
	$country = mysqli_real_escape_string(connect(), $_POST['country-client']);
	$language = mysqli_real_escape_string(connect(), $_POST['language-client']);
	$phonecode = $_POST['country-code'];
	$is_correct = true;
    
	if(isset($_POST['previous'])){ header("Location: ../pages/register-tab-tour.php"); exit; }
	
	
	
	
// 	$is_correct =  validationLanguange($language);		
	$error = Validation::client($name, $country,    $phonecode , $phone, $language);
	if($error!='') $is_correct = false;
	
	$phone = $phonecode.' '.$phone; 
	
	if($is_correct == true){
	   
	   $_SESSION['id_client'] = Client::insertClient($name, $phone, $country, $language);	
	   Annoucement::updateClient($_SESSION['id-annoucement'], $_SESSION['id_client']);		
	   echo "Id client: ".$_SESSION['id_client'];
	   
	   // Insert Transaction User Tour Client 
	   header("Location: ../pages/register-tab-comissions.php");
	   
	   echo "Dados correctos.";
	   
    }else{ 
	  
	  header("Location: ../pages/register-tab-client.php");
	  echo "O registo tem erros.";
	}
  

 ?>