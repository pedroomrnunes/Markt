<?php

class Receipt{

private $tour = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;





public static function getReceipts(){
	$conn = connect();

	$query = "SELECT id_receipt, value, state, timecreated FROM receipt  ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	 $receipts = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $receipts["id_receipt"] = $row["id_receipt"];
	 $receipts["value"] = $row["value"];
	 $receipts["state"] = $row["state"];
	 $receipts["timecreated"] = $row["timecreated"];
    }
	mysqli_close($conn);

	return $receipts;
}



public static function getReceiptById($id){
	$conn = connect();

	$query = "SELECT id_receipt, value, state, timecreated FROM receipt WHERE id_receipt ='{$id}' LIMIT 1 ";

	$result =  mysqli_query($conn,$query) or die ("Receipt: didn't query".mysqli_error($conn));

	 $receipt = array();
	 while ($row = mysqli_fetch_assoc($result)) {

     $receipt["id_receipt"] = $row["id_receipt"];
	   $receipt["value"] = $row["value"];
	   $receipt["state"] = $row["state"];
     $receipt["timecreated"] = $row["timecreated"];
    }
	mysqli_close($conn);

	return $receipt;
}


public static function insertReceipt( $value, $state, $timecreated){
	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
    $conn = connect();

	//run query
	$query = "INSERT INTO `receipt` ( value , state ,  timecreated )  VALUES ( '{$value}', 1, '{$now}' )";

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

function updateReceipt($id_receipt, $value,  $state       ){

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );

	$query = "UPDATE receipt  SET  value = '{$value}' AND  email = '{$email}'  AND  state = '{$state}' AND timecreated = '{$now}'
	WHERE 	id_receipt = '{$id_receipt}' ";


	//run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate  receipt guardado. ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function updateState($id, $state){


		$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );     $now = $now->format("Y-m-d H:i:s");
		$query = "UPDATE receipt  SET  state = '{$state}' , timecreated = '{$now}'   WHERE 	id_receipt = '{$id}' ";


	     //run query
		$conn = connect();

		if(mysqli_query($conn, $query)){

		  echo    "Update  estado recebimento: ".$state;

	    }else{

		  die ("didn't query".mysqli_error($conn));
		}

		mysqli_close($conn);

	}

public static function processReceipt($id,$userid,$transactionid){


	SELF::updateState($id,1);
	Transaction::updateStateCompleted($transactionid);
	User::updateBalance($userid);
}


}
?>
