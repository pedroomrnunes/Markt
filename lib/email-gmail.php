<?php
    require("phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    $mail->Username = "pedroomrnunes@gmail.com"; // your GMail user name
    $mail->Password = "password"; 
    $mail->AddAddress("friends.email@domain.com"); // recipients email
    $mail->FromName = "Markt"; // readable name

    $mail->Subject = "Activation";
    $mail->Body    = "Here is the message you want to send to your friend."; 
    //-----------------------------------------------------------------------

    $mail->Host = "ssl://smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
    else
        echo "Message has been sent";
    ?>