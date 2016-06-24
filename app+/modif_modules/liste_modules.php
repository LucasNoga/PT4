<?php
	
	/*Fichier avec donneés sensibles*/
	require '../connexion.php';	
	
	/*Code por recuperer dans un tableau les etudiants*/
	$sql = 'SELECT mcodeppn, mnom
			FROM module';
	/*requete pour recuperer le nom et prenom des etudiants qui verifie le cm td et tp choisit*/
	$stmt = $pdo->query($sql);
	
	/*Recupere l'id, le nom et le prenom de chaque etudiant qui appartiennent au bon groupe sous forme d'objet*/
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$donnees =  $stmt->fetchAll();
	
	$module = array();

	foreach ($donnees as $obj ) {
		$module[$obj->mcodeppn][] = $obj->mnom;
	}

	$json = array();
	$json = $module;
	echo json_encode($json);
		
?>
