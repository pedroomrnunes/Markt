<?php  session_start(); if(empty($_SESSION['id-user'])){ include('error.php'); exit; }  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">	
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../dist/css/navbar-main.css" rel="stylesheet" type="text/css">
    <!--  Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php  include("resources/navbar-main.php"); ?>        

	
       

        <div class="container">
  <div class="header">		
	  <div class="row">
       <div class="col-lg-12">                    
		 <h3 style="height: 50px;     line-height: 50px;  text-align: center;">DESCRICAO DO ANÚNCIO</h3>
       </div>
       <!-- /.col-lg-12 -->
     </div>  </div>
</div>

<div class="container">
  <div class="main">
   <div class="row" >
                <div class="col-lg-12">
								  <?php										
									$id = 1;	
									
									include("../pages/conn.php");
									
									include("../lib/Annoucement.php");
									include("../lib/User.php");
									include("../lib/Tour.php");
									include("../lib/ComissionBuyer.php"); 
									include("../lib/ComissionVendor.php"); 
									
									include("../lib/Transaction.php");
									include("../lib/Client.php");
									include("../pages/resources/annoucement-description-buy.php");
									
									//	echo '</form>';	
								  ?>
                                    
						
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           

    <!-- jQuery -->

    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
	 <script src="//code.jquery.com/jquery-3.2.1.js"></script> 
    <!-- Bootstrap Core JavaScript -->
   <!--  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- Metis Menu Plugin JavaScript -->
  <!--  <script src="../vendor/metisMenu/metisMenu.min.js"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!-- DataTables JavaScript -->
    <!-- <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>  
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script> -->
	
    <!-- Custom Theme JavaScript -->	
<!--	<script src="../dist/js/sb-admin-2.js"></script> -->
    <!-- <script src="../js/tabela-tours.js"></script> -->
    
<!--  check jquery version -->
<script>

if (typeof jQuery != 'undefined') {
	
    // jQuery is loaded => print the version
    alert(jQuery.fn.jquery);
}
</script>
<script type="text/javascript">
$(function(){
	  $('#myModal').modal({
        keyboard: true,
        backdrop: "static",
        show:false,
      }).on('show', function(){ //subscribe to show method
          var getIdFromRow = $(event.target).closest('tr').data('id'); //get the id from tr      
        $(this).find('#dialog-id').html($('<b> Order Id selected: ' + getIdFromRow  + '</b>'))
      });
});
 </script>	
	</body>
</html>