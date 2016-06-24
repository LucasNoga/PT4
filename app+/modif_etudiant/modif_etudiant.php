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
	<link rel="stylesheet" href="css/modif_etudiant.css"/>
	<script src="./js/modif_etudiant.js"></script>
	

	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Page etudiant</title>
		<meta charset = "utf-8"/>
	</head>
	
	<body>

		<div id="conteneur">
			<h1 id="titre">Page pour les etudiants</h1>
			<a id='accueil' href="../../index.php">Revenir à l'accueil</a><br/>
			<a id='ajout' href='ajout_etudiant.php'>Ajouter un étudiant</a><br/>

			<div id="bloc">
				<form id='form' method='post'>
					<!--Choix de la filiere-->
					<div id="filiere" class='minibloc'>
						<span class="miniTitre"><b>Selectionnez une filiere:</b></span><br/>
						<label id='info' class='radio-inline'><input type='radio' name='filiere' value='info'> </input>INFO</label>
						<label id='mmi' class='radio-inline'><input type='radio' name='filiere' value='mmi'>  </input>MMI</label>
						<label id='geii' class='radio-inline'><input type='radio' name='filiere' value='geii'> </input>GEII</label>
					</div>
					
					<!--Choix de la promotion-->
					<div id='promo' class='minibloc'>
						<span class="miniTitre"><b>Selectionnez une promotion:</b></span><br/>
						<label id='champ1' class='radio-inline'><input type='radio' name='promo' value='1'></input>1</label>
						<label id='champ2' class='radio-inline'><input type='radio' name="promo" value='2'></input>2</label>
					</div>
				</form>
				
				<div id='monSelect'>
					<select id='etudiant'></select>
				</div>
			
				<div id='action'>
					<p id='suppr'> Supprimer l'étudiant selectionné</p>
				</div>
			</div>	
		</div>
	</body>
</html>
<!--

-->