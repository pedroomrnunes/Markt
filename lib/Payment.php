<?php

class Payment{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;





public static function getPayments(){
	$conn = connect();

	$query = "SELECT id_payment, txn_id, payment_amount,  payment_status, receiver_email, payer_email, timecreated FROM payment  ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $payments = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $payments["id_payment"] = $row["id_payment"];
		 $payment["txn_id"] = $row["txn_id"];
		 $payment["payment_amount"] = $row["payment_amount"];
		 $payment["payment_amount"] = $row["payment_amount"];
		 $payment["payment_status"] = $row["payment_status"];
		 $payment["receiver_email"] = $row["receiver_email"];
		 $payment["payer_email"] = $row["payer_email"];
		$payment["timecreated"] = $row["timecreated"];
    }
	mysqli_close($conn);

	return $payments;
}



public static function getPaymentById($id){
	$conn = connect();

	$query = "SELECT id_payment, txnid, payment_amount,  payment_status, receiver_email, payer_email, timecreated FROM payment WHERE id_payment ='{$id}' LIMIT 1 ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $payment = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     	$payment["id_payment"] = $row["id_payment"];
	 		$payment["txn_id"] = $row["txnid"];
			$payment["payment_amount"] = $row["payment_amount"];
			$payment["payment_amount"] = $row["payment_amount"];
			$payment["payment_status"] = $row["payment_status"];
			$payment["receiver_email"] = $row["receiver_email"];
			$payment["payer_email"] = $row["payer_email"];
     	$payment["timecreated"] = $row["timecreated"];
    }

	 mysqli_close($conn);

	return $payment;
}


public static function insertPayment($data){
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
    $conn = connect();

		$data['item_name']			= $_POST['item_name'];
		$data['item_number'] 		= $_POST['item_number'];
		$data['payment_status'] 	= $_POST['payment_status'];
		$data['payment_amount'] 	= $_POST['mc_gross'];
		$data['payment_currency']	= $_POST['mc_currency'];
		$data['txn_id']				= $_POST['txn_id'];
		$data['receiver_email'] 	= $_POST['receiver_email'];
		$data['payer_email'] 		= $_POST['payer_email'];
		$data['custom'] 			= $_POST['custom'];

	//run query
	$query = "INSERT INTO `payment` ( txn_id, payment_amount,  payment_status, receiver_email, payer_email, timecreated )
	  VALUES (     '{$data['txn_id']}', '{$data['txn_id']}',  '{$data['payment_amount'] }', '{$data['payment_status']}',
 		'{$data['receiver_email']}', '{$data['payer_email']}', '{$now}' )";

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

function updatePayment($id_payment, $value,  $state       ){

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );

	$query = "UPDATE payment  SET  value = '{$value}' AND  email = '{$email}'  AND  state = '{$state}' AND timecreated = '{$now}'
	WHERE 	id_payment = '{$id_payment}' ";


	//run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate  payment guardado. ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }



}
?>
