 <?php 
session_start();  
 ?>
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
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="form.css" rel="stylesheet">

	<link href="../../dist/css/navbar-main.css" rel="stylesheet" type="text/css">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
</head>


<body>


   

       
	   
   
<?php  //  include("resources/navbar-small.php"); ?>                           
<div class="container">
  <div class="header">		
	  <div class="row">
       <div class="col-lg-12">                    
		 <h1>Adminstração</h1>
       </div>
       <!-- /.col-lg-12 -->
     </div>
  </div>
</div>

<div class="container">
  <div class="main">
       <div class="row">
            <div class="col-md-4 col-md-offset-4">
  <form class="form form-validate floating-label"   autocomplete="off" novalidate="novalidate">
						<div class="card">
							<div class="card-body">
								<div class="form-group">
									<input type="text" class="form-control" id="Name1" name="Name1"  required="" data-rule-minlength="2" aria-required="true">
									<label id="nametour"  for="Name1">Name</label>
								</div>
								<div class="form-group">
									<input type="email" class="form-control" id="Email1" name="Email1" required="" aria-required="true">
									<label  for="Email1">Email</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="Password1" name="Password1" required="" data-rule-minlength="5" aria-required="true">
									<label for="Password1">Password</label>
								</div>
								<div class="form-group">
									<select id="select1" name="select1" class="form-control" required="" aria-required="true">
										<option value="">&nbsp;</option>
										<option value="30">30</option>
										<option value="40">40</option>
										<option value="50">50</option>
										<option value="60">60</option>
										<option value="70">70</option>
									</select>
									<label for="select1">Select</label>
								</div>
								<div class="form-group">
									<textarea name="textarea1" id="textarea1" class="form-control" rows="3" required="" aria-required="true"></textarea>
									<label for="textarea1">Textarea</label>
								</div>
								<div class="form-group">
									<div class="checkbox checkbox-styled">
										<label>
											<input type="checkbox" name="terms1" required="" aria-required="true">
											<span>I have read and accept the term.</span>
										</label>
									</div>
								</div>
							</div><!--end .card-body -->
							<div class="card-actionbar">
								<div class="card-actionbar-row">
									<button type="submit" class="btn btn-flat btn-primary ink-reaction">Validate</button>
								</div>
							</div><!--end .card-actionbar -->
						</div><!--end .card -->
						<em class="text-caption">Basic validation</em>
					</form>	
	</div>
		 </div>
	   <!-- /.row -->
	              
    <!-- /#page-wrapper -->
	</div>

       <!-- jQuery -->
    <!-- <script src="../../vendor/jquery/jquery.min.js"></script> -->
	<script>
	function clearForm(){
		document.getElementById("register-user-form").reset();
	}
	</script>

     <script src="../../vendor/jquery/jquery.min.js"></script>
	
<script>
 $(document).ready(function(){
   	$('#Name1').focus( function(){
	    //  $('label').next('div').addClass('.floating-label ');  
	 	  $('#nametour').css('top', "0px");		  
		  $('#nametour').css('font-size', "13px");		  $('#nametour').css('font-weight', "normal");		  
		  $(this).css('padding', "0"); 	  $('#nametour').css('color', "#0aa89e"); 	
		  
	});	
	
	$('#nametour').css('color', "rgba(12, 12, 12, 0.12)"); 
	
	
	
	$('#Name1').blur( function(){
	 /*   $('#nametour').css('top', "25px");
		$('#nametour').css('font-size', "16px"); */		
		
		if( !$(this).val() == "" ){
			
		   $('#nametour').css('top', "0px");		  
		   $('#nametour').css('font-size', "13px");  $('#nametour').css('color', "#0aa89e"); 
		   
		} else {
		   $('#nametour').css('top', "25px");
		   $('#nametour').css('font-size', "16px");  $('#nametour').css('color', "rgba(12, 12, 12, 0.29)"); 
		}		
	}); 
	
	
	
	 
	
	$('textarea').focus( function(){
	   
	   //  $('label').next('div').addClass('.floating-label ');  
		  $('label').css('top', "0px");
		  $('label').css('font-size', "13px");		  
		  $(this).css('padding', "0");
	});
	$('textarea').blur( function(){
	    //  $('label').next('div').addClass('.floating-label ');  
		  $('label').css('top', "19px");
		  $('label').css('font-size', "16px"); 		  
	});
	
	
	
	
	 
});	
	
	</script>
	
	
	
	<!-- Bootstrap Core JavaScript -->
   <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script> 

    <!-- Metis Menu Plugin JavaScript -->
   

    <!-- Custom Theme JavaScript -->
   <!--  <script src="../dist/js/sb-admin-2.js"></script>-->

</body>

</html>
