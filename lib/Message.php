<?php

class Message{

function getMsgSucess($code_msg){

     $msg = null;

	 switch($code_msg){

		case "register-user":  $msg = "O registo foi efectuado com sucesso.<br> Active a sua conta. Verifique na sua caixa de correio electrónico ".$_SESSION['email']." o link de activação de conta.";
							   break;

		case "alter-password":  $msg =  "A sua palavra-chave foi alterada com sucesso.";
								 break;

		case "recovery-password": $msg = "Um email foi enviado para o seu endereço electrónico com o link de recuperação de palavra-chave. ";
									break;

		case "reset-password": $msg = "A sua palavra-chave foi recuperada com sucesso.";
										break;


		case "buy" :  $msg = "A compra foi efectuada com sucesso. Um email foi enviado para o seu endereço electrónico com as informações
					               detalhas sobre o cliente associado esta tour.";
									break;

		case "register-annoucement": $msg =  "O registo do anúncio do Tour foi efectuado com sucesso.";
									  break;


	    case "edit-user":           $msg =  "O seu perfil foi editado com sucesso.";
									  break;

	    case "activation-user":  $msg = "A sua conta está agora activa.<br>";
							   break;

		case "contacts":  $msg = "A mensagem foi enviada com sucesso.<br>";
							   break;

		case "verification-phone":  $msg = "A verificação via Telemovel foi efectuada com sucesso. Foram creditados 50 pontos na sua conta. <br>";
							   break;

		case "verification-google":  $msg = "A verificação via Google foi efectuada com sucesso.<br>";
							   break;

		case "verification-fb":  $msg = "A verificação via Facebook foi efectuada com sucesso.<br>";
							   break;

		case "register-email":  $msg = "O registo  foi efectuado com sucesso.  Foram creditados 50 pontos na sua conta. <br>";
							   break;


	   case "register-google":  $msg = "O registo  via Google  foi efectuado com sucesso. Foram creditados 50 pontos na sua conta. <br>";
							   break;

		case "register-fb":  $msg = "A verificação via Facebook  foi efectuada com sucesso. Foram creditados 50 pontos na sua conta. <br>";
							   break;

		case "sms-sent":  $msg = "O código de verificação foi enviado para o seu telemovel. <br>";
							   break;


	 }
     return $msg;
}




function getMsgError($code_msg){

     $msg = null;

	 switch($code_msg){

		case "session":  $msg = "A sua sessão expirou!";
							   break;

		case "login":  $msg =  "Dados de autenticação incorrectos!";
								 break;

		case "recovery-password": $msg = "Um email foi enviado para o seu endereço electrónico com o link de recuperação de palavra-chave. ";
									break;

		case "reset-password": $msg = "A sua palavra-chave foi recuperada com sucesso.";
										break;


		case "buy" :  $msg = "A compra foi efectuada com sucesso. Um email foi enviado para o seu endereço electrónico com as informações
					               detalhas sobre o cliente associado esta tour.";
									break;

		case "register-annoucement": $msg =  "O registo do anúncio do Tour foi efectuado com sucesso.";
									  break;


	    case "edit-user":           $msg =  "O seu perfil foi editado com sucesso.";
									  break;

	    case "activation-user":  $msg = "A sua conta está agora activa.<br>";
							   break;

		case "contacts":  $msg = "A mensagem foi enviada com sucesso.<br>";
							   break;

		case "verification-phone":  $msg = "A verificação via Telemovel foi efectuada com sucesso. Foram creditados 50 pontos na sua conta. <br>";
							   break;

		case "verification-google":  $msg = "A verificação via Google foi efectuada com sucesso.<br>";
							   break;

		case "verification-fb":  $msg = "A verificação via Facebook foi efectuada com sucesso.<br>";
							   break;

		case "register-email":  $msg = "O registo  foi efectuado com sucesso.  Foram creditados 50 pontos na sua conta. <br>";
							   break;


	   case "register-google":  $msg = "O registo  via Google  foi efectuado com sucesso. Foram creditados 50 pontos na sua conta. <br>";
							   break;

		case "register-fb":  $msg = "A verificação via Facebook  foi efectuada com sucesso. Foram creditados 50 pontos na sua conta. <br>";
							   break;

		case "sms-sent":  $msg = "O código de verificação foi enviado para o seu telemovel. <br>";
							   break;


	 }
     return $msg;
}


function getMsgVerificationInfo($phone,$google,$facebook){


		$msg =     "O seu registo ainda não está completo.<br><div style='margin-left: 25px;'> Recomendamos que faça as verificações: </div><br>";

	if($phone == null){
							$msg .= "<div style='padding-left: 5px;'><div class='glyphicon glyphicon-chevron-right' style='padding-right: 5px;'></div>
									Número de telemovel</div>
								    <div style='margin-left: 25px;'> Com a esta verificação aumenta a sua credibilidade na plataforma assim consegue aumentar significativamente as compras
									 e vendas e ganha 50 pontos. <a href='../pages/verification-user.php'>Verifique aqui</a></div> <br><br>  ";
	 }

	if($google == null ) {
							$msg .= "<div style='padding-left: 5px;'><div class='glyphicon glyphicon-chevron-right' style='padding-right: 7px;'> </div>
									  Conta Google.</div>
								     <div style='margin-left: 25px;'>Com a esta verificação aumenta a sua credibilidade na plataforma assim consegue aumentar significativamente as compras
									 e vendas e ganha 50 pontos. <a href='../pages/verification-user.php'>Verifique aqui</a></div> <br><br>		 ";
	}

   	if($facebook == null ) {
							$msg .= "<div style='padding-left: 5px;'><div class='glyphicon glyphicon-chevron-right' style='padding-right: 7px;'></div>
									  Conta Facebook</div>
								    <div style='margin-left: 25px;'> Com a esta verificação aumenta a sua credibilidade na plataforma assim consegue aumentar significativamente as compras
									 e vendas e ganha 50 pontos.<a href='../pages/verification-user.php'>Verifique aqui</a></div> <br>";
	}

     return $msg;

}


function getVerificationGlyphicon($phone,$google,$facebook){
	$glyphicon =  "<div class='glyphicon glyphicon-envelope'  style='padding-right: 7px;'></div>";
	//   echo  " <a href='#' data-toggle='tooltip' data-placement='top' title='Hooray!'>Hover</a>"
	if($phone!=null){

	 	$glyphicon .=  "<div class='glyphicon glyphicon-phone' style='padding-right: 7px;'></div>";
	}
	if($google!=null){
		$glyphicon .=  '<i class="fa fa-google-plus" style="padding-right: 7px;"></i>';
	}

	if($facebook!=null){
	   $glyphicon .=  '<i class="fa fa-facebook" style="padding-right: 7px;"></i>';
	}
	return $glyphicon;
}

public static function showAlertSucess($code_msg  ){
	$sucess = SELF::getMsgSucess($code_msg);
	$html =  '<div class="alert alert-success alert-dismissable">'.
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.
				"<div class='glyphicon glyphicon-ok' style='padding-right: 7px;'></div>".
				"<span>".$sucess."</span>".
			  "</div>";
	return $html;
}

public static function showAlertInfo($code_msg  ){
	$info = SELF::getMsgSucess($code_msg);
	$html = '<div class="alert alert-info alert-dismissable">'.
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.
				"<div class='glyphicon glyphicon-info-sign' style='padding-right: 12px;'></div>".
				"<span>".$info."</span>".
			  "</div>";
	return $html;
}

public static function showAlertVerificationInfo($phone,$google,$facebook ){
	$info = SELF::getMsgVerificationInfo($phone,$google,$facebook);
	$html = '<div class="alert alert-info alert-dismissable">'.
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.
				"<div class='glyphicon glyphicon-info-sign' style='padding-right: 12px;'></div>".
				"<span>".$info."</span>".
			  "</div>";
	return $html;
}

 public static function showAlertError($code_msg){
	$error = SELF::getMsgError($code_msg);
	$html = '<div class="alert alert-danger alert-dismissable" style="margin-bottom: 15px;">'.
				'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.
				"<div   class='glyphicon glyphicon-remove' style='padding-right: 12px;'></div>".
				"<span>".$error."</span>".
			  "</div>";
	return $html;
}

}
?>
