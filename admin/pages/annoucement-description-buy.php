<?php
include ("../lib/Message.php");
include ("../lib/VerificationUser.php");
$tourname = $tourdescription =  $departureplace = $arrivalplace = $tourdate = $tourhour = $tourduration = $tourprice = null;

$clientname = $clientphone = $clientemail =  $clientcountry = $clientlanguage = null;

$vendorname = $vendorpoints = $vendorranking = $vendorsells = $vendorverified = null;

$annoucementprice = $annoucementdate = $annoucementstate = null;

$transactionstate = $comissionbuyerpayed = null;

$conn = connect();

$annoucementid = mysqli_real_escape_string($conn, $_GET["idannoucement"]); 

mysqli_close($conn);

$annoucement = Annoucement::getAnnoucementById($annoucementid); 
if($annoucement==null) exit;
$tourid = $annoucement['id_tour'];

$tour = Tour::getTourById($tourid);


$tourname = $tour['name'];
$tourdescription = $tour['description'];
$departureplace = $tour['departure_place'];
$arrivalplace = "Not inserted";
$tourdate = $tour['date'];

$tourduration = $tour['duration'];
$tourprice = $tour['price'];
 
$userid = $annoucement['id_user'];
$user = User::getUserById($userid);
$vendorname = $user['name'];
$vendorpoints = $user['points'];
$vendorranking = " ";
 

$transactions = Transaction::getTransactionsByVendor($userid);

$vendorsells =   count( $transactions );

$transaction =   Transaction::getTransactionByAnnoucementId($annoucementid);

$comissionvendorid = $annoucement['id_comission_vendor'];  

$comissionbuyerid = $annoucement['id_comission_buyer']; 
 
$comissionvendor = ComissionVendor::getComissionById($comissionvendorid);

$comissionbuyer = ComissionBuyer::getComissionById($comissionbuyerid);

$comissionvendorreceipt = $comissionvendor['received'];

$comissionbuyerpayed = $comissionbuyer['payed'];

$annoucementprice = $comissionbuyer['value'];

$annoucementdate = $annoucement['timecreated'];    

$annoucementstate = 1;

list($date, $time) = explode(' ', $tour['date']);

list($hour, $min, $sec) = explode(':', $time);

$tourdate = $date;

$tourhour = $hour.":".$min; 

$verification = VerificationUser::getVerificationUserByIdUser($userid);  

if($verification!=null){

   $glyphicon = Message::getVerificationGlyphicon($verification['phone'],$verification['google'],$verification['facebook']);
}



?>


<form id="register-user-form" action="../controllers/payment.php" role="form"  method = "post"> 
<div class="row">
	<div class="col-lg-12">                                
	  <div class="row">
		<div class="col-lg-12">                                
		  <div class="form-group">
            <div class="header-text">TOUR </div>
          <hr class="header-line">		
		  </div>											 					
		</div>
	  </div>
	</div>	
	<!-- Nome -->
<div class="text">	<div class="col-lg-12">                                
	  <div class="row">
		<div class="col-lg-4">                                
		  <div class="form-group">
            <label>Nome: </label>
          <?php echo htmlspecialchars($tourname); ?>					
		  </div>											 					
		</div>
		<div class="col-lg-4">                                
		  
		</div>
	  </div>
	</div>	
	<!-- Descrição -->
	<div class="col-lg-12">                                
	  <div class="row">
		<div class="col-lg-12">                                
		  <div class="form-group">
            <label>Descrição:</label>
			  <?php echo $tourdescription; ?>												                       
			</div>																	
		</div>		
	  </div>						  
	</div>					
	<!-- Local de partida e local de chegada -->
	<div class="col-lg-12">                                
			      <div class="row">
				     <div class="col-lg-6">                                
						<div class="form-group">
                            <label>Local de partida:</label>
							<?php echo $departureplace; ?>
						 </div>						
					</div>

					 <div class="col-lg-6">                                
						<div class="form-group">
							<label>Local de chegada:</label>
							<?php echo $arrivalplace; ?>
					</div>												
				   </div>		
				  </div>
				</div>
				
								<!-- Data, Duracao e Preço -->
	<div class="col-lg-12">                                
			      <div class="row">
				     <div class="col-lg-3">                                
						<div class="form-group">
                            <label>Data:</label>							
								<?php echo $tourdate; ?>
							</div> 
				       </div>
					
					<div class="col-lg-3">                                
						<div class="form-group">
                            <label>Hora de partida:</label>    							
							<?php echo $tourhour; ?> 														
			            </div>	
					</div>																							
					<div class="col-lg-3">                                
						<div class="form-group">
							<label>Duração:</label>						
							<?php echo $tourduration; ?>							
						</div>															
				   </div>
				   <div class="col-lg-3">                                
						<div class="form-group">
							<label>Preço:</label>							
								<?php echo $tourprice."€"; ?>							  
							</div>																													
                        </div>																
				   </div>
				  </div>
</div>
	</div>

	
<div class="row">
<div class="text">
   <div class="col-lg-12">                                
	  <div class="row">
		<div class="col-lg-12">                                
		  <div class="form-group">		   
			<div class="header-text" style="margin-top:15px;">DADOS DO ANGARIADOR </div>
            <hr class="header-line">		
		  </div>											 					
		</div>
	  </div>
    </div>		
	<div class="col-lg-12">                                
		<div class="row">
				     <div class="col-lg-4">                                
						<div class="form-group">
                          <label>Nome: </label>
                          <?php echo $vendorname; ?>					
                        </div>											 					
				   </div>		
				  </div>
				</div>
				<!-- Descrição -->								
	<div class="col-lg-12">                                
			      <div class="row">
				  <div class="col-lg-3">                                
						<div class="form-group">
                            <label>Ranking: </label>							
								<?php echo $vendorranking; ?>					
                          </div>						
			      </div>
				  <div class="col-lg-3">                                
						<div class="form-group">
                          <label>Pontos: </label>
                          <?php echo $vendorpoints ?>												 
                       
						</div>																	
				  </div>			     								         					 
				  <div class="col-lg-3">                                
						<div class="form-group">
                            <label>Número de vendas: </label>    					
							<?php echo $vendorsells; ?> 														
			          </div>	
				 </div>
					
					<div class="col-lg-3">                                
						<div class="form-group">
                            <label>Verificações: </label>    							
							<?php echo $glyphicon; ?> 														
			            </div>	
					</div>
				  </div>
				</div>						 	
</div>   </div>   
<div class="row">
<div class="text">	<div class="col-lg-12">                                
	  <div class="row">
		<div class="col-lg-12">                                
		  <div class="form-group">
		 
            <div class="header-text" style="margin-top:15px;">INFORMAÇÕES SOBRE A COMPRA  </div>
          <hr class="header-line">		
		  </div>											 					
		</div>
	  </div>
</div>   			  
			  <!-- Nome -->
			<div class="col-lg-12">                                
			      <div class="row">
				     <div class="col-lg-4">                                
						<div class="form-group">
					<label>Preço: <?php echo $annoucementprice." €"; ?>  </label>
							<input name="price" type="hidden" value="<?php echo $annoucementprice; ?>">
                        </div>						
					</div>	
					 <div class="col-lg-5">                                
						<div class="form-group">
                          <label>Data de colocação do anúncio: </label>
                          <?php echo $annoucementdate; ?>					
                        </div>											 					
				   </div>		
				  </div>
				</div>
				 </div>											 					
				
</div>   
       
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="no_note" value="1" />
		<input type="hidden" name="lc" value="UK" />
		<input type="hidden" name="currency_code" value="EUR" />
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
		<input type="hidden" name="first_name" value="Customer's First Name"  />
		<input type="hidden" name="last_name" value="Customer's Last Name"  />
		<input type="hidden" name="payer_email" value="pedroomrnunes-buyer@gmail.com"  />
		<input type="hidden" name="item_number" value="123456" / >
<hr>		
<button type="submit" class="btn btn-success pull-right">Comprar</button>
</form>