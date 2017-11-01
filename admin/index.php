<?php
 session_start();

 include("conn.php");

 include("../lib/User.php");
 include("../lib/Tour.php");
 include("../lib/Annoucement.php");
 include("../lib/Transaction.php");

 include("../lib/ComissionVendor.php");
 include("../lib/ComissionMarkt.php");
 include("../lib/ComissionBuyer.php");

 include("../lib/Payment.php");
 include("../lib/Receipt.php");
include("../lib/Admin.php");

 include("pages/resources/transactions-table.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <?php  include("header.php");   getHeader("Admin","Utilizadores","author","") ?>

</head>

<body>

    <?php  include("pages/resources/navbar-main.php"); ?>




<div class="container" style="width: 1350px;">
  <div class="header">
	  <div class="row">
       <div class="col-lg-12">
		 <h1>Transacções</h1>
       </div>
       <!-- /.col-lg-12 -->
     </div>
  </div>
</div>

<div class="container" style="width: 1350px;" >
  <div class="main">
            <div class="row" >
                <div class="col-lg-12">


              <?php

                  $total_completed = Admin::getTotalComissionMarktCompleted();
                  $total_payed = Admin::getTotalComissionMarktPayed();

                echo '<div class="row" >
                    <div class="col-lg-2">';


                  echo "Total Comissões FindTour: <br>"; echo   "- Transacções concluidas : ".$total_completed."€<br>";
                  echo "- Pagas:  ".$total_payed."€<br><br>"; echo '</div>';

                echo    '  <div class="col-lg-2">';
                  echo "Número de Tours: <br>";
                  echo "- Não Iniciadas: ".Admin::getNTours(0)."<br>";
                  echo "- Iniciadas: ".Admin::getNTours(1)."<br>";
                  echo "- Realizadas: ".Admin::getNTours(2)."<br>";
                  echo "- Não Realizadas: ".Admin::getNTours(3)."<br>";
                echo '</div>';

                echo    '  <div class="col-lg-2">';
                  echo "Número de Anuncios:  <br>";
                  echo "- Anunciados: ".Admin::getNAnnoucements(1)."<br>";
                  echo "- Vendidos: ".Admin::getNAnnoucements(2)."<br>";
                  echo "- Expirados:  ".Admin::getNAnnoucements(3)."<br>";
                echo '</div>';
                echo    '  <div class="col-lg-2">';
                  echo "Número de Transacções:  <br>";
                  echo "- Pendentes: ".Admin::getNTransactions(0)."<br>";
                  echo "- Concluídas:  ".Admin::getNTransactions(1)."<br>";
                  echo "- Não Concluídas: ".Admin::getNTransactions(2)."<br>";
                echo '</div>';
                echo    '  <div class="col-lg-2">';
                  echo "Número de Pagamentos:  <br>";
                  echo "- Não Pagos: ".Admin::getNPayments(0)."<br>";
                  echo "- Pagos: ".Admin::getNPayments(1)."<br>";
                  echo "- Reembolsos: ".Admin::getNPayments(2)."<br>";
                echo '</div>';
                echo    '  <div class="col-lg-2">';
                  echo "Número de Recebimentos: <br>";
                  echo "- Pendentes: ".Admin::getNReceipts(0)."<br>";
                  echo "- Em processamento: ".Admin::getNReceipts(1)."<br>";
                  echo "- Recebidos: ".Admin::getNReceipts(2)."<br>";
                  echo "- Não Recebidos: ".Admin::getNReceipts(3)."<br>";
                echo '</div>';
              echo '</div>';

                  $offset =0;		 $limit = 15;


                  $conn = connect();

								    $transactions = Transaction::getTransactions();

                  $total_records   =  count($transactions);

                  $total_pages = ceil($total_records / $limit);

                  $page= isset($_GET['page']) ? mysqli_real_escape_string($conn, $_GET['page']) : 1;


                  if($total_records!=0){
									     echo "<br> Total registos: ".$total_records." Total paginas: ".$total_pages." Limite: ".$limit;

                       for ($i=1; $i<=$total_pages; $i++) {

										     if($page==$i){
										       //	echo "Page: ".$page." i: ".$i." Offset: ".$offset." Limit: ".$limit." <br>";
											      showTransactionsTable();
										     }

										     $offset+= $limit;
										   };

									     $pagLink = "<nav><ul class='pagination hide' >";
									     for ($i=1; $i<=$total_pages; $i++) {

										      $pagLink .= "<li><a href='annoucements.php?&page=".$i."'>".$i."</a></li>";

									     };

									     echo $pagLink . "</ul></nav>";

									     echo "<br> Total registos: ".$total_records." Total paginas: ".$total_pages." Limite: ".$limit;

								   }else{

									   echo "Não foram encotrados registos.";
								   }


								   mysqli_close($conn);
							?>


                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    </div>
</div>
    <!-- jQuery -->
  <!--   <script src="../vendor/jquery/jquery.min.js"></script>  -->
	 <script src="//code.jquery.com/jquery-3.2.1.js"></script>
    <!-- Bootstrap Core JavaScript -->
   <!--  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>  -->
    <!-- Metis Menu Plugin JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!-- DataTables JavaScript -->
  <!--   <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script> -->
	<script src="../../vendor/simple-pagination/jquery.simplePagination.js"></script>
    <!-- Custom Theme JavaScript -->
 <!--	<script src="../../dist/js/sb-admin-2.js"></script> -->
    <!-- <script src="../js/tabela-tours.js"></script> -->

<!--  check jquery version -->
<script>
   $(document).ready(function(){
  $('.pagination').removeClass('hide');
  $('.pagination').pagination({
                    items:   <?php echo $total_records; ?>,
                    itemsOnPage: <?php  echo   $limit; ?>,
                    cssStyle: 'light-theme',
                    currentPage : <?php echo $page; ?>,
                    hrefTextPrefix : 'annoucements.php?page=',
                }); });
/*
if (typeof jQuery != 'undefined') {

    // jQuery is loaded => print the version
    alert(jQuery.fn.jquery);
}
*/
</script>
<script type="text/javascript">
document.getElementById("order").onclick = function() {
    document.getElementById("order").submit();
}
 </script>
	</body>

</html>
