<?php
/*
||
||
|| WebServices pour réservations rosans
||
||
*/
include_once('fonctions.php');
$action = isset($_GET['a']) ? $_GET['a'] : "";

// Traitement de l'affichage du calendrier
if($action == "calendrier") {
	$dte = isset($_GET['d']) ? $_GET['d'] : "";
	$amplitude = 30;
	// Remplissage du tableau avec les dates déjà réservées
	for($i=0; $i<$amplitude; $i++) {		
		$daff[$i] = mktime(0,0,0,substr($dte,4,2), substr($dte,6,2)+$i, substr($dte,0,4));
	}

	// Affichage des date
	echo "<table border=1>";
	echo "<tr>";
	echo "<th>Appartement</th>\n";
	for($i=0; $i<$amplitude; $i++) {
		if (date("Ymd") == date("Ymd", $daff[$i])) {
			echo "<th class='aujourdhui'>";
		} else {
			echo "<th>";
		}
		echo date("d-m", $daff[$i]) . "</th>\n";
	}
	echo "</tr>\n";

	// Affichage des dispos par appart
	$qry = "select * from a_rosans_logements where dispo=1 order by id_logement;";	
	$res = mysql_query($qry, $link);
	while ( $row = mysql_fetch_array( $res ) ) {	
		$id_logement = $row['id_logement'];
		echo "<tr>\n";
		echo "<th>" . $row['designation'] . "</th>";
		for($i=0; $i<$amplitude; $i++) {
			$dte = date("Ymd", $daff[$i]);
			$qry2 = "select * from a_rosans_reservations where annule != 1 and id_logement = " . $id_logement . 
				   " and date_debut <= '" . $dte . "' and date_fin >= '" . $dte . "'";
			$res2 = mysql_query($qry2, $link);		
			$row2 = @mysql_fetch_array($res2);	
			$etat = $row2['arrhes_versees'];
			if(! isset($etat)) {
				$classe = "vert";
				$texte = "<a href='#inscription' data-toggle='modal' title='Réserver'><i class='icon-white icon-pencil'></i></a>";
			} elseif($etat == 0) {
				$classe = "orange";
				$texte = "<a href='#inscription' data-toggle='modal' title='Voir la pré-réservation'><i class='icon-white icon-ban-circle'></i></a>";		
			} elseif($etat > 0) { 
				$classe = "rouge";
				$texte = "<a href='#inscription' data-toggle='modal' title='Voir la réservation'><i class='icon-white icon-ban-circle'></i></a>";
			}
			echo "<td class='" . $classe . "'>" . $texte . "</td>";
		}
		echo "</tr>\n";	
	}	
	echo "</table>";
}
?>