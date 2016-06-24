<?php
	/** Fichier avec donneés sensibles*/
	require '../connexion.php';	

	if(!empty($_POST)){
		/*on recupere les valeurs de la requete ajax*/
		$etudiant = $_POST['etudiant'];
		$id = $_POST['etuid'];

		echo "$etudiant + $id";

		/*requete de suppression de l'etudiant selectionné*/
		$sql = "DELETE 
				FROM etudiant
				WHERE etuid=$id";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	}