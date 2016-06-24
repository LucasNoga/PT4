<?php
	/*Fichier pour ce connecter a la base de données*/
	$host = "localhost";
	$db = "db_gesabs";
	$user = "root";
	$pass = "root";


	/*Faire une connexion avec la base de données*/
	try {
		$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
	} catch (PDOException $e) {
		echo 'impossible de se connecter à la base de données ' . $e->getMessage(). ", ". $e->getCode() ;
		die();
	}