<?php
	/*Insertion des donnees*/
	require "../connexion.php";
	session_start();
	$_SESSION['error_etudiant'] = array();

	/*Sécurité, identification du formulaire*/
	if( !isset($_POST) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['id']) || !isset($_POST['filiere']) || !isset($_POST['mail'])
						|| !isset($_POST['annee']) || !isset($_POST['groupeTD']) || !isset($_POST['groupeTP']) )
	    $_SESSION['error_etudiant'][] = 'Formulaire non reconnu !';

	if( empty($_POST['nom']) )
	  $_SESSION['error_etudiant'][] = 'Nom manquant !';

	else
		$_nom = htmlentities($_POST['nom']);

	if( empty($_POST['prenom']) )
	  $_SESSION['error_etudiant'][] = 'Prénom manquant !';

	else 
		$_prenom = htmlentities($_POST['prenom']);

	if(empty($_POST['id']) )
	  	$_SESSION['error_etudiant'][] = 'numero etudiant incorrect';

	else
		$_id = htmlentities($_POST['id']);

	if(empty($_POST['mail']) )
	  	$_SESSION['error_etudiant'][] = 'mail manquant';

	else
		$_mail = htmlentities($_POST['mail']);

	if( empty($_POST['annee']) )
	  $_SESSION['error_etudiant'][] = 'Veuillez saisir une année !';
	else
		$_annee = htmlentities($_POST['annee']);
	
	if( empty($_POST['filiere']) )
	  $_SESSION['error_etudiant'][] = 'Veuillez saisir une filiere!';

	else
		$_filiere = htmlentities($_POST['filiere']);

	if( empty($_POST['groupeTD']) )
	  $_SESSION['error_etudiant'][] = 'Veuillez saisir un TD !';
	else
		$_TD = htmlentities($_POST['groupeTD']);

	if( empty($_POST['groupeTP']) )
	  $_SESSION['error_etudiant'][] = 'Veuillez saisir un TP !';
	else
		$_TP = htmlentities($_POST['groupeTP']);

	/*CM*/
	$_CM = 1;
	
	/*Semestre*/
	if($_annee == 1)
		$semestre = 1;
	else
		$semestre = 3;

	/*si un etudiant a deja ce nom et ce prenom*/
	$sql = "SELECT * 
			FROM etudiant
			WHERE etunom=\"$_nom\" AND etuprenom=\"$_prenom\"";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
		
	if( $stmt->rowCount() != 0) /*permet de connaitre le nombre d'enregistrement recuperé*/
		$_SESSION['error_etudiant'][] = 'Vous avez deja saisie cet etudiant';

	/*si un numeroetudiant a deja été donnée*/
	$sql = "SELECT * 
			FROM etudiant
			WHERE etunumetu=$_id";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if( $stmt->rowCount() != 0)
		$_SESSION['error_etudiant'][] = 'Vous avez deja saisie ce code';

	/*Réaffichage du formulaire si erreurs*/
	if( !empty($_SESSION['error_etudiant']) )
		header( 'Location: ajout_etudiant.php' );

	
	/*Verification et insertion*/
	else{
		/*Requete dans la table etudiante*/
		$sql = 'INSERT INTO etudiant (etunom, etuprenom, etunumetu, etufiliere, etumail)
		VALUES (:etunom, :etuprenom, :etunumetu, :etufiliere, :etumail)';

		$stmt = $pdo->prepare($sql);
		/*on prepare les parametres de la requete*/
		$stmt->bindParam(':etunom', $_nom);
		$stmt->bindParam(':etuprenom', $_prenom);
		$stmt->bindParam(':etunumetu', $_id);
		$stmt->bindParam(':etufiliere', $_filiere);
		$stmt->bindParam(':etumail', $_mail);
		$exec = $stmt->execute();

		if($exec == 0)
			header('Location: ajout_etudiant.php');

		/*Requete dans les groupes*/
		else{

			$sql = "SELECT etuid 
					FROM etudiant
					WHERE etunom=\"$_nom\" AND etuprenom=\"$_prenom\" AND etufiliere=\"$_filiere\"";

			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_OBJ);

			/*On recupere l'id qu'on vient de saisir*/
			$etuid = $res->etuid;

			
			/*Requete dans la table groupe*/
			$sql = 'INSERT INTO groupe (grpetuid, grpannee, grpsemestre, grpcm, grptd, grptp)
			VALUES (:grpetuid, :grpannee, :grpsemestre, :grpcm, :grptd, :grptp)';

			$stmt = $pdo->prepare($sql);
		
			/*on prepare les parametres de la requete*/
			$stmt->bindParam(':grpetuid', $etuid);
			$stmt->bindParam(':grpannee', $_annee);
			$stmt->bindParam(':grpsemestre', $semestre);
			$stmt->bindParam(':grpcm', $_CM);
			$stmt->bindParam(':grptd', $_TD);
			$stmt->bindParam(':grptp', $_TP);

			$exec = $stmt->execute();

			if($exec == 0)
				header('Location: ajout_etudiant.php');
		
			/*Confirmation de l'insertion*/
			else{
				echo '<html><head><meta charset="utf-8"><title>Confirmation</title>
			     	</head><body>
			        <h2>Données enregistrées</h2><a href="ajout_etudiant.php">Retour</a>
			      	</body></html>';
			}
		}
	}