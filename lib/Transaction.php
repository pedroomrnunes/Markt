<?php

class Transaction{

public static function getTransactions(){
	$conn = connect();

	$query = "SELECT id_transaction, id_annoucement, id_buyer, id_receipt, id_payment, state, timecreated, timemodified
            	FROM transaction";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transactions = array();

	$count = 0;

	while ($row = mysqli_fetch_assoc($result)) {

	//  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];


	 $transactions[$count]["id_transaction"] = $row["id_transaction"];
	 $transactions[$count]["id_annoucement"] = $row["id_annoucement"];
	 $transactions[$count]["id_buyer"] = $row["id_buyer"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["id_payment"] =    $row["id_payment"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["state"] = $row["state"];

	$count++;

    }
	mysqli_close($conn);

	return $transactions;
}

public static function getTransactionsByBuyer($id_user){

   $conn = connect();

	$query = "SELECT id_transaction,  id_annoucement, id_buyer,	id_receipt, id_payment, state, timecreated, timemodified
	          FROM transaction WHERE id_buyer =   {$id_user}  ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transactions = array();


	$count = 0;

	while ($row = mysqli_fetch_assoc($result)) {

	//  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];

	 $transactions[$count]["id_transaction"] = $row["id_transaction"];
	 $transactions[$count]["id_annoucement"] = $row["id_annoucement"];
	 $transactions[$count]["id_buyer"] = $row["id_buyer"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["id_payment"] =    $row["id_payment"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions[$count]["state"] = $row["state"];

	 $count++;

	}

	mysqli_close($conn);

	return $transactions;
}

public static function getTransactionsByVendor($id_user){


     $conn = connect();

	$query = "SELECT transaction.id_transaction, transaction.id_annoucement, transaction.id_receipt, transaction.timecreated,  transaction.timemodified, transaction.state
			FROM transaction INNER JOIN annoucement ON  transaction.id_annoucement = annoucement.id_annoucement
	        WHERE annoucement.id_user = {$id_user}";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));


	$transactions = array();


	$count = 0;

	while ($row = mysqli_fetch_assoc($result)) {

	//  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];

	 $transactions[$count]["id_transaction"] = $row["id_transaction"];
	 $transactions[$count]["id_annoucement"] = $row["id_annoucement"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions[$count]["state"] = $row["state"];

	 $count++;

	}

	mysqli_close($conn);

	return $transactions;
}

public static function getTransactionsTableByBuyer( $id_user, $offset,$limit){

   $conn = connect();

	$query = "SELECT id_transaction,  id_annoucement, id_buyer,	id_receipt, id_payment, state, timecreated, timemodified
	          FROM transaction WHERE id_buyer =    {$id_user}  LIMIT {$limit}      OFFSET {$offset}  ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transactions = array();


	$count = 0;

	while ($row = mysqli_fetch_assoc($result)) {

	//  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];

	 $transactions[$count]["id_transaction"] = $row["id_transaction"];
	 $transactions[$count]["id_annoucement"] = $row["id_annoucement"];
	 $transactions[$count]["id_buyer"] = $row["id_buyer"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["id_payment"] =    $row["id_payment"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions[$count]["state"] = $row["state"];

	 $count++;

	}

	mysqli_close($conn);

	return $transactions;
}

 public static function getTransactionsTableByVendor( $id_user , $offset,$limit){

    $conn = connect();


	$query = "SELECT transaction.id_transaction, transaction.id_annoucement, transaction.id_receipt, transaction.timecreated,  transaction.timemodified, transaction.state
			FROM transaction INNER JOIN annoucement ON  transaction.id_annoucement = annoucement.id_annoucement
	        WHERE annoucement.id_user = {$id_user}";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transactions = array();

	$count = 0;

	while ($row = mysqli_fetch_assoc($result)) {

	//  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];

	 $transactions[$count]["id_transaction"] = $row["id_transaction"];
	 $transactions[$count]["id_annoucement"] = $row["id_annoucement"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions[$count]["state"] = $row["state"];

	 $count++;

	}

	mysqli_close($conn);

	return $transactions;
}




public static function getBuys($id){

	$conn = connect();

	$query = "SELECT id_transaction, id_annoucement, id_buyer, id_receipt, id_payment, state, timecreated, timemodified
	FROM transaction WHERE id_buyer = '{$id}'";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transactions = array();

	$count = 0;

	while ($row = mysqli_fetch_assoc($result)) {

	// echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row["id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];

	 $transactions[$count]["id_transaction"] = $row["id_transaction"];
	 $transactions[$count]["id_annoucement"] = $row["id_annoucement"];
	 $transactions[$count]["id_buyer"] = $row["id_buyer"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["id_payment"] =    $row["id_payment"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions[$count]["state"] = $row["state"];

	 $count++;

	}


	mysqli_close($conn);

	return $transactions;
}

public function getMySells($id){
	$conn = connect();

	$query = "SELECT id_transaction, id_annoucement, id_buyer, id_receipt, id_payment, state, timecreated, timemodified

	   FROM transaction 	WHERE id_vendor ='{$id}'";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));



	$transactions = array();
	 $count =0;
	while ($row = mysqli_fetch_assoc($result)) {
   //  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];
	 $transactions["id_transaction"] = $row["id_transaction"];
	 $transactions["id_annoucement"] = $row["id_annoucement"];
	 $transactions["id_buyer"] = $row["id_buyer"];
	 $transactions["id_vendor"] = $row["id_vendor"];
	 $transactions[$count]["id_receipt"] =    $row["id_receipt"];
	 $transactions[$count]["id_payment"] =    $row["id_payment"];
	 $transactions[$count]["timecreated"] = $row["timecreated"];
	 $transactions[$count]["timemodified"] =   $row["timemodified"];
	 $transactions["state"] = $row["state"];
	 $count++;
    }
	$transactions["total"] = $count;


	mysqli_close($conn);

	return $transactions;
}

public static function updateStatePendent($id_transaction){
	//  State:   0  - Pendente  	1 -  Completed  2 - Not Completed
	$query = "UPDATE transaction  SET  state = 0  WHERE	id_transaction = '{$id_transaction}' ";

	$conn = connect();
	if(mysqli_query($conn, $query)){

	  echo "Upadate Transaction State Pendent guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}
	mysqli_close($conn);
  }

public static function updateStateCompleted($id_transaction){
	//  State:   0 - Pendente  	1 - Completed 			2 - NotCompleted
	$query = "UPDATE transaction  SET  state = 1  WHERE	id_transaction = '{$id_transaction}' ";

	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate Transaction State Completed guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}
	mysqli_close($conn);
  }

public static function updateStateNotCompleted($id_transaction){
	//  Realized:   0 - Pendente  	1 - Concluida  2 - Não concluida
	$query = "UPDATE transaction  SET  state = 2  WHERE	id_transaction = '{$id_transaction}' ";

	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate Transaction State Not Completed  guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}
	mysqli_close($conn);
  }
public function getTransactionByAnnoucementId($id){

	$conn = connect();

	$query = "SELECT id_transaction, id_annoucement, id_buyer, id_receipt, id_payment, state, timecreated, timemodified
	FROM transaction WHERE id_annoucement ='{$id}'";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transaction = array();

	while ($row = mysqli_fetch_assoc($result)) {


   //  echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];

   	 $transaction["id_transaction"] = $row["id_transaction"];
	 $transaction["id_annoucement"] = $row["id_annoucement"];
	 $transaction["id_buyer"] = $row["id_buyer"];
	 $transaction["id_receipt"] =    $row["id_receipt"];
	 $transaction["id_payment"] =    $row["id_payment"];
	 $transaction["timecreated"] = $row["timecreated"];
	 $transaction["timemodified"] =   $row["timemodified"];
	 $transaction["state"] = $row["state"];
    }

	mysqli_close($conn);

	return $transaction;
}

public function checkStateTransaction($id){
	 $state = null;

	$transaction = getTransactionByAnnoucementId($id);
	foreach($annoucements as $row){

		if($row['state']==0){

			$state = 0;
		}else{

			$state = 1;

		}
	}

	return $state;
}

public function getTransactionById($id){

	$conn = connect();

	$query = "SELECT id_transaction, id_annoucement, id_buyer, id_receipt, id_payment, state, timecreated
	FROM transaction WHERE id_transaction ='{$id}' LIMIT 1 ";


	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$transaction = array();

	while ($row = mysqli_fetch_assoc($result)) {


    //  	 echo   $row["id_transaction"]. " ".$row["id_annoucement"]." ".$row["id_buyer"]." ".$row["state"]." ".$row[" id_comission_vendor"]." ".$row["id_comission_buyer"]." ".$row["timecreated"];
	  $transaction["id_transaction"] = $row["id_transaction"];
	  $transaction["id_annoucement"] = $row["id_annoucement"];
	  $transaction["id_buyer"] = $row["id_buyer"];
	  $transaction["id_receipt"] =    $row["id_receipt"];
	  $transaction["id_payment"] =    $row["id_payment"];
	  $transaction["timecreated"] = $row["timecreated"];
	  $transaction["state"] = $row["state"];

  }

	mysqli_close($conn);

	return $transaction;
}

public function insertTransaction($id_annoucement, $id_buyer,$id_vendor){

	$conn = connect();

	$query = "INSERT INTO transaction ( id_annoucement, id_buyer, id_receipt, id_payment, state, timecreated, timemodified  )
				VALUES ('{$id_annoucement}', '{$id_buyer}', '{$id_vendor}', NOW() )";


	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$id = mysqli_insert_id($conn);

	echo "Id transaction: ".$id."<br>";

	echo "Transacção guardada.";

	mysqli_close($conn);

	return $id;
}


public static function showTableTransactionsBuyer($id){

  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-tours">';
    echo  "<thead>
            <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Data</th>
			<th class='text-center'>Angariador de Tours</th>
			<th class='text-center'>Tour</th>
			<th class='text-center'>Minha comissão</th>
			<th class='text-center'>Estado</th>
            </tr>
          </thead>";
    echo "<tbody>";



	$count = 0;

	$transactions =  self::getTransactionsBuyer($id);
	$arrayTotal = count($transactions); echo "Total de transacções: ".$arrayTotal."<br>";

    while($count!=$arrayTotal){
		$state = '<span class="label label-danger">Por pagar</span>';
		if($transactions[$count]['state']==1)
			$state =  '<span class="label label-success">Pago</span>';


	//	$id_annoucement = $transactions[$count]['id_annoucement'];

    //	$id_buyer = $transactions[$count]['id_buyer'];
	//	$vendor = User::getUserById($id_annoucement);
		$buyer =  User::getUserById($id);
		$tour = Tour::getTourById($transactions[$count]['state']);
	//	$comission_vendor = ComissionVendor::getTransactionsVendor($transactions[$count]['id_comission_vendor']);
		$comission_buyer =  ComissionBuyer::getComissionsById($transactions[$count]['id_comission_buyer']);

	    echo '<tr class="odd gradeX" data-id=1 data-toggle="modal" data-target="#modalTransactions" type="submit">';
		echo "<td>".$transactions[$count]['state']."</td>";
		echo "<td class='text-center'>".$transactions[$count]['timecreated']."</td>";
		echo "<td class='text-center'>".$buyer['name']."</td>";
		echo "<td class='text-center'><a href='#'>".$tour['name']."</a></td>";
		echo "<td class='text-center'>".$comission_buyer['value']."</td>";

	//	echo "<td class='text-center'>".$vendor['name']."</td>";
	//	echo "<td class='text-center'>".$comission_vendor['value']."</td>";
	//	 echo "<td class='text-center'>".$comission_markt."</td>";
		echo "<td class='text-center'>".$state."</td>";
		echo  "</tr>";

	   $count++;
	}

	echo "</tbody>";

	echo "</table>";

}

public static function showTableTransactionsVendor($id){

  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-tours">';
    echo  "<thead>
            <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Data</th>
			<th class='text-center'>Prestador de Serviços</th>
			<th class='text-center'>Tour</th>
			<th class='text-center'>A minha comissão</th>
			<th class='text-center'>Estado</th>
            </tr>
          </thead>";
    echo "<tbody>";
	$count = 0;
    $comissionsTotal = ComissionVendor::getValueTotalByUser($id);
	$transactions =  self::getTransactionsVendor($id);
	$arrayTotal = count($transactions); echo "Total de transacções: ".$arrayTotal."<br> Total de comissões ganhas: ".$comissionsTotal."€";

    while($count!=$arrayTotal){
		$state = '<span class="label label-danger">Por receber</span>';
		if($transactions[$count]['state']==1)
			$state =  '<span class="label label-success">Recebido</span>';




		$vendor = User::getUserById($id);
		$buyer =  User::getUserById($transactions[$count]['id_buyer']);
		$tour = Tour::getTourById($transactions[$count]['state']);

		$comission_vendor = ComissionVendor::getComissionsById($id);

	    echo '<tr class="odd gradeX" data-id=1 data-toggle="modal" data-target="#modalTransactions" type="submit">';
		echo "<td class='text-center>".$transactions[$count]['state']."</td>";
		echo "<td class='text-center'>".$transactions[$count]['timecreated']."</td>";
		echo "<td class='text-center'>".$buyer['name']."</td>";
		echo "<td class='text-center'><a href='#'>".$tour['name']."</a></td>";
		echo "<td class='text-center'>".$comission_vendor['value']."€</td>" ;
		echo "<td class='text-center'>".$state."</td>";
		echo  "</tr>";

	   $count++;
	}
	echo "</tbody>";
	echo "</table>";
}



}
?>
