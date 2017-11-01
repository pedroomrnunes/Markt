<?php

function showTransactionsTable(){

    $transactions =   Transaction::getTransactions();

    $total = count($transactions);




  echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-tours" style="font-size: 12px;">';
    echo  "<thead>
            <tr>
			<th class='text-center'>#</th>
			<th class='text-center'>Prestador de Serviços </th>
			<th class='text-center'>Angariador</th>
			<th class='text-center'>Preço de Compra</th>
			<th class='text-center'>Comissão FindTour</th>
			<th class='text-center'>Comissão Angariador</th>
			<th class='text-center'>Anuncio</th>
			<th class='text-center'>Estado Tour</th>
			<th class='text-center'>Estado Anuncio</th>
			<th class='text-center'>Estado Transacção</th>
      <th class='text-center'>Estado Pagamento</th>
      <th class='text-center'>Estado Recebimento</th>
      <th class='text-center'>Processar Recebimento</th>
      <th class='text-center'>Processar Tour Não Realizada</th>
      <th class='text-center'>Data de Registo</th>
      </tr>
          </thead>";
    echo "<tbody>";

	$count = 0;
  while($count!=$total){



	  $id_annoucement =  $transactions[$count]["id_annoucement"];
    $id_buyer = $transactions[$count]["id_buyer"];
    $id_receipt =  $transactions[$count]["id_receipt"];
    $id_payment =  $transactions[$count]["id_payment"];



    $annoucement = Annoucement::getAnnoucementById($id_annoucement);
    $receipt = Receipt::getReceiptById($id_receipt);
    $payment = Payment::getPaymentById($id_payment);
    $id_tour = $annoucement['id_tour'];  $tour = Tour::getTourById($id_tour);

    $comission_markt   =  ComissionMarkt::getComissionMarktById($annoucement['id_comission_markt']);

    $comission_vendor = ComissionVendor::getComissionById($annoucement['id_comission_vendor']);

    $comission_buyer   = ComissionBuyer::getComissionById($annoucement['id_comission_buyer']);

    $value_markt =     $comission_markt['value'];

    $value_buyer = $comission_buyer['value'];

    $value_vendor = $comission_vendor['value'];


    $tour_state = $tour['state'];

    $annoucement_state  =  $annoucement['state'];

    $state_transaction = $transactions[$count]["state"];

    $payment_state =  $payment['payment_status'];

    $receipt_state = $receipt['state'];

    $buyer = User::getUserById($transactions[$count]['id_buyer']);

    $vendor = User::getUserById($annoucement['id_user']);

    switch ($tour['state']){

        case 0:  $tour_state =  '<span class="label label-info">Tour Não Iniciada</span>';					     break;
        case 1:  $tour_state = '<span class="label label-info">Tour Iniciada</span>';					         break;
        case 2:  $tour_state = '<span class="label label-success">Tour Realizada</span>'; 						       break;
        case 3:  $tour_state =  '<span class="label label-danger">Tour Não Realizada</span>';					   break;
    }

    switch ($annoucement['state']){

        case 1:  $annoucement_state = '<span class="label label-success">Disponivel</span>';					         break;
        case 2:  $annoucement_state = '<span class="label label-info">Vendido</span>'; 						       break;
        case 3:  $annoucement_state =  '<span class="label label-danger">Expirado</span>';					   break;

    }


    switch ($transactions[$count]["state"]){

        case 0:  $state_transaction = '<span class="label label-info">Pendente</span>';					         break;
        case 1:  $state_transaction = '<span class="label label-success">Concluida</span>'; 						       break;
        case 2:  $state_transaction =  '<span class="label label-danger">Não Concluida</span>';					   break;

    }

    switch ($payment['payment_status']){

        case 0:  $payment_state = '<span class="label label-info">Pendente</span>';					         break;
        case 1:  $payment_state = '<span class="label label-success">Pago</span>'; 						       break;
        case 2:  $payment_state =  '<span class="label label-danger">Não Pago</span>';					   break;

    }

    switch ($receipt['state']){

        case 0:  $receipt_state = '<span class="label label-info">Pendente</span>';					         break;
        case 1:  $receipt_state = '<span class="label label-info">Em Processamento</span>'; 						       break;
        case 2:  $receipt_state =  '<span class="label label-success">Recebido</span>';					   break;
        case 3:  $receipt_state =  '<span class="label label-danger">Não Recebido</span>';					   break;
    }

    echo '<tr class="odd gradeX" data-id=1 data-toggle="modal" data-target="#modalTransactions" type="submit">';
		 echo "<td class='text-center'>".$transactions[$count]["id_transaction"]."</td>";
     echo "<td class='text-center'>".$buyer['name']."</td>";
     echo "<td class='text-center'>".$vendor['name']."</td>";
     echo "<td class='text-center'>".$value_buyer."€</td>";
     echo "<td class='text-center'>".$value_markt."€</td>";
     echo "<td class='text-center'>".$value_vendor."€</td>";
     echo "<td class='text-center'>Anuncio</td>";
     echo "<td class='text-center'>".$tour_state."</td>";
     echo "<td class='text-center'>".$annoucement_state."</td>";
     echo "<td class='text-center'>".$state_transaction."</td>";
     echo "<td class='text-center'>".$payment_state."</td>";
     echo "<td class='text-center'>".$receipt_state."</td>";
     echo "<td class='text-center'><a href='user-g.php?q=".$transactions[$count]["id_transaction"]."'>Processar Recebimento</a></td>";
     echo "<td class='text-center'><a href='user-g.php?q=".$transactions[$count]["id_transaction"]."'>Processar Tour Não Realizada</a></td>";
		 echo "<td class='text-center'>".$transactions[$count]["timecreated"]."</td>" ;
		echo  "</tr>";

	   $count++;
	}

	echo "</tbody>";
	echo "</table>";


  return $total;
}

?>
