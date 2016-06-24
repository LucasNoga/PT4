<?php
	/*Fichier avec données sensibles*/
	require '../connexion.php';	
	
	/*Code por recuperer dans un tableau les etudiants*/
	$sql = 'SELECT ensid, ensprenom, ensnom
			FROM enseignant';
	
	/*requete pour recuperer le nom et prenom des etudiants qui verifie le cm td et tp choisit*/
	$stmt = $pdo->query($sql);
	
	/*recupere l'id, le nom et le prenom de chaque etudiant qui appartiennent au bon groupe sous forme d'objet*/
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$donnees =  $stmt->fetchAll();
	

	$enseignant = array();

	foreach ($donnees as $obj ) {
		$enseignant[$obj->ensid][] = $obj->ensnom . " " . $obj->ensprenom;
	}

	$json = array();
	$json = $enseignant;
	echo json_encode($json);
		
?>
