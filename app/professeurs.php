<?php
	/*Recupere la connexion pdo*/
	require './connexion.php';

	if(!empty($_POST)){
		$code = $_POST['idmat'];
		
		/*code por recuperer dans un tableau des prof du module*/
		$sql = "SELECT e.ensid, e.ensprenom, e.ensnom
				FROM enseignant e
				INNER JOIN module m on m.mcodeppn=\"$code\"
				WHERE m.mcodeade=e.enscodeade";

		$stmt = $pdo->query($sql);		
		
		/*recupere l'id, le nom et le prenom du prof appartenant au module*/
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$donnees = $stmt->fetchAll();

		$profs = array();
		
		foreach ($donnees as $obj ) {
			$profs[$obj->ensid][] = $obj->ensnom . " " . $obj->ensprenom;
		}

		$json = array();
		$json = $profs;
		echo json_encode($json);
		
	}
?>




