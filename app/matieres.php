<?php

require './connexion.php';

/*Utiliser la connexion pour faire une requete*/
$sql = 'SELECT mcodeppn, mnom FROM module';
/*$req est un objet PDOSTATEMENT contenant les noms des professeurs*/
$req = $pdo->query($sql);

/*affiche les resulltats sous forme d'objet*/
$req->setFetchMode(PDO::FETCH_OBJ);

/* tous les professeurs et les stockes dans $professeurs*/
$mat = $req->fetchAll();

/*le nom des matieres dans $matieres*/
$matieres = array();
foreach ($mat as $matnom) {
	$matieres[$matnom->mcodeppn] = $matnom->mnom;
}

?>
		
