<?php
	/*Fichier avec donneés sensibles*/
	require '../connexion.php';	

	if(!empty($_POST)){
		/*On recupere les valeurs de la requete ajax*/
		$module = $_POST['module'];
		$code = $_POST['mcodeppn'];

		/*Requete de suppression du professeur selectionné*/
		$sql = "DELETE 
				FROM module
				WHERE mcodeppn=$";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	}