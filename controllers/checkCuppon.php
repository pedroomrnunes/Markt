<?php    
include("../pages/conn.php"); 
include("../lib/User.php"); 
include("../lib/Cuppon.php");     
								  								
$cuppon = Cuppon::getCupponByName($name);
$id_cuppon = $cuppon['id']; $date = $cuppon['expiration_time'];
$id_user=1; 	


echo "Data: ".$cuppon['expiration_time']."<br>";



if(Cuppon::CheckExpirationTime($date)==false){ 									     
  
  $cuppon =  Cuppon::getUserCupponUnique($id_user, $id_cuppon);
  
  if($cuppon['ntimes']<=1){
    echo "O cupão é valido.<br>";																							
  }else{
    echo "O cupão já foi utiliado.<br>";
  }										 
}else{
    echo "O cupão inserido já expirou.<br>";
}
									
									
?>