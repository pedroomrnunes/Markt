<?php
session_start();
include("../pages/conn.php"); 
include("../lib/Cuppon.php");
include("../lib/Tour.php"); 
include("../lib/Annoucement.php"); 
include("../lib/ComissionBuyer.php"); 
include("../lib/ComissionVendor.php"); 
include("../lib/ComissionMarkt.php");                                                      

$config = parse_ini_file('../config.ini');  

$percentage_total = $config['percentage_total']; 

$percentage_markt = $config['percentage_markt']; 

$id_tour = 7; $id_user = 63; $cuppon = 0; $points = 0;						

// $id_user = $_SESSION['id-user'];  $cuppon_name = mysqli_real_escape_string(connect(), $_POST['cuppon']); 
$id_user = $_SESSION['id-user'];

$id_tour = $_SESSION['id-tour']; 

$id_annoucement = $_SESSION['id-annoucement'];
// if(checkCuppon($cuppon_name)==false){ $cuppon=0; } 

$tour = Tour::getTourById($id_tour);
$price =  $tour['price'];

function checkCuppon($name){
  $cuppon = Cuppon::getCupponByName($name);
  $id_cuppon = $cuppon['id']; $date = $cuppon['expiration_time'];
  $id_user=1; 	
  echo "Data: ".$cuppon['expiration_time']."<br>";
  if(Cuppon::CheckExpirationTime($date)==false){  
     $cuppon =  Cuppon::getUserCupponUnique($id_user, $id_cuppon);
										
     if($cuppon['ntimes']<=1){
	    echo "O cupão é valido.<br>";																							
		return true;
	 }else{
         echo "O cupão já foi utiliado.<br>";
		 return false;
     }										 
  }else{
     echo "O cupão inserido já expirou.<br>";
	 return false;
   }
}
 

// echo   "Id tour: ".$id_tour."<br>"."Markt: ".$markt."<br>"." Angariador: ".$vendor."<br>"."Prestador de serviços: ".$buyer."<br>".$price;
if(isset($_POST['previous'])){
	header("Location: ../pages/register-tab-client.php");
	exit; 
}
$percentage_total = $config['percentage_total']/100;
$percentage_markt = $config['percentage_markt']/100; 
$percentage_vendor = 1 - $percentage_markt;

				

$total = $price * $percentage_total;
$cmarkt = $total * $percentage_markt;			
$cvendor = $total - $cmarkt + $cuppon;
$id_comission_buyer = ComissionBuyer::insertComission( $percentage_total*100, $total, $cuppon); echo " Id cbuyer: ".$id_comission_buyer;
$id_comission_vendor = ComissionVendor::insertComission($percentage_vendor*100, $cuppon, $cvendor,  $id_user); echo " Id cvendor: ".$id_comission_vendor;
$id_comission_markt = ComissionMarkt::insertComission($percentage_markt*100, $cmarkt ); echo " Id cmakrt: ".$id_comission_markt;
Annoucement::updateComissions($id_annoucement, $id_comission_buyer, $id_comission_vendor, $id_comission_markt);		
Annoucement::updateActive($id_annoucement);
header("Location: ../pages/register-tab-completed.php"); 
?>