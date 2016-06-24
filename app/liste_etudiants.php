<?php
	session_start();
	/*connexion avec pdo*/
	require '../connexion.php';
	
	/*initialisation des variables*/
	$_filiere = NULL;
	$_promo = NULL;
	$_groupeCM = NULL;
	$_groupeTD = NULL;
	$_groupeTP = NULL;

	$_SESSION['message'] = array();
	
	/**Recupere la filiere coché*/
	if(isset($_POST['filiere']))
		$_filiere=$_POST['filiere'];
	else
		$_SESSION['message'][] = "vous n'avez pas choisi de filiere";

	/**Recupere la promo coché*/
	if(isset($_POST['promo']))
		$_promo=intval($_POST['promo']);
	else
		$_SESSION['message'][] = "vous n'avez pas choisi de promo";

	/** Recupere le groupe coché*/
	if(isset($_POST['groupeCM']))
		$_groupeCM=$_POST['groupeCM'];
	else
		$_SESSION['message'][] = "vous n'avez pas choisi de groupe CM";

	if(isset($_POST['groupeTD']))
		$_groupeTD=$_POST['groupeTD'];
	else
		$_SESSION['message'][] = "vous n'avez pas choisi de groupe TD";

	if(isset($_POST['groupeTP']))
		$_groupeTP=$_POST['groupeTP'];
	else
		$_SESSION['message'][] = "vous n'avez pas choisi de groupe TP";

	if(!empty($_SESSION['message']))
			echo 'erreur';
	
	$sql = "SELECT e.etuid, e.etuprenom, e.etunom
			FROM etudiant e
			INNER JOIN groupe as g
			ON e.etuid = g.grpetuid
			WHERE g.grpannee=\"$_promo\" 
            && e.etufiliere=\"$_filiere\"
            && g.grpcm=\"$_groupeCM\" 
            && g.grptd=\"$_groupeTD\" 
            && g.grptp=\"$_groupeTP\"";

	/*requete pour recuperer le nom et prenom des etudiants qui verifie le cm td et tp choisit*/
	$stmt = $pdo->prepare($sql);
	$exec = $stmt->execute();

	if($exec == 0){
		echo 'pas d\'etudiant';
	}
	
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

?>   