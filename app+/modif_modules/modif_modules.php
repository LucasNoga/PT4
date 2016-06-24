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
	<link rel="stylesheet" href="./css/modif_modules.css"/>
	<script src="js/modif_modules.js"></script>
	

	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Page modules</title>
		<meta charset = "utf-8"/>
	</head>
	
	<body>

		<div id="entete">
			<h1 id="titre">Page pour les modules</h1>
			<a id='accueil' href="../../index.php">Revenir à l'accueil</a>
		</div>

		<div>
			<a id='ajout' href='ajout_module.php'>Ajouter un module</a><br/>
		</div>

		<div id="bloc">
			<span class="miniTitre"><b>Selectionnez un module:</b></span>
			
		<div id='monSelect'>
			<select id='modules'>
			</select>	
		</div>

		<br/><br/><div id='action'>
			<p id='suppr'> Supprimer le module selectionné</p>
		</div>
	</body>
</html>