<?php

class Validation{

public static function validationEmail($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
   $error = '';
   
   if(preg_match($pattern, $email) == 1 ) {

        if(User::existEmail($email)){
			$error = "O endereço de email inserido já está registado.";			
		} 		
	}else{
		$error = "O endereço de email inserido não é valido";		
	}
	return $error;
	
}
public static function validationEmailContact($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
   $error = '';
   
   if(preg_match($pattern, $email) != 1 ) {
       
			$error = "O endereço de email inserido não é valido";		
		 	
   }
	return $error;	
}

public static function validationEmailPaypal($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
   $error = '';   
    return $error;
}



public static function validationPassword( $password_register ){
	
	$error = '';  
	
	if(!preg_match("#[A-Z]+#",$password_register)) {
        $error = "A palavra-passe tem de conter pelo menos um letra maiuscula!";
    }	
	if(!preg_match("#[0-9]+#",$password_register)) {
        $error = "A palavra-passe tem de conter pelo menos um número!";
    }    
    if(!preg_match("#[a-z]+#",$password_register)) {
        $error = "A palavra-passe tem de conter pelo menos um letra minuscula!";
    }
	if (strlen($password_register) < '8' || $password_register=='') {
        $error = "A palavra-passe deve conter pelo menos 8 caracteres!";				
    }
	return $error;
	
}
 
public  function validationName($name){
	  
	$error = '';
	if (strlen($name) <= '3') {
        $error = "O nome deve conter pelo menos 3 caracteres!";				
    }
	return $error;
}

public  function validationLanguage($language){
	  
	$error = '';
	if (strlen($language) <= '3') {
        $error = "Insira uma língua válida!";	
    }
	return $error;
}

public static function validationPhone($phone_register){
	$error = '';  
	if (strlen($phone_register) != '9') {
        $error = "Insira um número de telemovel valido";		
	}
	return $error;
}

public static function validationPhoneClient($phone_register){
	$error = '';  
	if (strlen($phone_register) <= '5') {
        $error = "Insira um número de telemovel valido";		
		
    }
	return $error;
} 

public static function validationFacebook($facebook_register){
	  
	$fbUrlCheck = '/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/';
	$secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/';
	$error = '';
	// $facebook_register = 'https://www.facebook.com/atomicpages/';
	
	if(preg_match($fbUrlCheck, $facebook_register) == 1 && preg_match($secondCheck, $facebook_register) == 0) {		
		echo "Url correcto.";
		return  $error;
	}else{
		$error = "O url inserido não é valido";		
		return $error;
	}
}

public static function checkPassword($password_register, $cpassword){
	$error = '';
	
	if($password_register !== $cpassword){
	  $error = "As senhas de autenticação inseridas não coincidem";	 	  
	}
	return $error;
} 

public static function validateTypeUser($vendor,$buyer){
	  $error = '';
	  if( $vendor != null || $buyer != null ){
		echo "Tipo de utilizador aceite.";
	  }else{
		$error = "Escolha uma das duas opções ou ambas.";						
	  } 
	  return $error;
}

public static function validatePrivacy($privacy){
	  $error = '';
	  
	  if(isset($privacy)){
		  echo "Termos e politica de privacidade aceites.";
	  }else{
		$error = "Os termos de Markt e a politica de privacidade não foram aceites";				
	  }
	  return $error;
}

public function validationDescription($description){
	$error = '';
	if (strlen($description) <= '120') {
        $error = "A descrição deve conter pelo menos 120 caracteres!";		
	}
	return $error;	
}

public function validationSubject($subject){
	$error = '';
	if (strlen($subject) <= '5') {
        $error = "O assunto tem que conter pelo menos 5 caracteres!";		
	}
	return $error;	
}

public function validationMenssage($menssage){
	$error = '';
	if (strlen($menssage) <= '50') {
        $error = "A mensagem tem que conter pelo menos 50 caracteres!";		
	}
	return $error;	
}

public function validationPrice($price){
	$error = '';
	if(!is_int($price)){
	  
	  if (strlen($price) <= 0) {
        $error = "Insira um preço acima dos 45€.";		
      }else if($price > 750 ){
		 $error = "Insira um preço válido!";
	  }				
	}
	/* if(intval($price)){
		$error = "Insira um número!"; 		
	} */
	return $error;
  }

public function validationLocal($local){
	  
	$error = '';
	if (strlen($local) <= '5') {
        $error = "Insira um local válido!";		
	}
	return $error;
}





public static function user($email, $password_register, $cpassword,$name,$phone_register,$facebook_register,$vendor,$buyer, $privacy, $email_paypal ){
	$_SESSION['error-register-email'] = Validation::validationEmail($email);
    $_SESSION['error-register-password'] = Validation::validationPassword($password_register);
	$_SESSION['error-register-cpassword'] = Validation::checkPassword($password_register,$cpassword);
	$_SESSION['error-register-name'] = Validation::validationName($name);
	$_SESSION['error-register-phone'] = Validation::validationPhone($phone_register);
	$_SESSION['error-register-facebook'] = Validation::validationFacebook($facebook_register);
	// $_SESSION['error-register-typeuser'] = Validation::validateTypeUser($vendor,$buyer);	
	$_SESSION['error-register-privacy'] = Validation::validatePrivacy($privacy);	
	//  $_SESSION['error-register-paypal'] = Validation::validationEmailPaypal($email_paypal);
	
	$error =   $_SESSION['error-register-email'].	$_SESSION['error-register-password'].$_SESSION['error-register-cpassword'].
	$_SESSION['error-register-name'].$_SESSION['error-register-phone'].	$_SESSION['error-register-facebook'].$_SESSION['error-register-privacy'];
	
	echo $error;
	if($error==''){ $error=true; }else{ 	$error=false; }
	return $error;
}
public static function tour($name,$description, $local, $data, $hora, $duration, $price  ){
		
	$_SESSION['error-register-name'] = SELF::validationName($name);
	$_SESSION['error-register-description'] = SELF::validationDescription($description);	
	$_SESSION['error-register-date'] =  $_SESSION['error-register-hour'] = $_SESSION['error-register-duration'] = '';
	// $_SESSION['error-register-local'] = validationLocal($local);
	if($data==null) $_SESSION['error-register-date']="Insira a data do Tour!"; 
	if($hora==null) $_SESSION['error-register-hour']="Insira uma hora!"; 
	if($duration=="") $_SESSION['error-register-duration']="Insira a duração do Tour!";	
	$_SESSION['error-register-price'] =  SELF::validationPrice($price);
	 // .$_SESSION['error-register-local']
	
	$error = $_SESSION['error-register-name'].$_SESSION['error-register-description'].$_SESSION['error-register-date'].$_SESSION['error-register-hour'].$_SESSION['error-register-duration'].$_SESSION['error-register-price']; 
	
	echo "<br>".$error."<br>";
	return $error;
}

public static function client($name,$country_code , $country, $phone, $language){
		
	$_SESSION['error-register-name'] = SELF::validationName($name);
	$_SESSION['error-register-phone'] = SELF::validationPhoneClient($phone);
	$_SESSION['error-register-language'] = SELF::validationLanguage($language);
	
	$_SESSION['error-register-country'] =  $_SESSION['error-register-countrycode'] =  "";
	// $_SESSION['error-register-local'] = validationLocal($local);
	
	if( $country=="") $_SESSION['error-register-country'] = "Insira o país!";	
	if( $country_code=="")	 $_SESSION['error-register-countrycode'] = "Insira o indicativo válido!";	
	
	$error = $_SESSION['error-register-name'].$_SESSION['error-register-country'].$_SESSION['error-register-countrycode'].$_SESSION['error-register-phone'].
	$_SESSION['error-register-language'];
	
	echo "<br>".$error."<br>";
	return $error;
}
public static function editUser( $name, $country,  $email_paypal ){
	
	$_SESSION['error-update-name'] = Validation::validationName($name);
  // 	$_SESSION['error-update-phone'] = Validation::validationPhone($phone);
 //  	 $_SESSION['error-update-codecountry'] = $_SESSION['error-update-country']=""; if($codecountry == null) $_SESSION['error-update-codecountry'] = "Insira um indicador válido!"; 
	if($country == null) $_SESSION['error-update-country'] = "Insira um país!"; 	
 // 	$_SESSION['error-update-facebook'] = Validation::validationFacebook($facebook);
	$_SESSION['error-update-paypal'] =   Validation::validationEmailPaypal($email_paypal);
	
	$error =   $_SESSION['error-update-name'].	$_SESSION['error-update-paypal'].$_SESSION['error-update-country'];
	
	echo $error;
	if($error==''){ $error=true; }else{ 	$error=false; }
	return $error;
}


public static function contacts($name, $email, $subject, $menssage){
		
	$_SESSION['error-name'] = SELF::validationName($name);
	$_SESSION['error-email'] = SELF::validationEmailContact($email);	
    $_SESSION['error-subject'] =  SELF::validationSubject($subject);	
	$_SESSION['error-message'] =  SELF::validationMenssage($menssage);
	
	 
	
	$error = $_SESSION['error-name'].$_SESSION['error-email'].$_SESSION['error-subject'].$_SESSION['error-message'];
	
	echo "<br>".$error."<br>";
	return $error;
}

public static function alterPassword($apassword,    $npassword, $cpassword){
	$id =  $_SESSION['id-user'];   $user = User::getUserById($id); $password = $user['password']; echo $password;
	
	$error = ''; 
	
	
	
	var_dump(password_verify($apassword, $user['password']));
	if(password_verify($apassword, $user['password'])==false){
		$_SESSION['error-apassword'] = "A palavra-chave actual inserida não está correcta.";
	} 
	
	$_SESSION['error-npassword'] = SELF::validationPassword($npassword);
    
	$_SESSION['error-cpassword'] =  SELF::checkPassword($npassword, $cpassword)	;		 
	
	
	$error = $_SESSION['error-apassword'].$_SESSION['error-npassword'].$_SESSION['error-cpassword'];
	
	echo "<br>".$error."<br>";
	
	if($error=='') return  $error = true; else	 $error=false;
	
	return $error;
}





} 
?>