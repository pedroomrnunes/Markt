<?php

class Admin{

  public static function processReceipt($id_transaction){

      $transaction = Transaction::getTransactionById($id_transaction);

      Receipt::updateState($transaction['id_receipt'],2);

      Transaction::updateStateCompleted($id_transaction);

  }

  public static function processTourNotRealized($id_transaction){
      $transaction = Transaction::getTransactionById($id_transaction);
                $annoucement = Annoucement::getAnnoucementById($transaction['id_annoucement']);
                Transaction::updateStateNotCompleted($id_transaction);
                Receipt::updateState($transaction['id_receipt'],3);
                Tour::updateStateNotRealized($annoucement['id_tour']);
    }


  public static function getTotalComissionMarktCompleted(){

    $conn = connect();

	  $query = "SELECT SUM(comission_markt.value) AS total FROM comission_markt, annoucement, payment , transaction
            WHERE transaction.id_payment = payment.id_payment AND annoucement.id_annoucement = transaction.id_annoucement
            AND comission_markt.id_comission_markt = annoucement.id_comission_markt AND transaction.state = 1";

	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	  $comission_markt = null;

    while ($row = mysqli_fetch_assoc($result)) {

      $comission_markt = $row["total"];

   	 }

     mysqli_close($conn);

	   return      $comission_markt;

   }

  public static function getTotalComissionMarktPayed(){

    $conn = connect();

    $query = "SELECT SUM(comission_markt.value) AS total FROM comission_markt, annoucement, payment , transaction
           WHERE transaction.id_payment = payment.id_payment AND annoucement.id_annoucement = transaction.id_annoucement
           AND comission_markt.id_comission_markt = annoucement.id_comission_markt AND payment.payment_status = 1";

    $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

    $comission_markt = null;

    while ($row = mysqli_fetch_assoc($result)) {

      $comission_markt = $row["total"];

     }

     mysqli_close($conn);

     return      $comission_markt;
   }

  public static function getTotalPaymentsBuyer($state){

    $conn = connect();

	  $query = "SELECT     SUM(value) AS total FROM payments WHERE state=1 ";

	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	  $total_payments =   null;

    while ($row = mysqli_fetch_assoc($result)) {
	    $total_payments = $row["total"];
    }

    mysqli_close($conn);

	  return $total_payments;
  }

  public static function getTotalReceiptsVendor(){

    $conn = connect();

	  $query = "SELECT     SUM(value) AS total FROM receipts WHERE state=1 ";


	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	  $total_receipts =   null;

    while ($row = mysqli_fetch_assoc($result)) {
	    $total_receipts = $row["total"];
    }

    mysqli_close($conn);

	  return $total_receipts;
  }


  public static function getNTours($state){

	  $conn = connect();

	  $query = "SELECT     count(id_tour) AS total FROM tour WHERE state = {$state} ";

	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	  $ntours =   null;

    while ($row = mysqli_fetch_assoc($result)) {
	    $ntours = $row["total"];
    }

    mysqli_close($conn);

	  return $ntours;
  }

  public static function getNAnnoucements($state){
	  $conn = connect();

	  $query = "SELECT     count(id_tour) AS total FROM annoucement WHERE state = {$state} ";

	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	  $nannoucements =   null;

    while ($row = mysqli_fetch_assoc($result)) {
	    $nannoucements = $row["total"];
    }

    mysqli_close($conn);

	  return $nannoucements;
  }

  public static function getNTransactions($state){

    $conn = connect();

	  $query = "SELECT     count(id_transaction) AS total FROM transaction WHERE state = {$state} ";

	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	  $ntransactions =   null;

    while ($row = mysqli_fetch_assoc($result)) {

      $ntransactions = $row["total"];

    }

    mysqli_close($conn);

	  return $ntransactions;
   }

   public static function getTotalPayed($state){
	   $conn = connect();

	   $query = "SELECT     SUM(value) AS total FROM receipt WHERE state=2 ";

	   $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	   $client = array();

     while ($row = mysqli_fetch_assoc($result)) {

       $client["id_client"] = $row["id_client"];

     }
	   mysqli_close($conn);

	   return $client;
   }

  public static function getNPayments($state){

    $conn = connect();

 	  $query = "SELECT     count(*) AS total FROM payment WHERE payment_status = {$state} ";

 	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

 	  $npayments =   null;

     while ($row = mysqli_fetch_assoc($result)) {
 	    $npayments = $row["total"];
     }

     mysqli_close($conn);

 	   return $npayments;
   }
   public static function getNReceipts($state){
 	  $conn = connect();

 	  $query = "SELECT     count(*) AS total FROM receipt WHERE state = {$state} ";

 	  $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

 	  $nreceitps =   null;

     while ($row = mysqli_fetch_assoc($result)) {
 	    $nreceitps = $row["total"];
     }

     mysqli_close($conn);

 	   return $nreceitps;
   }

   public static function getNUsers($active){
    $conn = connect();

    $query = "SELECT     count(*) AS total FROM user WHERE state = {$active} ";

    $result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

    $nusers =   null;

     while ($row = mysqli_fetch_assoc($result)) {
      $nusers = $row["total"];
     }

     mysqli_close($conn);

     return $nusers;
   }
  public static function insertAdmin($name,$phone, $country, $language){
    $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );

    $now = $now->format("Y-m-d H:i:s");
    $conn = connect();
	  mysqli_query($conn, "set names 'utf8'");
	  //run query
	  $query = "INSERT INTO `client` ( name , phone , country, language, timecreated )  VALUES ( '{$name}', '{$phone}', '{$country}', '{$language}', '{$now}' )";

	  if(mysqli_query($conn, $query)){

	    $id = mysqli_insert_id($conn);

		  echo "Registo guardado.";

       return $id;
    }else{
		die ("didn't query".mysqli_error($conn));
	}



   mysqli_close($conn);

	 return $id;
  }

  function updateAdmin($id_client, $name, $email,    $phone       ){

	  $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");
	  $query = "UPDATE client  SET  name = '{$name}' AND  email = '{$email}'  AND  phone = '{$phone}' AND timecreated = '{$now}'   WHERE 	id_tour = '{$id_client}' ";
	  // $query = "UPDATE tour  SET  id_client = 15  WHERE 	id_tour = 1 ";

     //run query
	  $conn = connect();

	  if(mysqli_query($conn, $query)){

	  echo "Upadate  cliente guardado. ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	  mysqli_close($conn);
   }
}



?>
