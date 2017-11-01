<?php

class Tour{

public static function getTours(){

	$conn = connect();

	$query = "SELECT id_tour, name_tour, description, duration, date_tour, departure_place,  price, id_user, state, timecreated FROM tour";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$count = 1;

	$tours = array();

	while ($row = mysqli_fetch_assoc($result)) {
    // echo $row["id_tour"]." ".$row["name"]." ".$row["description"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["duration"];
	 $tours[$count]["id_tour"] = $row["id_tour"];
	 $tours[$count]["name"] = $row["name_tour"];
	 $tours[$count]["description"] = $row["description"];
	 $tours[$count]["duration"] = $row["duration"];
	 $tours[$count]["date"] = $row["date_tour"];
	 $tours[$count]["departure_place"] = $row["departure_place"];
	 $tours[$count]["price"] = $row["price"];
	 $tours[$count]["id_user"] = $row["id_user"];
     $tours[$count]["state"] = $row["state"];
	 $tours[$count]["timecreated"] = $row["timecreated"];

	 $count++;
	}
	mysqli_close($conn);
	return $tours;
}


public static function getToursRealized(){

	$conn = connect();

	$query = "SELECT id_tour, name_tour, description, duration, date_tour, departure_place,  price,  timecreated
	FROM tour 		WHERE state=3";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$count = 1;

	$tours = array();
	while ($row = mysqli_fetch_assoc($result)) {

	 $tours[$count]["id_tour"] = $row["id_tour"];
	 $tours[$count]["name"] = $row["name_tour"];
	 $tours[$count]["description"] = $row["description"];
	 $tours[$count]["duration"] = $row["duration"];
	 $tours[$count]["date"] = $row["date_tour"];
	 $tours[$count]["departure_place"] = $row["departure_place"];
	 $tours[$count]["price"] = $row["price"];
	 $tours[$count]["timecreated"] = $row["timecreated"];

	 $count++;
	}
	mysqli_close($conn);
	return $tours;
}

public function getTourById($id){
	$conn = connect();
	$query = "SELECT id_tour, name_tour, description, duration, date_tour, departure_place,  price, state, timecreated
	 FROM tour WHERE id_tour ='{$id}' LIMIT 1 ";

	$result =  mysqli_query($conn,$query) or die ("didn't query Tour".mysqli_error($conn));

	$tour = array();

	while ($row = mysqli_fetch_assoc($result)) {
     // echo $row["id_tour"]." ".$row["name"]." ".$row["description"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["duration"];
	 $tour["id_tour"] = $row["id_tour"];
	 $tour["name"] = $row["name_tour"];
	 $tour["description"] = $row["description"];
	 $tour["duration"] = $row["duration"];
	 $tour["date"] = $row["date_tour"];
	 $tour["departure_place"] = $row["departure_place"];
	 $tour["price"] = $row["price"];
	 $tour["state"] = $row["state"];
     $tour["timecreated"] = $row["timecreated"];
    }

	mysqli_close($conn);

	return $tour;
}

public function getTourRealizedById($id){
	$conn = connect();

	$query = "SELECT id_tour, name_tour, description, duration, date_tour, hour_tour, departure_place,  price, id_user, state, timecreated
	FROM tour WHERE id_tour ='{$id}' and  state=1 LIMIT 1";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$tour = array();

	while ($row = mysqli_fetch_assoc($result)) {
    // echo $row["id_tour"]." ".$row["name"]." ".$row["description"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["duration"];
	 $tour["id_tour"] = $row["id_tour"];
	 $tour["name"] = $row["name_tour"];
	 $tour["description"] = $row["description"];
	 $tour["duration"] = $row["duration"];
	 $tour["date"] = $row["date_tour"];
	 $tour["departure_place"] = $row["departure_place"];
	 $tour["hour"] = $row["hour_tour"];
	 $tour["price"] = $row["price"];
	 $tour["id_user"] = $row["id_user"];
	 $tour["state"] = $row["state"];
     $tour["timecreated"] = $row["timecreated"];
    }
	mysqli_close($conn);
	return $tour;
}




public static function insertTour($name,$description, $departure_place, $date, $hour, $duration, $price){

	$conn = connect();
	mysqli_query($conn, "set names 'utf8'");

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon') ); 	$now = $now->format("Y-m-d H:i:s");
	$date = $date." ".$hour;
	$query = "INSERT INTO `tour` (name_tour, description, duration, date_tour,  departure_place,  price,  state, timecreated)
		VALUES ( '{$name}', '{$description}', '{$duration}', '{$date}',  '{$departure_place}',  '{$price}',  0,  '{$now}'  )";

	mysqli_set_charset($conn,"utf8");

	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$id = mysqli_insert_id($conn);

	echo "Id tour: ".$id."<br>";

	echo "Registo guardado.";

	mysqli_close($conn);

	return $id;
}
 public static function updateStateInTour($id_tour){
	 //  Realized:  0 -  Not Began 1 - Tour em execução  	2 - Tour Realizada 3 - Tour Nao Realizada Realizada
	 $query = "UPDATE tour  SET  state = 1  WHERE	id_tour = '{$id_tour}' ";

	 $conn = connect();

	 if(mysqli_query($conn, $query)){
	   echo "Upadate State Tour In Tour  guardado: ";
   }else{
	   die ("didn't query".mysqli_error($conn));
	 }
	 mysqli_close($conn);
  }

  public static function updateStateRealized($id_tour){
	//  Realized:  0 -  Not Began 1 - Tour em execução  	2 - Tour Realizada 3 - Tour Nao Realizada Realizada
	$query = "UPDATE tour  SET  state = 2  WHERE	id_tour = '{$id_tour}' ";

	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate State Tour Realized  guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}
	mysqli_close($conn);
  }
public static function updateStateNotRealized($id_tour){
	//  Realized:  0 -  Error 1 - Tour em execução  	2 - Tour Nao Realizada 3 - Realizada
	$query = "UPDATE tour  SET  state = 3  WHERE	id_tour = '{$id_tour}' ";

	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate State Tour Not Realized    guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}
	mysqli_close($conn);
  }








public function getToursByVendor($id_user){
	$conn = connect();

	$query = "SELECT id_tour, name_tour, description, duration, date_tour, hour_tour, departure_place,  price, id_user, state, timecreated
	WHERE id_user ='{$id_user}' LIMIT 1 ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$tour = array();
	$count = 0;
	while ($row = mysqli_fetch_assoc($result)) {
     echo $row["id_tour"]." ".$row["name"]." ".$row["description"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["duration"];
	 $tours[$count]["id_tour"] = $row["id_tour"];
	 $tours[$count]["name"] = $row["name_tour"];
	 $tours[$count]["description"] = $row["description"];
	 $tours[$count]["duration"] = $row["duration"];
	 $tours[$count]["date_tour"] = $row["date_tour"];
	 $tours[$count]["hour_tour"] = $row["hour_tour"];
	 $tours[$count]["departure_place"] = $row["departure_place"];
	 $tours[$count]["price"] = $row["price"];
	 $tours["id_user"] = $row["id_user"];
	 $tours[$count]["state"] = $row["state"];
	 $tours[$count]["timecreated"] = $row["timecreated"];
	  $count++;
    }
	mysqli_close($conn);

	return $tour;
}



public function checkToursRealized(){
	$conn = connect();

	$query = "SELECT tour.id_tour,  tour.name_tour,  tour.date_tour,   annoucement.id_annoucement,   transaction.state,   tour.state,   annoucement.active
			FROM      tour,        annoucement,       transaction
			WHERE tour.id_tour = annoucement.id_tour   AND    annoucement.id_annoucement = transaction.id_annoucement
			AND tour.state = 1";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$hoursconfirmed = 48;

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon'));

	while ($row = mysqli_fetch_assoc($result)) {

		$datetour =  new DateTime($row["date_tour"]);
		$datetour->add(new DateInterval('PT'.$hoursconfirmed.'H'));	echo "<br>1<br>";var_dump($now > $datetour);  echo "<br>"; var_dump($row["state"]==1);
		echo "<br><br><br>";
		if($now > $datetour &&     $row["state"]==1){
			SELF::updateStateRealized($row["id_tour"]);							echo "Tour  realizada por não confirmação";
	    	Transaction::updateStateCompleted($row["id_annoucement"]);
		}else{
			echo "Tour em execução";
		}

    }
	mysqli_close($conn);

}


public static function checkToursState(){
	$conn = connect();

	$query =    "SELECT tour.id_tour  ,  tour.name_tour,  tour.date_tour,   annoucement.id_annoucement, transaction.id_receipt,
	             transaction.id_transaction, transaction.state AS transactionstate,   tour.state AS tourstate,
				  	 	 annoucement.active
				 		   FROM      tour,        annoucement,       transaction
							 WHERE tour.id_tour = annoucement.id_tour   AND    annoucement.id_annoucement = transaction.id_annoucement
							 AND annoucement.state = 2";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$hoursconfirmed = 48;

	$now = new DateTime("now", new DateTimeZone('Europe/Lisbon'));

	while ($row = mysqli_fetch_assoc($result)) {

	 		$datetour =  new DateTime(  $row["date_tour"] , new DateTimeZone('Europe/Lisbon'));

	 		$datetourrealized = new DateTime(  $row["date_tour"] , new DateTimeZone('Europe/Lisbon'));

	 		$datetourrealized->add(new DateInterval('PT'.$hoursconfirmed.'H'));
			$receipt = Receipt::getReceiptById($row["id_receipt"]);
	 		$output =    "<br><br>";
	 		$output .= "Tour Id: ".$row["id_tour"]." <br>";
	 		$output .= "Estado Tour: ".$row["tourstate"]."<br>";
	 		$output .= "Estado Recebimento: ".$receipt['state']."<br>";
	 		$output .= "Estado: ".$row["transactionstate"]."<br>";
			$output .= "Verfica tours   que entram em execução:<br>";

			$now = new DateTime("2017-11-05 15:25");

			echo 			$output;
	   	// Verifica se a data do tour está dentro do periodo de execução e actualiza o estado tour execução 1 na db
			if(  $now >= $datetour  &&  $now < $datetourrealized && $row["tourstate"]==0){

			 	SELF::updateStateInTour($row["id_tour"]);

			 	Receipt::updateState($row["id_receipt"],1);

			 	Transaction::updateStatePendent($row["id_transaction"]);

			 	echo 		" - Tour  começou a ser executado.";
			}


			echo "<br>"; echo "Verfica tours realizados: <br>";

			// Verifica se data do tour passou o perido de execução e actualiza na db o estado tour  realizado 2

			if($now >= $datetourrealized &&   $row["tourstate"]==1){

				 SELF::updateStateRealized($row["id_tour"]);

				 echo " - Tour  realizada por meio automatico.";

				 //   Transaction::updateStateCompleted($row["id_transaction"]);

				 Receipt::updateState($row["id_receipt"],1); echo "Tour realizada.";

		   }
			 $output = "Estado Tour: ".$row["tourstate"]."<br>";
 	 		$output .= "Estado Recebimento: ".$receipt['state']."<br>";
 			$output .= "Estado: ".$row["transactionstate"]."<br>";$output .= "Id: ".$row["id_receipt"]."<br>";
			echo $output; $state= '1';
     
    }



 /*
		if($row['tourstate']==0 || $row['tourstate']==1)  {
			Transaction::updateStatePendent($row["id_transaction"]);
			Receipt::updateState($row["id_receipt"],1);
		} */
	mysqli_close($conn);

}

public static function processTourNotRealized($id_tour, $id_receipt,$id_transaction){
	SELF::updateStateNotRealized($id_tour);
	Receipt::updateState($id_receipt,3);
	Transaction::updateStateNotCompleted($id_transaction);
}




public static function showTableToursBuyer(){

  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-tours">';
    echo  "<thead>
            <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Nome</th>
			<th class='text-center'>Data de realização</th>
            <th class='text-center'>Duração</th>
            <th class='text-center'>Preço de Venda</th>
            <th class='text-center'>Anunciante</th>
			<th class='text-center'>Data de colocação</th>
			<th class='text-center'>Estado</th>
			<th class='text-center'>Comprar</th>
            </tr>
          </thead>";
    echo "<tbody>";
	$count = 1;
    $tours =  self::getTours();
	$arrayTotal = count($tours); echo "Total de tours: ".$arrayTotal."<br>";

    while($count!=$arrayTotal-12){
		$sold = '<span class="label label-success">Disponivel</span>';
		if($tours[$count]['sold']==1) $sold = '<span class="label label-danger">Vendido</span>';
		$id_user = $tours[$count]['id_user']; $user = User::getUserById($id_user);
        echo '<tr class="odd gradeX" data-id=1 data-toggle="modal" data-target="#myModal" type="submit">';
		 echo "<td>".$tours[$count]['id_tour']." <input name=".$tours[$count]['id_tour']." type='hidden'></td>";
		 echo "<td class='text-center'>".$tours[$count]['name']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['date']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['duration']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['price']."€</td>";


		 echo "<td class='text-center'>".$user['name']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['timecreated']."</td>";
		 echo "<td class='text-center'>".$sold."</td>";

		 echo "<td class='text-center'>";


 		if($tours[$count]['sold']==0){
		  echo '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Acções
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Usar o saldo</a>
                                        </li>
                                        <li><a href="#">Usar o Paypal</a>
                                        </li>

   									<!--    <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>  -->
                                    </ul>
                                </div>
                            </div>';

		}else{  echo "Não disponivel"; }

		echo "</td>";
	   echo  "</tr>";
	   $count++;
	}

	echo "</tbody>";

	echo "</table>";

}

public static function showTableToursBuyerViewMore(){

  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-tours">';
    echo  "<thead>
            <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Nome</th>
			<th class='text-center'>Data de realização</th>
            <th class='text-center'>Duração</th>
            <th class='text-center'>Preço de Venda</th>
            <th class='text-center'>Anunciante</th>
			<th class='text-center'>Data de colocação</th>
			<th class='text-center'>Estado</th>
            </tr>
          </thead>";
    echo "<tbody>";
	$count = 1;

    $tours =  self::getTours();
	$arrayTotal = count($tours); echo "Total de tours: ".$arrayTotal."<br>";


    while($count!=$arrayTotal-12){
        $sold = '<span class="label label-success">Disponivel</span>';
		if($tours[$count]['sold']==1){ $sold = '<span class="label label-danger">Vendido</span>'; }

		echo '<tr class="odd gradeX">';
		echo "<td>".$tours[$count]['id_tour']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['name']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['date']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['duration']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['price']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['id_user']."</td>";
		 echo "<td class='text-center'>".$tours[$count]['timecreated']."</td>";
		 echo "<td class='text-center'>".$sold."</td>";
	   echo  "</tr>";
	   $count++;
	}

	echo "</tbody>";

	echo "</table>";

}





}

?>
