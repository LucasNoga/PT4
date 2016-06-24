<?php
	session_start();
?>
<!DOCTYPE html>
<html lang='fr'>
	<!--Librairie-->
	<!--Import CSS-->
	<link rel="stylesheet" href="JQuery/jquery-ui/jquery-ui.structure.min.css"/>
	<link rel="stylesheet" href="JQuery/jquery-ui/jquery-ui.theme.min.css"/>
	<link rel="stylesheet" href="JQuery/jquery-ui/jquery-ui.css"/>
	<link rel="stylesheet" href="Bootstrap/bootstrap.css"/>
	<link rel="stylesheet" href="Bootstrap/bootstrap-theme.min.css"/>
	
	<!--Import JS-->
	<script src="JQuery/jquery/jquery.min.js"></script>
	<script src="JQuery/jquery-ui/jquery-ui.min.js"></script>

	<!--les imports-->
	<link rel="stylesheet" href="css/index.css"/>
	<script src="js/index.js"></script>

	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Saisie des absences</title>
		<meta charset = "utf-8"/>
	</head>
	<body>
		<h1 id="titre">Gestionnaire d'absences</h1>
		
		<!--fonctionnalités supplémentaires-->
		<div id="fonctionnalites">
				<h4>Fonctionnalités supplementaires</h4>
				<div class='liens'><a href="app+/modif_etudiant/modif_etudiant.php">modification des etudiants</a></div>
				<div class='liens'><a href="app+/modif_enseignants/modif_enseignants.php">modification des enseignants</a></div>
				<div class='liens'><a href="app+/modif_modules/modif_modules.php">modification des modules</a></div>
		</div>
		
		<!-- formulaire qui traite les données saisie par l'utilisateur-->
		<form id='formulaire' method="post" action='./app/ajout_absence.php'>
			<!--tableau des etudiant de la filiere-->
			<div id='etudiants'>
				<table class='table table-hover table-bordered' id='table_etudiant'>
				</table>
			</div>
		
			<!--tableau des absents-->
			<div id='absents'>
				<table class='table table-bordered' id='table_absent'>
				</table>
			</div>
<?php
			/** Fichier avec donneés sensibles*/
			require 'app/connexion.php';
?>
			<!--les inputs-->
			<div id="conteneur">	
				<div id="bloc">
					<!--Choix de la filiere-->
					<div id="filiere" class='minibloc'>
						<span class="miniTitre"><b>Sélectionnez une filière:</b></span><br/>
							<label class='radio-inline'><input type='radio' name='filiere' value='info'> </input>INFO</label>
							<label class='radio-inline'><input type='radio' name='filiere' value='mmi'>  </input>MMI</label>
							<label class='radio-inline'><input type='radio' name='filiere' value='geii'> </input>GEII</label>
					</div>
					
					<!--Choix de la promotion-->
					<div id="promotion" class='minibloc'>
						<span class="miniTitre"><b>Sélectionnez une promotion:</b></span><br/>
							<label class='radio-inline'><input type='radio' name='promo' value='1'></input>1</label>
							<label class='radio-inline'><input type='radio' name="promo" value='2'></input>2</label>
					</div>
						
					<!-- choix du groupe -->
					<div id='groupe' class='minibloc'>
						<span class='miniTitre'><b>Sélectionnez un CM, un TD et un TP:</b></span><br/>
						<div id='groupeCM'>
							<label class='radio-inline' ><input type='radio' name='groupeCM' value='1' ></input>CM</label>
						</div>

						<div id='groupeTD'>
							<label class='radio-inline'><input type='radio' name='groupeTD' value='1'></input>TD1</label>
							<label class='radio-inline'><input type='radio' name='groupeTD' value='2'></input>TD2</label>
						</div>
						
						<div id='groupeTP'>
							<label class='radio-inline'><input type='radio' name='groupeTP' value='1'></input>TP1</label>
							<label class='radio-inline'><input type='radio' name='groupeTP' value='2'></input>TP2</label>
							<label class='radio-inline'><input type='radio' name='groupeTP' value='3'></input>TP3</label>
							<label class='radio-inline'><input type='radio' name='groupeTP' value='4'></input>TP4</label>
						</div>
					</div>
					
					<!-- choix de la matiere, du prof et si il y a une evaluation -->
					<div id='matiere-prof' class='minibloc'>
						<span class='miniTitre'><b>Sélectionnez la matière et l'enseignant</b></span>
<?php
						/*ce fichier permet de recuperer dans un tableau $matieres le codeppn et les noms des matieres*/
						include 'app/matieres.php';
?>
						<div id='matiere'>
							<select id='matieres' name='matieres'>
								<option>--Choisissez une matière--</option>
<?php
								foreach($matieres as $k => $v){
									echo "<option class=\"selection\" value=\"$k\">$v</option>";
								}
?>		
							</select>
						</div>
											
						<div id='prof'>
							<select id='professeurs' name='professeur'>
							</select>
					
					<!-- checkbox pour evaluation -->
					</div id='eval'>	
						<label><input id='evaluation' name='eval' type='checkbox'></input>Evaluation</label>
					</div>
					
					<!-- Preparation d'un champ avec un calendrier -->
					<script src='js/datepickerfr.js'></script>
					<div id='calendrier'>
						<span class='miniTitre'><b>Sélectionnez la date de l'absence ou du retard:</b></span>
						<!--champ caché qui stocke la date selectionne pour l'utiliser en php-->
						<input type='hidden' id='cache'  name='date' value=''></input>
						<div id='datepicker'></div>
					</div>
					
					<!-- Gestion des plages horaires -->
					<div id='horaire' class='minibloc'>
						<span class='miniTitre'><b>Selectionnez l'horaire de l'absence:</b></span><br/>
						<select id='horaires' name='horaires[]' size='4' multiple>
<?php
								/*tableau des plages horaires*/
								$horaires = array("8h30-10h30", "10h30-12h30", "14h00-16h00", "16h00-18h00");
								$i = 0;
								foreach($horaires as $v){
									echo "<option class=\"selection\" value=\"$v\">$v</option>";
									$i++;
									echo $i;
								}
?>
						</select>
					</div>								
				</div>
			</div>			
		</form>
		<!--Bouton de d'enregistrement des absences et des retards-->
		<div align='center'>
			<button class='btn btn-default' id='valider' name='Submit'>Valider</button>		
		</div>	
	</body>
</html>