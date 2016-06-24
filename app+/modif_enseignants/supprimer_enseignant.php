<?php
	/** Fichier avec donneés sensibles*/
	require '../connexion.php';	

	if(!empty($_POST)){
		/*on recupere les valeurs de la requete ajax*/
		$enseignant = $_POST['enseignant'];
		$id = $_POST['ensid'];

		/*requete de suppression du professeur selectionné*/
		$sql = "DELETE 
				FROM enseignant
				WHERE ensid=$id";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	}