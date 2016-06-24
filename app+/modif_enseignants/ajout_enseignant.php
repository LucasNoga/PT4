<?php
/*Script pour ajouter un etudiant*/
session_start();
?>
<!DOCTYPE html>
<html>
	<!--Librairie-->
	<!--Import CSS-->
	<link rel="stylesheet" href="../../JQuery/jquery-ui/jquery-ui.structure.min.css"/>
	<link rel="stylesheet" href="../../JQuery/jquery-ui/jquery-ui.theme.min.css"/>
	<link rel="stylesheet" href="../../JQuery/jquery-ui/jquery-ui.css"/>
	<link rel="stylesheet" href="../../Bootstrap/bootstrap.css"/>
	<link rel="stylesheet" href="../../Bootstrap/bootstrap-theme.min.css"/>
	
	<!--Import JS-->
	<script src="../../JQuery/jquery/jquery.min.js"></script>
	<script src="../../JQuery/jquery-ui/jquery-ui.min.js"></script>

	<!--les imports-->
	<link rel="stylesheet" href="css/ajout_enseignants.css"/>
	<script src="./js/modif_enseignants.js"></script>
	

	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Ajout enseignant</title>
		<meta charset = "utf-8"/>
	</head>
	
	<body>

		<div id="entete">
			<h1 id="titre">Ajout d'un enseignant</h1>
			<a id='accueil' href="../../index.php">Revenir à l'accueil</a><br/>
			<a href='modif_enseignants.php'>Liste des enseignants</a>
		</div>

<?php
		if(!empty($_SESSION['error_enseignant'])){
?>
			<div class='alert alert-warning' role='alert'>
				<?php echo implode('<br>',$_SESSION['error_enseignant']);
				?>
			</div>
<?php
		}
		$_SESSION['error_enseignant'] = array();
?>

		<div id='bloc'>
			<form id='formulaire' method='post' action="formulaire_ajout_enseignant.php">
				<table id='table_champs'>
					<tr>
						<td><label>Nom</label></td>
						<td><input name='nom' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Prenom</label></td>
						<td><input name='prenom' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Code ADE</label></td>
						<td><input name='code' type='text' size='20'></input></td>
					</tr>
				</table>	
		
				<div id='submit' class='champ'>
					<input class="btn btn-default" type='submit' value='Enregistrer'></input>
				</div>
			</form>
		</div>	
	</body>
</html>
