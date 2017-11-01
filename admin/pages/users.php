<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <?php  include("resources/header.php"); getHeader("Admin","Utilizadores","author","") ?>

</head>

<body>

    <?php  include("resources/navbar-main.php"); ?>




<div class="container">
  <div class="header">
	  <div class="row">
       <div class="col-lg-12">
		 <h1>Utilizadores</h1>
       </div>
       <!-- /.col-lg-12 -->
     </div>
  </div>
</div>

<div class="container">
  <div class="main">
            <div class="row" >
                <div class="col-lg-12">
								  <?php
									include("../conn.php");
									include("../../lib/Transaction.php");
									include("../../lib/User.php");
									include("../../lib/Tour.php");
									include("../../lib/Annoucement.php");
									include("../../lib/ComissionVendor.php");
									include("../../lib/ComissionBuyer.php");
									include("../../lib/FbAccount.php");
									include("../../lib/GoogleAccount.php");
									include("user-table.php");
								echo "<a name='order' href='annoucements.php'>Ordenar</a>";

									$offset =0;		 $limit = 15;  //   $action = mysqli_real_escape_string($conn ,$action);
								    $conn = connect();  //		$sort = $action['sort'];  		$order = $action['order'];

									  	if(isset($_POST['order'])) $action = $_POST['order']; else $action= "pricetourASC";

									$arrayOrder =  array();

									 if( isset($_GET['order'])){
									// 	$action =   mysqli_real_escape_string($conn ,$_GET['order']);


										$arrayOrder = getNamesOrder($action); var_dump($arrayOrder);
										$order =    $arrayOrder['order']; $sort = $arrayOrder['sort'];
									  }else{
										  $order = "tour.date_tour"; $sort ="ASC";
									  }
									//  $order='name_tour'; $sort= 'ASC';


									$users = User::getUsers();
									$total_records   = count($users);
									$total_pages = ceil($total_records / $limit);
									$page= isset($_GET['page']) ? mysqli_real_escape_string($conn, $_GET['page']) : 1;
									if($total_records!=0){
									  echo "<br> Total registos: ".$total_records." Total paginas: ".$total_pages." Limite: ".$limit;
									    for ($i=1; $i<=$total_pages; $i++) {

										  if($page==$i){
										//	echo "Page: ".$page." i: ".$i." Offset: ".$offset." Limit: ".$limit." <br>";
											showUsersTable();
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
     <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../../vendor/simple-pagination/jquery.simplePagination.js"></script>
    <!-- Custom Theme JavaScript -->
	<script src="../../dist/js/sb-admin-2.js"></script>
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
