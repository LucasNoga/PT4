<?php
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
	<link rel="stylesheet" href="css/modif_enseignants.css"/>
	<script src="./js/modif_enseignants.js"></script>
	

	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Page professeur</title>
		<meta charset = "utf-8"/>
	</head>
	
	<body>

		<div id="entete">
			<h1 id="titre">Page pour les professeurs</h1>
			<a id='accueil' href="../../index.php">Revenir à l'accueil</a>
		</div>

		<div>
			<a id='ajout' href='ajout_enseignant.php'>Ajouter un professeur</a>
		</div>
		
		<div id="bloc">
			<span class="miniTitre"><b>Selectionnez un professeur:</b></span>
			
			<div id='monSelect'>
				<select id='enseignant'>
				</select>	
			</div>
			
			<div id='action'>
				<p id='suppr'> Supprimer le professeur selectionné</p>
			</div>
		</div>
	</body>
</html>