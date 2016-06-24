<?php
/*script qui recupere les absent a partir de la date selectionne*/
	require './connexion.php';	

	$_date = $_POST['date'];
	$_filiere = $_POST['filiere'];
	$_promo = intval($_POST['promo']);
	$_groupeTD = $_POST['groupeTD'];
	$_groupeTP = $_POST['groupeTP'];
	$creneau = array( "8h30-10h30", "10h30-12h30", "14h00-16h00", "16h00-18h00");
	$absent= array();

	/*Pour chaque horaires on recupere les étudiants absent a la date selectionné*/
	foreach ($creneau as $horaire) {
		$sql = "SELECT DISTINCT(e.etuprenom), e.etunom
				FROM etudiant e
				INNER JOIN absence as a ON e.etuid = a.absetuid
				INNER JOIN groupe as g on e.etuid = g.grpetuid
				WHERE a.absdate=\"$_date\" 
				AND a.abscreneau=\"$horaire\"
				AND e.etufiliere=\"$_filiere\"
				AND g.grpannee=\"$_promo\"
				AND g.grptd=\"$_groupeTD\"
				AND g.grptp=\"$_groupeTP\"";
		
		/*requete pour recuperer le nom et prenom des etudiants qui verifie le cm td et tp choisit*/
		$stmt = $pdo->query($sql);
		
		/*recupere l'id, le nom et le prenom de chaque etudiant qui appartiennent au bon groupe sous forme d'objet*/
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$donnees =  $stmt->fetchAll();

		/*si il n'y a pas d'absents on affiche un /*/
		if( empty($donnees) )
			$absent[$horaire]="/";

		/*sinon on affiche le nom et prenom de l'etudiant*/
		else{
			foreach ($donnees as $obj ) {
				$absent[$horaire][] = ' ' .$obj->etunom . ' ' . $obj->etuprenom;
			}
		}
	}
	$json = array();
	$json = $absent;
	echo json_encode($json);

?>