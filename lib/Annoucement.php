<?php

class Annoucement{
/*
private $Annoucement = array();
private $id, $name,$description, $departure_place, $date, $departure_hour, $duration, $price, $id_user;
*/




public static function getAnnoucements(){
	$conn = connect();

	$query = "SELECT id_annoucement, id_tour, id_user, id_client, id_comission_buyer, id_comission_vendor, id_comission_markt, timecreated, active, state  FROM annoucement WHERE active=1";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$count = 0;

	$annoucements = array();

	while ($row = mysqli_fetch_assoc($result)) {
    // echo $row["id_annoucement"]." ".$row["name"]." ".$row["id_user"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["id_client"];
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_user"] = $row["id_user"];
	 $annoucements[$count][$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
     $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $annoucements[$count]["state"] = $row["state"];
	 $count++;
	}
	mysqli_close($conn);
	return $annoucements;
}

public static function getAnnoucementsTable($offset,$limit){
	$conn = connect();

	$query = "SELECT id_annoucement, id_tour, id_user, id_client, id_comission_buyer, id_comission_vendor, id_comission_markt, timecreated, state , active
	FROM annoucement WHERE active=1  LIMIT {$limit}      OFFSET {$offset}  ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$count = 0;

	$annoucements = array();

	while ($row = mysqli_fetch_assoc($result)) {
    // echo $row["id_annoucement"]." ".$row["name"]." ".$row["id_user"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["id_client"];
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_user"] = $row["id_user"];
	 $annoucements[$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
     $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $annoucements[$count]["state"] = $row["state"];
	 $count++;
	}
	mysqli_close($conn);
	return $annoucements;
}

public static function getAnnoucementsTableOrder($offset,$limit, $order, $sort){
	$conn = connect();




	$query = "SELECT annoucement.id_annoucement, annoucement.id_tour, tour.name_tour, annoucement.id_user, annoucement.id_client, annoucement.id_comission_buyer, annoucement.id_comission_vendor, annoucement.id_comission_markt,
         annoucement.timecreated, annoucement.state , annoucement.active
         FROM annoucement
         Inner JOIN tour ON annoucement.id_tour = tour.id_tour
         WHERE annoucement.active=1  ORDER BY {$order} {$sort} LIMIT {$limit}  OFFSET {$offset} ";



	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$count = 0;

	$annoucements = array();

	while ($row = mysqli_fetch_assoc($result)) {
    // echo $row["id_annoucement"]." ".$row["name"]." ".$row["id_user"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["id_client"];
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_user"] = $row["id_user"];
	 $annoucements[$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
     $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $annoucements[$count]["state"] = $row["state"];
	 $count++;
	}
	mysqli_close($conn);
	return $annoucements;
}



public static function    getAnnoucementsTableFilter($offset,$limit, $datemin,$datemax, $state,$pricemin, $pricemax){

	//  echo $offset."<br>".$limit."<br>".$datemin."<br>".$datemax."<br>".$state."<br>".$pricemin."<br>".$pricemax;

	$conn = connect();

	$query = "SELECT annoucement.id_annoucement, annoucement.id_tour, tour.name_tour, annoucement.id_user, annoucement.id_client, annoucement.id_comission_buyer, annoucement.id_comission_vendor, annoucement.id_comission_markt,
         annoucement.timecreated, annoucement.state , annoucement.active
         FROM annoucement
         Inner JOIN tour ON annoucement.id_tour = tour.id_tour
         WHERE annoucement.active=1  ";


	if($state!=null && $state != 0 ){
		$query .= " AND annoucement.state = {$state} ";
	}

	if($datemin!=null && $datemax!=null){
		$query .= " AND  tour.date_tour > '{$datemin}' AND tour.date_tour < '{$datemax}' ";
	}

	if($pricemin!=null && $pricemax!=null){
		$query .= "AND tour.price > {$pricemin} AND tour.price < {$pricemax} ";
	}

	$query .= " LIMIT {$limit}  OFFSET {$offset} ";


	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$count = 0;

	$annoucements = array();

	while ($row = mysqli_fetch_assoc($result)) {
    // echo $row["id_annoucement"]." ".$row["name"]." ".$row["id_user"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["id_client"];
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_user"] = $row["id_user"];
	 $annoucements[$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
     $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $annoucements[$count]["state"] = $row["state"];
	 $count++;
	}
	mysqli_close($conn);
	return $annoucements;

}

public static  function getAnnoucementById($id){
	$conn = connect();
	$query = "SELECT id_annoucement, id_tour, id_user, id_client, id_comission_buyer, id_comission_vendor, id_comission_markt, timecreated, active, state
	 FROM annoucement WHERE id_annoucement ='{$id}' LIMIT 1 ";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$annoucement = array();

	while ($row = mysqli_fetch_assoc($result)) {
     // echo $row["id_annoucement"]." ".$row["name"]." ".$row["id_user"]." ".$row["departure_place"]." ".$row["date"]." ".$row["departure_hour"]." ".$row["id_client"];
	 $annoucement["id_annoucement"] = $row["id_annoucement"];
	 $annoucement["id_tour"] = $row["id_tour"];
	 $annoucement["id_user"] = $row["id_user"];
	 $annoucement["id_client"] = $row["id_client"];
	  $annoucement["id_comission_buyer"] = $row["id_comission_buyer"];
	   $annoucement["id_comission_vendor"] = $row["id_comission_vendor"];
	    $annoucement["id_comission_markt"] = $row["id_comission_markt"];
		$annoucement["state"] = $row["state"];
     $annoucement["timecreated"] = $row["timecreated"];
	 $annoucement["active"] = $row["active"];
    }

	mysqli_close($conn);

	return $annoucement;
}

public static  function getAnnoucementsActive(){
	$conn = connect();

	$query = "SELECT id_annoucement, id_tour, id_user, id_client, id_comission_buyer, id_comission_vendor, id_comission_markt,  timecreated, active
	FROM annoucement WHERE active=1";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	$annoucements = array();
	$count=0;
	while ($row = mysqli_fetch_assoc($result)) {
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_user"] = $row["id_user"];
	 $annoucements[$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
	 $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $count++;
    }


	mysqli_close($conn);
	return $annoucements;
}


public function getAnnoucementsActiveByVendor($id_user){
	$conn = connect();

	$query = "SELECT id_annoucement, id_tour, id_user, id_client, id_comission_buyer, id_comission_vendor, id_comission_markt,  timecreated, active, state
	FROM annoucement WHERE id_user = '{$id_user}'   AND active=1";

	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));
	$annoucements = array();
	$count=0;
	while ($row = mysqli_fetch_assoc($result)) {
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_user"] = $row["id_user"];
	 $annoucements[$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
	 $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $annoucements[$count]["state"] = $row["state"];
	 $count++;
    }


	mysqli_close($conn);
	return $annoucements;
}

public function getAnnoucementsTableByVendor($id_user, $offset, $limit){
	$conn = connect();

	$query = "SELECT id_annoucement, id_tour,	    id_client, id_comission_buyer, id_comission_vendor, id_comission_markt,  timecreated, active, state
	FROM annoucement WHERE   id_user = '{$id_user}' AND active=1  LIMIT {$limit} OFFSET {$offset} ";

	$result =  mysqli_query($conn,$query) or die ("  didn't query".mysqli_error($conn));
	$annoucements = array();
	$count=0;
	while ($row = mysqli_fetch_assoc($result)) {
	 $annoucements[$count]["id_annoucement"] = $row["id_annoucement"];
	 $annoucements[$count]["id_tour"] = $row["id_tour"];
	 $annoucements[$count]["id_client"] = $row["id_client"];
	 $annoucements[$count]["id_comission_buyer"] = $row["id_comission_buyer"];
	 $annoucements[$count]["id_comission_vendor"] = $row["id_comission_vendor"];
	 $annoucements[$count]["id_comission_markt"] = $row["id_comission_markt"];
	 $annoucements[$count]["timecreated"] = $row["timecreated"];
	 $annoucements[$count]["active"] = $row["active"];
	 $annoucements[$count]["state"] = $row["state"];
	 $count++;
    }


	mysqli_close($conn);
	return $annoucements;
}

public static function insertAnnoucement($id_tour, $id_user){

	$conn = connect();

	$query = "INSERT INTO annoucement (id_tour, id_user, timecreated)
		VALUES ( '{$id_tour}', '{$id_user}', CURRENT_TIMESTAMP  )";

	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$id = mysqli_insert_id($conn);
	echo "Id Annoucement: ".$id."<br>";

	echo "Registo guardado.";

	mysqli_close($conn);

	return $id;
}

public static function insertAnnoucementComplete($id, $id_tour, $id_user, $id_client, $id_comission_buyer, $id_comission_vendor, $id_comission_markt ){
    $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
	$conn = connect();



	$query = "INSERT INTO annoucement (id_annoucement, id_tour, id_user, id_client, id_comission_buyer, id_comission_vendor, id_comission_markt,  timecreated, active, state
	VALUES ('{$id}', '{$id_user}', '{$id_client}',    '{$id_comission_buyer}', '{$id_comission_vendor}', '{$id_comission_markt}', '{$now}', 1, 1  )";

	//run query
	mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	$id = mysqli_insert_id($conn);
	echo "Id Annoucement: ".$id."<br>";

	echo "Registo guardado.";

	mysqli_close($conn);

	return $id;


}

public static function updateClient($id_annoucement, $id_client ){

	$query = "UPDATE annoucement  SET  id_client= '{$id_client}' WHERE	id_annoucement = '{$id_annoucement}'  ";


    //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate id cliente no annoucement guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function updateComissions($id_annoucement, $id_comission_buyer, $id_comission_vendor, $id_comission_markt ){

	$query = "UPDATE annoucement  SET  id_comission_buyer='{$id_comission_buyer}',  id_comission_vendor='{$id_comission_vendor}',
	id_comission_markt='{$id_comission_markt}' WHERE id_annoucement = '{$id_annoucement}'  ";


    //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate id comissoes no annoucement guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function updateActive($id){

	$query = "UPDATE annoucement  SET  active = 1  WHERE	id_annoucement = '{$id}' ";


    //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate id cliente no annoucement guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function showTableAnnoucementsBuyer(){

  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-Annoucements">';
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
    $Annoucements =  self::getAnnoucements();
	$arrayTotal = count($Annoucements); echo "Total de Annoucements: ".$arrayTotal."<br>";

    while($count!=$arrayTotal-12){
		$sold = '<span class="label label-success">Disponivel</span>';
		if($Annoucements[$count]['sold']==1) $sold = '<span class="label label-danger">Vendido</span>';
		$id_user = $Annoucements[$count]['id_user']; $user = User::getUserById($id_user);
        echo '<tr class="odd gradeX" data-id=1 data-toggle="modal" data-target="#myModal" type="submit">';
		 echo "<td>".$Annoucements[$count]['id_annoucement']." <input name=".$Annoucements[$count]['id_annoucement']." type='hidden'></td>";
		 echo "<td class='text-center'>".$Annoucements[$count]['name']."</td>";
		 echo "<td class='text-center'>".$Annoucements[$count]['date']."</td>";
		 echo "<td class='text-center'>".$Annoucements[$count]['id_client']."</td>";
		 echo "<td class='text-center'>".$Annoucements[$count]['price']."€</td>";


		 echo "<td class='text-center'>".$user['name']."</td>";
		 echo "<td class='text-center'>".$Annoucements[$count]['timecreated']."</td>";
		 echo "<td class='text-center'>".$sold."</td>";

		 echo "<td class='text-center'>";


 		if($Annoucements[$count]['sold']==0){
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

public static function showTableAnnoucementsBuyerViewMore(){

  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-Annoucements">';
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

    $Annoucements =  self::getAnnoucements();
	$arrayTotal = count($Annoucements); echo "Total de Annoucements: ".$arrayTotal."<br>";


    while($count!=$arrayTotal-12){
        $sold = '<span class="label label-success">Disponivel</span>';
		if($Annoucements[$count]['sold']==1){ $sold = '<span class="label label-danger">Vendido</span>'; }

		echo '<tr class="odd gradeX">';
		echo "<td>".$Annoucements[$count]['id_annoucement']."</td>";
		 echo "<td class='text-center'>".$annoucement[$count]['name']."</td>";
		 echo "<td class='text-center'>".$annoucement[$count]['date']."</td>";
		 echo "<td class='text-center'>".$annoucement[$count]['id_client']."</td>";
		 echo "<td class='text-center'>".$annoucement[$count]['price']."</td>";
		 echo "<td class='text-center'>".$annoucement[$count]['id_user']."</td>";
		 echo "<td class='text-center'>".$annoucement[$count]['timecreated']."</td>";
		 echo "<td class='text-center'>".$sold."</td>";
	   echo  "</tr>";
	   $count++;
	}

	echo "</tbody>";

	echo "</table>";

}

public static function checkExpired($date){

  $expired = false;

  $date = new DateTime($date, new DateTimeZone('Europe/Lisbon'));

  //      echo $now->format('Y-m-d H:i:s')."<br>";

  if( $now >= $date){

  $expired = true;  //   echo "Expirado Data";

  }else{
	  //   echo "Disponivel";
  }

   return $expired;        //  echo "<br><br>"."Data Tour: ".$date->format('Y-m-d')." Hoje: ".$now->format('Y-m-d')."<br>";

}

public static function setAvaiable($id_annoucement){

	$query = "UPDATE annoucement  SET  state = 1 WHERE	id_annoucement = '{$id_annoucement}' ";


    //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Upadate id cliente no annoucement guardado: ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function setSold($id_annoucement){

	$query = "UPDATE annoucement  SET  state = 2 WHERE	id_annoucement = '{$id_annoucement}' ";


    //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	  echo "Actualização do estado do Tour: vendido. ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function setExpired($id_annoucement){

	$query = "UPDATE annoucement  SET  state = 3 WHERE	id_annoucement = '{$id_annoucement}'  ";


    //run query
	$conn = connect();

	if(mysqli_query($conn, $query)){

	   //   echo "Actualização do estado Tour : expirado. ";

    }else{

	  die ("didn't query".mysqli_error($conn));
	}

	mysqli_close($conn);
  }

public static function checkToursExpired(){

	$query = "SELECT annoucement.id_annoucement, tour.id_tour, tour.date_tour
	FROM annoucement INNER JOIN tour on annoucement.id_tour=tour.id_tour
	WHERE annoucement.active =1 AND annoucement.state=1 ";

	$existExpired = false;
    $now = new DateTime("now", new DateTimeZone('Europe/Lisbon') );
	$conn = connect();
	//  $now = new DateTime("2017-11-24 15:20:00", new DateTimeZone('Europe/Lisbon') ); $date = new DateTime("2017-11-25 20:25:00", new DateTimeZone('Europe/Lisbon') );      echo ($dt->days*24*60)." ".($dt->h*60)." ".$dt->i;


	$result =  mysqli_query($conn,$query) or die ("didn't query".mysqli_error($conn));

	//  $dt = $now->diff($date);   $daysinminutes = $dt->days*24*60;             $hoursinminutes = $dt->h*60;              $minutes = $dt->i;

	$annoucements = array();

	while ($row = mysqli_fetch_assoc($result)) {

	  $id_annoucement = $row["id_annoucement"];

	  $id_tour = $row["id_tour"];

	  $date = new DateTime( $row["date_tour"] );
	/*  $dt = $date->diff($now);   $daysinminutes = $dt->days*24*60;             $hoursinminutes = $dt->h*60;              $minutes = $dt->i;
	 $totalminutes = ($daysinminutes + $hoursinminutes + $hoursinminutes)/(24*60);  echo $totalminutes; */

	 if($now>$date){
	     SELF::setExpired($id_annoucement);
	  	 //  echo "<br> Data do anuncio com Id: ".$id_annoucement." expirou.<br>";
	 }else{
		  //   echo "Nao expirou";
	 }


	}

	mysqli_close($conn);

	return $existExpired;
  }

}

?>
