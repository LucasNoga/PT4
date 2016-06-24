<?php
	/** Fichier avec donneés sensibles*/
	include 'connexion.php';	

	/*si une requete est faite*/
	if(!empty($_POST)){

		$filiere = $_POST['filiere'];
		$promo = $_POST['promo'];
		
		/*code por recuperer dans un tableau les etudiants*/
		$sql = "SELECT e.etuid, e.etuprenom, e.etunom
				FROM etudiant e
				INNER JOIN groupe g ON g.grpetuid=e.etuid
				WHERE e.etufiliere=\"$filiere\" && g.grpannee=\"$promo\"";

		/*requete pour recuperer le nom et prenom des etudiants qui verifie le cm td et tp choisit*/
		$stmt = $pdo->query($sql);
		
		/*recupere l'id, le nom et le prenom de chaque etudiant qui appartiennent au bon groupe sous forme d'objet*/
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$donnees =  $stmt->fetchAll();
		$etudiant = array();

		foreach ($donnees as $obj ) {
			$etudiant[$obj->etuid][] = $obj->etunom . " " . $obj->etuprenom;
		}

		$json = array();
		$json = $etudiant;
		echo json_encode($json);
		
	}
?>
