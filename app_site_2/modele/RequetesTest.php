<?php

function NIRExiste(PDO $bdd, string $NIR) : bool
{
	$requete = $bdd->prepare("SELECT * FROM Personne WHERE NIR = ? ");
	$requete->execute(array($NIR));
	$count = $requete->rowCount();
	if($count!=0) {
		return true;
	}
	else {
		return false;
	}

}

function BoitierExiste(PDO $bdd, int $IdBoitier) : bool
{
	$requete = $bdd->prepare("SELECT * FROM Boitier WHERE Id = ? ");
	$requete->execute(array($IdBoitier));
	$count = $requete->rowCount();
	if($count!=0) {
		return true;
	}
	else {
		return false;
	}
}

function NouveauTest(PDO $bdd, string $Coordonnees, string $NIRConducteur, int $IdBoitier) : int 
{
	$requete = $bdd->prepare("
	INSERT INTO Test (DateDebut, Position, Personne_NIR, Boitier_Id) 
	VALUES (CURDATE(), :position, :personne_nir, :boitier_id) 
	");
	$requete->execute(array(
		'position' => $Coordonnees, 
		'personne_nir' => $NIRConducteur, 
		'boitier_id' => $IdBoitier
	));
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id du test créé
	return ($IdInsert);
}

function IdCapteur(PDO $bdd, int $IdBoitier, int $IdTypeCapteur) : int
{
	$requete = $bdd->prepare("SELECT Id FROM Capteur WHERE Boitier_Id = ? AND TypeCapteur_Id = ?");
	$requete->execute(array($IdBoitier,$IdTypeCapteur));
	$IdCapteur = $requete->fetch();
	return $IdCapteur['Id'];
}

function NouvelleMesure(PDO $bdd, int $IdTest, int $IdCapteur) : int 
{
	$requete = $bdd->prepare("
	INSERT INTO Mesure (DateHeure, Test_Id, Capteur_Id) 
	VALUES (NOW(), :test_id, :capteur_id) 
	");
	$requete->execute(array(
		'test_id' => $IdTest, 
		'capteur_id' => $IdCapteur
	));
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id de la mesure créée
	return ($IdInsert);
}

function ResultatMesure($bdd,$IdMesure) {
	$requete = $bdd->prepare("
		SELECT M.Valeur, T.UniteMesure 
		FROM Mesure as M
		INNER JOIN Capteur as C ON M.Capteur_Id = C.Id  
		INNER JOIN TypeCapteur AS T ON C.TypeCapteur_Id = T.Id
		WHERE M.Id = ? ");
	$requete->execute(array($IdMesure));
	$donnees = $requete->fetch();
	$ResultatFR = round($donnees['Valeur'],6) . $donnees['UniteMesure'];
	return $ResultatFR;

}

function ValeurRentree($bdd,$IdMesure)
{

	$requete = $bdd->prepare("SELECT Valeur FROM Mesure WHERE Id = ? ");
	$requete->execute(array($IdMesure));
	$resultat = $requete->fetch();
	if(is_null($resultat['Valeur'])) {
		return false;
	}
	else {
		return true;
	}

}

function AfficherResultat($bdd,$Valeur) //Pour afficher les résultats sur la page résultat.php
{
	$requete = $bdd->prepare("SELECT Valeur FROM mesure INNER JOIN test ON (mesure.Test_ID = test.Id) ");
	$requete->execute(array($Valeur));
	$resultat = $requete->fetch();
	return $Valeur;
}