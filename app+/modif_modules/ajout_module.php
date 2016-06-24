<?php
/*Script pour ajouter un module*/
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
	<link rel="stylesheet" href="./css/ajout_modules.css"/>
	<script src="js/modif_modules.js"></script>
	
	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Ajout module</title>
		<meta charset = "utf-8"/>
	</head>
	
	<body>

		<div id="entete">
			<h1 id="titre">Ajout d'un module</h1>
			<a id='accueil' href="../../index.php">Revenir à l'accueil</a><br/>
			<a href='modif_modules.php'>Liste des modules</a><br/>
		</div>

<?php
		if(!empty($_SESSION['error_module'])){
?>
		<div class='alert alert-warning' role='alert'>
<?php 		
			echo implode('<br>',$_SESSION['error_module']);    
?>
		</div>
<?php
		}
		$_SESSION['error_module'] = array();
?>
		<div id='bloc'>
			<form id='formulaire' method='post' action="requete_ajout_module.php">
			
				<table id='table_champs'>
					<tr>
						<td><label>Code PPN</label></td>
						<td><input name='codeppn' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Nom du module</label></td>
						<td><input name='nom' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Code enseignant:</label></td>
						<td><input name='codeade' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Code Scodoc:</label></td>
						<td><input name='codescodoc' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Unite d'enseignement:</label></td>
						<td><input name='ue' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Nombre d'heures CM:</label></td>
						<td><input name='nbhcm' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Nombre d'heures TD:</label></td>
						<td><input name='nbhtd' type='text' size='20'></input></td>
					</tr>
					
					<tr>
						<td><label>Nombre d'heures TP: </label></td>
						<td><input name='nbhtp' type='text' size='20'></input></td>
					</tr>
				</table>

				<div id='submit' class='champ'>
					<input class="btn btn-default" type='submit' value='Enregistrer'></input>
				</div>
			</form>
		</div>	
	</body>
</html>