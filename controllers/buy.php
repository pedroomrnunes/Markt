<?php
session_start();
include("../pages/conn.php");
include("../lib/User.php");
include("../lib/Annoucement.php");
include("../lib/ComissionBuyer.php"); 
include("../lib/Transaction.php"); 


									
$id_annoucement = 1; $id_buyer = 1;  // SESSION
$annoucement = Annoucement::getAnnoucementById($id_annoucement);
 
$id_vendor = $annoucement['id_user'];
 
$comissionbuyerid = $annoucement['id_comission_buyer']; 
$comissionbuyer = ComissionBuyer::getComissionById($comissionbuyerid);
 
 
 $price = $comissionbuyer['value'];
 
 
 Transaction::insertTransaction($id_annoucement, $id_buyer,$id_vendor); 
 ComissionBuyer::updateComission($comissionbuyerid); 
 echo  "Anuncio Id: ".$id_annoucement. " Id Buyer: ".$id_buyer." Id Vendor: ".$id_vendor;
?>