<?php
include("../lib/Transaction.php"); include("../pages/conn.php");
$id = $_SESSION['id-user'];
$transactionsVendor = Transaction::getTransactionsVendor($id);
$transactionsBuyer = Transaction::getTransactionsBuyer($id);
$nToursVendor = 0; // $nToursVendor = count($transactionsVendor);
$nToursBuyer = 0; // $nToursBuyer = count($transactionsBuyer);
$count = 0;
$length = count($transactionsVendor);


while($count!=$length){
    if($transactionsVendor[$count]['state']==1)
	  $nToursVendor++;
	$count++;
}


$count = 0;
$length = count($transactionsBuyer);

while($count!=$length){
    if($transactionsBuyer[$count]['state']==1)
	  $nToursBuyer++;
	$count++;
}

echo "N Vendor: ".$nToursVendor." N Buyer: ".$nToursBuyer;
$verification = VerificationUser::getVerificationUserByIdUser($id);
Tour::checkToursState();

Tour::checkToursState();
function processToursRealized(){
  $tours_realized =  Tour::getToursRealized();
  $transactions = Transaction::getTransactions();
 foreach($transactions as $transaction){
   foreach($annoucements as $annoucement){
     foreach($tours_realized as $tour){ echo "Id: ".$transaction['id_transaction'];
       if( $annoucement['id_annoucement'] ==  $transaction['id_annoucement'] && $annoucement['id_tour'] ==  $tour['id_tour'] ){
         Transaction::updateStateCompleted($transaction['id_transaction']); echo "Id: ".$transaction['id_transaction'];
       }
     }
   }

 }
}
processToursRealized();

?>
