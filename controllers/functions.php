<?php
// functions.php
function check_txnid($tnxid){
	global $link;
	return true;
	$valid_txnid = true;
	//get result set
	$sql = mysql_query("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $link);
	if ($row = mysql_fetch_array($sql)) {
		$valid_txnid = false;
	}
	return $valid_txnid;
}

function check_price($price, $id){
	$valid_price = false;
	//you could use the below to check whether the correct price has been paid for the product
	
	/*
	$sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");
	if (mysql_num_rows($sql) != 0) {
		while ($row = mysql_fetch_array($sql)) {
			$num = (float)$row['amount'];
			if($num == $price){
				$valid_price = true;
			}
		}
	}
	return $valid_price;
	*/
	return true;
}

function updatePayments($data){
	global $link;
	
	if (is_array($data)) {
		$sql = mysql_query("INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES (
				'".$data['txn_id']."' ,
				'".$data['payment_amount']."' ,
				'".$data['payment_status']."' ,
				'".$data['item_number']."' ,
				'".date("Y-m-d H:i:s")."'
				)", $link);
		return mysql_insert_id($link);
	}
}
function insertPayments($data){
	header("Location: http://www.google.com");
	$con = mysqli_connect("localhost","root", "Katemoss15","test");
    
	if(!$con){
        die("Failed to connect to Database"); 
    }
	    mysqli_select_db($con, "test") or die (mysql_error($con));
		
					  $query = "INSERT INTO payments (txnid, payment_amount, payment_status, itemid, createdtime)
							VALUES ( '{$data['txn_id']}', '{$data['payment_amount']}', '{$data['payment_status']}', '{$data['item_number']}', NOW())";  
		  	
	//run query
	mysqli_query($con,$query) or die ("didn't query".mysqli_error($con));
	
	$id = mysqli_insert_id($con);	
	
	echo "Pagamento guardado.<br>";
	
	mysqli_close($con);

	
}
/* $date = array(); 
$data['txn_id']='15'; $data['payment_amount']=5; $data['payment_status']="pago"; $data['item_number']="15975";
insertPayments($data);
*/
