<?php
	/*Insertion des donnees*/

	require "../connexion.php";
	session_start();
	$_SESSION['error_enseignant'] = array();

	/*Securité, identification du formulaire*/
	if(!isset($_POST) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['code']))
	    $_SESSION['error_enseignant'][] = 'Formulaire non reconnu !';

	/*Validation des données*/
	if( empty($_POST['nom']))
	  $_SESSION['error_enseignant'][] = 'Nom manquant !';

	else
		$_nom = htmlentities($_POST['nom']);

	if( empty($_POST['prenom']))
	  $_SESSION['error_enseignant'][] = 'Prénom manquant !';

	else 
		$_prenom = htmlentities($_POST['prenom']);

	if(empty($_POST['code']))
	  	$_SESSION['error_enseignant'][] = 'code enseignant incorrect';

	else
		$_code = htmlentities($_POST['code']);

	/*Si un prof a deja ce nom et ce prenom*/
	$sql = "SELECT * 
			FROM enseignant
			WHERE ensnom=\"$_nom\" AND ensprenom=\"$_prenom\"";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
		
	if( $stmt->rowCount() != 0) /*permet de connaitre le nombre d'enregistrement recuperé*/
		$_SESSION['error_enseignant'][] = 'Vous avez deja saisie ce professeur';

	/*Si ce code ade a deja été donné*/
	$sql = "SELECT * 
			FROM enseignant
			WHERE enscodeade=\"$_code\"";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if( $stmt->rowCount() != 0)
		$_SESSION['error_enseignant'][] = 'Vous avez deja saisie ce code';

	/*Réaffichage du formulaire si erreurs*/
	if( !empty($_SESSION['error_enseignant'] ))
	  header('Location: ajout_enseignant.php');

	else {
	  	
	  	/*Requete*/
		$sql = 'INSERT INTO enseignant (ensnom, ensprenom, enscodeade)
				VALUES (:ensnom, :ensprenom, :enscodeade)';
		$stmt = $pdo->prepare($sql);

		/*on prepare les parametres de la requete*/
		$stmt->bindParam(':ensnom', $_nom);
		$stmt->bindParam(':ensprenom', $_prenom);
		$stmt->bindParam(':enscodeade', $_code);

		$exec = $stmt->execute();
	}
	  
	/*Test erreur d'insertion*/
	if($exec == 0)
		header( 'Location: ajout_enseignant.php' );
	
	/*Confirmation de l'insertion*/
	else{
		echo '<html><head><meta charset="utf-8"><title>Confirmation</title>
	     	</head><body>
	        <h2>Données enregistrées</h2><a href="ajout_enseignant.php">Retour</a>
	      	</body></html>';
	} 