<html>
	<head>
		<link rel="stylesheet" href="../Bootstrap/bootstrap.css"/>
		<link rel="stylesheet" href="../Bootstrap/bootstrap-theme.min.css"/>
		<link text='text/css' rel='stylesheet' href='../css/index.css'/>
		
		<title>Confirmation ajout</title>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<meta charset = "utf-8"/>		
	</head>

<?php
	/*Recupere la connexion pdo*/
	define('chemin_connexion', '/Applications/MAMP/htdocs/PT4/Lucas/connexion.php');
	require chemin_connexion;

	/*Si aucun etudiant est selectionner on le redirige vers index.php*/
	if( empty($_POST['absence']) && empty($_POST['retard'])){
?>
		<script>
			alert("vous n'avez selectionné aucun etudiant pour les absences et pour les retards");
			document.location.href="../index.php";
		</script>
<?php
	}
	else{
			$_mcodeppn = $_POST['matieres'];
			$_ensid = intval($_POST['professeur']);
			$_date = $_POST['date'];
			$_creneau = $_POST['horaires'];
			
			$etudiants_absent=array();
			$etudiants_retard=array();
			
			/*requete pour le nom du prof*/
			$sql = "SELECT e.ensnom, e.ensprenom
					FROM enseignant e 	
					WHERE e.ensid=$_ensid";
			
			$stmt = $pdo->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->execute();
			$prof = $stmt->fetch(); 
			$prof = $prof->ensnom.' '.$prof->ensprenom; /*on recupere le professeur*/

			/*requete pour le nom de la matiere*/
			$sql = "SELECT m.mnom
					FROM module m	
					WHERE m.mcodeppn=\"$_mcodeppn\"";

			$stmt = $pdo->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$stmt->execute();
			$matiere = $stmt->fetch(); 
			$matiere = $matiere->mnom; /*on recupere la matiere*/

		/*Si des etudiants ont été selectionnes pour les absences*/
		if( !empty($_POST['absence']) ){
			$_absences = $_POST['absence'];

			/*pour chaque absence on lance une requete*/
			foreach ($_absences as $etuid) {
				foreach ($_creneau as $horaire) { /*on fait une requete pour chaque horaire*/
					/*Ajout des absences*/
					$sql = "INSERT INTO absence (absetuid, absmcodeppn, absensid, absdate, abscreneau)
							VALUES (:absetuid, :absmcodeppn, :absensid, :absdate, :abscreneau)";
					$stmt = $pdo->prepare($sql);
					/*on prepare les parametres de la requete*/
					$stmt->bindParam(':absetuid', $etuid);
					$stmt->bindParam(':absmcodeppn', $_mcodeppn);
					$stmt->bindParam(':absensid', $_ensid);
					$stmt->bindParam(':absdate', $_date);
					$stmt->bindParam(':abscreneau', $horaire);
					$exec = $stmt->execute();
				}
				/*on recupere l'etudiant*/
				$sql_etudiant = "SELECT e.etunom, e.etuprenom
								FROM etudiant e 	
								WHERE e.etuid=$etuid";
						
				$stmt = $pdo->prepare($sql_etudiant);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute();
				$etudiant = $stmt->fetch();
				
				$etudiants_absent[] = $etudiant; 
			}
		}
		
		/*si des etudiants ont été selectionnes pour les retards*/
		if( !empty($_POST['retard']) ){
			$_retards = $_POST['retard'];
			$_mcodeppn = $_POST['matieres'];
			$_ensid = intval($_POST['professeur']);
			$_date = $_POST['date'];
			$_creneau = $_POST['horaires'];

			/*pour chaque absence on lance une requete*/
			foreach ($_retards as $etuid) {
				foreach ($_creneau as $horaire) { /*on fait une requete pour chaque horaire*/
					/*Ajout des absences*/
					$sql = "INSERT INTO retard (retetuid, retmcodeppn, retensid, retdate, retcreneau)
							VALUES (:retetuid, :retmcodeppn, :retensid, :retdate, :retcreneau)";
				
					$stmt = $pdo->prepare($sql);

					/*on prepare les parametres de la requete*/
					$stmt->bindParam(':retetuid', $etuid);
					$stmt->bindParam(':retmcodeppn', $_mcodeppn);
					$stmt->bindParam(':retensid', $_ensid);
					$stmt->bindParam(':retdate', $_date);
					$stmt->bindParam(':retcreneau', $horaire);

					$exec = $stmt->execute();
				}
				/*on recupere l'etudiant*/
				$sql_etudiant = "SELECT e.etunom, e.etuprenom
								FROM etudiant e 	
								WHERE e.etuid=$etuid";
						
				$stmt = $pdo->prepare($sql_etudiant);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute();
				$etudiant = $stmt->fetch();
				
				$etudiants_retard[] = $etudiant; 
			}
		}
		
		/*Affichage*/
?>
		<body style='text-align:center;'>
			<h1 id="titre">Données sauvegardé</h1>
			<a id='accueil' href="../index.php">revenir a l'accueil</a><br/>
			<div style="display:inline-block;">
				<table class='table table-bordered'>
					<caption>Absences ajoutées</caption>
					<thead>
						<tr>
							<td>Module</td>       
							<td><?php echo $matiere ?></td>
						</tr>
						<tr>
							<td>Professeur</td>   
							<td><?php echo $prof ?></td>
						</tr>
						<tr>
							<td>Date de l'absence</td>         
							<td><?php echo $_date ?></td>
						</tr>

						<!--Pour les absences-->
						<tr>
							<td>Horaires d'absences</td>      
							<td><?php foreach ($_creneau as $horaire){	echo "$horaire<br/>";}?></td>
						</tr>
						<tr>
							<td colspan='2' style='text-align:center;'><b>Etudiants absent</b></td>      
						</tr>
						<tr>
							<td><b>Nom</b></td>      
							<td><b>Prenom</b></td>
						</tr>
<?php
						foreach ($etudiants_absent as $etudiant){
							echo "<tr>
									<td>$etudiant->etunom</td>    
									<td>$etudiant->etuprenom</td>  
								</tr>";
						}
?>
						<!--Pour les retards-->
						<tr>
							<td colspan='2' style='text-align:center;'><b>Etudiants retardataires</b></td>      
						</tr>
						<tr>
							<td><b>Nom</b></td>      
							<td><b>Prenom</b></td>
						</tr>
<?php
						foreach ($etudiants_retard as $etudiant) {
							echo "<tr>
									<td>$etudiant->etunom</td>    
									<td>$etudiant->etuprenom</td>  
								</tr>";
						}
?>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</body>
<?php
	}
?>