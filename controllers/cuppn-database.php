<?php 

if(isset($_POST['submit'])){
    $cuppon =  mysqli_real_escape_string(connect(), $_POST['cuppon']);  if(checkCuppon($cuppon_name)==false){ $cuppon=0; }  header("Location: ../pages/login.php"); 
  echo "Cuppon";
}
		
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
?>