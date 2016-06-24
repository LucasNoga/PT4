<?php
	/*Insertion des donnees*/

	require "../connexion.php";
	session_start();
	
	$_SESSION['error_module'] = array();

	/*Sécurité, identification du formulaire*/
	if( !isset($_POST['codeppn']) || !isset($_POST['nom']) || !isset($_POST['codeade']) || 
		!isset($_POST['codescodoc']) || !isset($_POST['ue']) || !isset($_POST['nbhcm']) 
		|| !isset($_POST['nbhtd']) || !isset($_POST['nbhtp']) )
	    $_SESSION['error_module'][] = 'Formulaire non reconnu !';
	
	if( empty($_POST['codeppn']) )
	  $_SESSION['error_module'][] = 'Code ppn manquant!';
	else
		$_codeppn = htmlentities($_POST['codeppn']);

	if( empty($_POST['nom']) )
	  $_SESSION['error_module'][] = 'Nom manquant !';
	else
		$_nom = htmlentities($_POST['nom']);

	if( empty($_POST['codeade']) )
	  $_SESSION['error_module'][] = 'code enseignant incorrect !';
	else 
		$_codeade = htmlentities($_POST['codeade']);

	if(empty($_POST['codescodoc']) )
	  	$_SESSION['error_module'][] = 'code scodoc incorrect';
	else
		$_codescodoc = htmlentities($_POST['codescodoc']);
	
	if(empty($_POST['ue']) )
	  	$_SESSION['error_module'][] = 'mail manquant';
	else
		$_ue = htmlentities($_POST['ue']);

	if( empty($_POST['nbhcm']) )
	  $_SESSION['error_module'][] = 'Nombre d\'heures CM non définis !';
	else
		$_nbhcm = htmlentities($_POST['nbhcm']);
	
	if( empty($_POST['nbhtd']) )
	  $_SESSION['error_module'][] = 'Nombre d\'heures TD non définis !';
	else
		$_nbhtd = htmlentities($_POST['nbhtd']);
	
	if( empty($_POST['nbhtp']) )
	  $_SESSION['error_module'][] = 'Nombre d\'heures TP non définis !';
	else
		$_nbhtp = htmlentities($_POST['nbhtp']);

	/*ajout des heures CM, TD, TP*/
	$_nbhto= $_nbhcm+$_nbhtd+$_nbhtp;
	if(empty($_nbhto))
		$_SESSION['error_module'][]= 'vous n\'avez pas defini les heures des cours';

	/*si un nom au module a deja été donnée*/
	$sql = "SELECT * 
			FROM module
			WHERE mnom=\"$_nom\"";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if( $stmt->rowCount() != 0)
		$_SESSION['error_module'][] = 'Vous avez deja saisie ce module';

	/*Si ce code a deja été donnée*/
	$sql = "SELECT * 
			FROM module
			WHERE mcodeppn=\"$_codeppn\"";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if( $stmt->rowCount() != 0) /*permet de connaitre le nombre d'enregistrement recuperé*/
		$_SESSION['error_module'][] = 'Vous avez deja saisie ce code';

	/*Réaffichage du formulaire si erreurs*/
	if( !empty($_SESSION['error_module']) )
		header( 'Location: ajout_module.php' );

	/*Insertion si tout est OK*/
	else{
		require "../connexion.php";
		$sql = 'INSERT INTO module (mcodeppn, mnom, mcodeade, mcodescodoc, mue, nbhcm, nbhtd, nbhtp, nbhto)
		VALUES (:mcodeppn, :mnom, :mcodeade, :mcodescodoc, :mue, :nbhcm, :nbhtd, :nbhtp, :nbhto)';

		$stmt = $pdo->prepare($sql);
		/*on prepare les parametres de la requete*/
		$stmt->bindParam(':mcodeppn', $_codeppn);
		$stmt->bindParam(':mnom', $_nom);
		$stmt->bindParam(':mcodeade', $_codeade);
		$stmt->bindParam(':mcodescodoc', $_codescodoc);
		$stmt->bindParam(':mue', $_ue);
		$stmt->bindParam(':nbhcm', $_nbhcm);
		$stmt->bindParam(':nbhtd', $_nbhtd);
		$stmt->bindParam(':nbhtp', $_nbhtp);
		$stmt->bindParam(':nbhto', $_nbhto);
		$exec = $stmt->execute();

		if($exec == 0)
			header('Location: ajout_module.php');
		
		/*Confirmation de l'insertion*/
		else{
			echo '<html><head><meta charset="utf-8"><title>Confirmation</title>
		     	</head><body>
		        <h2>Données enregistrées</h2><a href="ajout_module.php">Retour</a>
		      	</body></html>';
		} 
	}