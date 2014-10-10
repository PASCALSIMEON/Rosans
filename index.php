<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Planning du Village de Vacances de Rosans</title>
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/datepicker.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/fonctions.js"></script>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
</head>	
<body>	
<h2>Réservations à Rosans</h2>

<?php
include_once('fonctions.php');



/*

$debaff = isset($_GET['d']) ? $_GET['d'] : (isset($_POST['d']) ? $_POST['d'] : "");
if($debaff == "") { $debaff = date("Ymd", mktime(0,0,0,date("m"), date("d"), date("Y"))); }
$affsempre = date("Ymd", mktime(0,0,0,substr($debaff,4,2), substr($debaff,6,2)-7, substr($debaff,0,4)));
$affsemsui = date("Ymd", mktime(0,0,0,substr($debaff,4,2), substr($debaff,6,2)+7, substr($debaff,0,4)));	
$affjour = date("d/m/Y", mktime(0,0,0,substr($debaff,4,2), substr($debaff,6,2), substr($debaff,0,4)));	
$affmoispre = date("Ymd", mktime(0,0,0,substr($debaff,4,2)-1, substr($debaff,6,2), substr($debaff,0,4)));
$affmoissui = date("Ymd", mktime(0,0,0,substr($debaff,4,2)+1, substr($debaff,6,2), substr($debaff,0,4)));	
*/
?>
<fieldset class="cadre">
<a href="#" id="mp" title="mois précédent"><i class="icon-fast-backward"></i></a>&nbsp;
<a href=""  id="sp" title="semaine précédente"><i class="icon-backward"></i></a>&nbsp;
<input type="text" value="" name="datsai" id="datsai" class="dte input-medium" />&nbsp;
<a href="#" id="ss" title="semaine suivante"><i class="icon-forward"></i></a>&nbsp;
<a href="#" id="ms" title="mois suivant"><i class="icon-fast-forward"></i></a>
</fieldset>

<br /><br />
<div id="calendrier"><img src="img/chargement.gif" /></div>

<div class="modal hide fade" id="inscription">
	<div class="modal-header"> <a class="close" datadismiss="modal">×</a>
		<h3>Fiche d'inscription</h3>
	</div>	
	<div class="modal-body">
		<form class="form-inline" action="" method="post">			
			<input type="hidden" id="id_reservation" name="id_reservation" /> 
			<label class="control-label" for="id_logement">Logement :</label><input type="text" id="id_logement" name="id_logement" /><br />
			<input type="hidden" id="id_membre" name="id_membre" />
			<label class="control-label" for="civilite">Civilité :</label>
			<select id="civilite" name="civilite">
			<option>Mr</option><option>Mme</option><option>Melle</option>
			</select><br />
			<label class="control-label" for="prenom">Prénom :</label><input type="text" id="prenom" name="prenom" />
			<label class="control-label" for="nom">Nom :</label><input type="text" id="nom" name="nom" /><br />
			<label class="control-label" for="adresse">Adresse :</label><input type="text" id="adresse" name="adresse" /><br />
			<label class="control-label" for="adresse_2">Suite :</label><input type="text" id="adresse_2" name="adresse_2" /><br />
			<label class="control-label" for="cp">Code postal :</label><input type="text" id="cp" name="cp" />&nbsp;
			<label class="control-label" for="ville">Ville :</label><input type="text" id="ville" name="ville" /><br />
			<label class="control-label" for="telephone">Téléphone :</label><input type="text" id="telephone" name="telephone" /><br />
			<label class="control-label" for="email">Email :</label><input type="text" id="email" name="email" /><br />
			<label class="control-label" for="date_debut">Séjour du :</label>
			<input type="text" class="dte" id="date_debut" name="date_debut" /> au 
			<input type="text" class="dte" id="date_fin" name="date_fin" /><br />
			<label class="control-label" for="nb_adultes">Nb d'adultes :</label>
			<select id="nb_adultes" name="nb_adultes">
			<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
			</select> 
			<label class="control-label" for="nb_enfants">Nb d'enfants :</label>
			<select id="nb_enfants" name="nb_enfants">
			<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
			</select><br />
			<label class="control-label" for="commentaire">Commentaire :</label><textarea id="commentaire" name="commentaire"></textarea><br />	
		</form>
	</div>
	<div class="modal-footer"> 
		<a class="btn btn-info" datadismiss="modal">Fermer</a> 
	</div>
</div>

</body>
<script>
// Au démarrage
$(function (){
	$('.dte').datepicker();
	// Affichage du calendrier pour la date du jour
	litCalendrier(<?php echo date("Ymd", mktime(0,0,0,date("m"), date("d"), date("Y"))); ?>);		
});
// Si modification manuelle de la date, on raffiche le calendrier
$('#datsai').datepicker().on('changeDate', function(e){
	var ds = ($('#datsai').val()).substr(6,4) + ($('#datsai').val()).substr(3,2) + ($('#datsai').val()).substr(0,2);
	affCal(ds);
});
$('#mp').click(function(){    
	dtmp = new Date(($('#datsai').val()).substr(6,4) ,($('#datsai').val()).substr(3,2)-1 ,($('#datsai').val()).substr(0,2), 0, 0, 0, 0);
	alert(dtmp);
	//affCal(dtmp);
});

/*$affsempre = date("Ymd", mktime(0,0,0,substr($debaff,4,2), substr($debaff,6,2)-7, substr($debaff,0,4)));
$affsemsui = date("Ymd", mktime(0,0,0,substr($debaff,4,2), substr($debaff,6,2)+7, substr($debaff,0,4)));	
$affjour = date("d/m/Y", mktime(0,0,0,substr($debaff,4,2), substr($debaff,6,2), substr($debaff,0,4)));	
$affmoispre = date("Ymd", mktime(0,0,0,substr($debaff,4,2)-1, substr($debaff,6,2), substr($debaff,0,4)));
$affmoissui = date("Ymd", mktime(0,0,0,substr($debaff,4,2)+1, substr($debaff,6,2), substr($debaff,0,4)));	
*/

</script>
</html>