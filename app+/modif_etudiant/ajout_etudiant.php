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
	<link rel="stylesheet" href="css/ajout_etudiant.css"/>
	<script src="./js/modif_etudiant.js"></script>
	

	<head>
		<meta name="Auteur" content="Noga Lucas">
    	<meta name="Date" content="2016-02-22T08:49:37+00:00">
		<title>Ajout etudiant</title>
		<meta charset = "utf-8"/>
	</head>
	<body>
		<div id="conteneur">
			<h1 id="titre">Page pour les etudiants</h1>
			<a id='accueil' href="../../index.php">Revenir à l'accueil</a><br/>
			<a href='modif_etudiant.php'>Liste des étudiants</a><br/>

<?php
		if(!empty($_SESSION['error_etudiant'])){
?>
			<div class='alert alert-warning' role='alert'>
				<?php echo implode('<br>',$_SESSION['error_etudiant']);
				?>
			</div>
<?php
		}
		$_SESSION['error_etudiant'] = array();
?>
	

		<div id="bloc">
			<form id='form' method='post' action="formulaire_ajout_etudiant.php">
				<!--Choix de la filiere-->
				<table id='table_champs'>
					<tr>
						<td><label>Nom</label></td>
						<td><input name='nom' type='text' size='20'></input>	</td>
					</tr>
					
					<tr>
						<td><label>Prenom</label></td>
						<td><input name='prenom' type='text' size='20'></input>	</td>
					</tr>
					
					<tr>
						<td><label>Numero etudiant</label></td>
						<td><input name='id' type='text' size='20'></input>		</td>
					</tr>
					
					<tr>
						<td><label>Mail</label></td>
						<td><input name='mail' type='text' size='20'></input>	</td>
					</tr>
				</table>

				<div class='minibloc'>
					<span class='miniTitre'>Filiere</span><br/>
					<select id='selectfiliere' name='filiere'>
						<option selected>Choississez une filiere</option>
						<option value='info'>info</option>
						<option value='mmi'>mmi</option>
						<option value='geii'>geii</option>
					</select>
				</div>

				<div class='minibloc'>
					<span class='miniTitre'>Promotion</span><br/>
						<input class='radio-inline' name='annee' type='radio' value='1'>  1</input>
						<input class='radio-inline' name='annee' type='radio' value='2'>  2</input>
				</div>

				<!-- choix du groupe -->
				<div class='minibloc'>
					<span class='miniTitre'>Selectionnez un CM, un TD et un TP:</span><br/>
					<div id='groupeCM'>
						<label class='radio-inline'><input type='radio' name='groupeCM' value='1' ></input>CM</label>
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

				<div id='submit'>
					<input class="btn btn-default" type='submit' value='Enregistrer'></input>
				</div>

		
			</form>	
		</div>
	</body>
</html>