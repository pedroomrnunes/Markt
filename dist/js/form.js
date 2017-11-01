$(document).ready(function(){
   	$('#email').focus( function(){
	    //  $('label').next('div').addClass('.floating-label ');  
	 	  $('#lbemail').css('top', "0px");		  
		  $('#lbemail').css('font-size', "13px");		  $('#lbemail').css('font-weight', "700");	 $('#lbemail').css('opacity', "1"); 	  
		  $(this).css('padding', "0"); 	  $('#lbemail').css('color', "#337ab7"); 	
		  
	});	
	
	$('#lbemail').css('color', "rgba(12, 12, 12, 0.12)"); 
	
	
	
	$('#email').blur( function(){
	 /*   $('#lbemail').css('top', "25px");
		$('#lbemail').css('font-size', "16px"); */		
		
		if( !$(this).val() == "" ){
			
		   $('#lbemail').css('top', "0px");		  
		   $('#lbemail').css('font-size', "13px");  $('#lbemail').css('color', "#337ab7"); 	 $('#lbemail').css('opacity', "1"); 
		   
		} else {
		   $('#lbemail').css('top', "25px");
		   $('#lbemail').css('font-size', "16px");  $('#lbemail').css('color', "rgba(12, 12, 12, 0.29)"); 
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
	