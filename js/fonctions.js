// Lecture et affichage du calendrier
function litCalendrier(dte) {
	$.ajax({	  
		type: 'POST',        				
		url: 'ws.php?a=calendrier&d='+dte,        						
		async:false
	}).done(function( tableau ) {        	
		//Afficher le texte en retour 
		$( '#calendrier' ).empty();
		$( '#calendrier' ).append( tableau );		
	});
}

function affCal(ds) {
	$('#datcal').val(ds);
	litCalendrier(ds);	
	$('.datepicker').hide();
}	