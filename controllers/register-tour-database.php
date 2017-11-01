<?php
session_start();
include("../pages/conn.php");
include("../lib/Validation.php");
include("../lib/Tour.php");
include("../lib/User.php");
include("../lib/Annoucement.php");


  
$name = mysqli_real_escape_string(connect(), $_POST['name-tour']);		

$description = mysqli_real_escape_string(connect(), $_POST['description-tour']);

$departure_place = mysqli_real_escape_string(connect(), $_POST['departure-place']);

$date = mysqli_real_escape_string(connect(), $_POST['date-tour']); 

$hour = mysqli_real_escape_string(connect(), $_POST['departure-hour']);		

$duration = mysqli_real_escape_string(connect(), $_POST['duration-tour']);

$price = mysqli_real_escape_string(connect(), $_POST['price']);		

$id_user = $_SESSION['id-user'];
	
$is_correct = true; echo "Hora: ".$hour;

$error = Validation::tour($name,$description, $departure_place, $date, $hour, $duration, $price);


if($error!='') $is_correct = false;
   
  if($is_correct == true){
	
	
	$date = new DateTime($date." ".$hour.":00"); 
	$date = $date->format("Y-m-d H:i:s"); echo $date; 	
	
	$_SESSION['id-tour'] = Tour::insertTour($name,$description, $departure_place, $date, $hour, $duration, $price, $id_user);
	
	$_SESSION['id-annoucement'] = Annoucement::insertAnnoucement($_SESSION['id-tour'], $id_user);	   
	
	echo "Id Tour: ".$_SESSION['id-tour']."<br>"; 
	
    header("Location: ../pages/register-tab-client.php");
	
	echo "Dados correctos.";		

}else{ 
	
     header("Location: ../pages/register-tab-tour.php"); 
	
	echo "O registo tem erros.";
	
}
  
 ?>