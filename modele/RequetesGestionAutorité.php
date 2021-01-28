<?php

//Copie de la fonction dans requetes test
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


function AjouterAdresse(PDO $bdd, array $InfosAdresse): int {
	$add_adresse = $bdd->prepare('
		INSERT INTO adresse (NumeroRue, Rue, CodePostal, Ville, Region, Pays) 
		VALUES (:numeroRue, :rue, :code, :ville, :region, :pays)');
	$add_adresse->execute($InfosAdresse);
	$IdInsert = $bdd->lastInsertId();	//On récupère l'id de l'adresse créée
	return ($IdInsert);
}

//Ajoute une autorité
function AjouterAutorite(PDO $bdd, array $DonneesAutorite){
	$add_autorite = $bdd->prepare('
		INSERT INTO autoriteresponsable (Id, Type,Nom,Adresse_Id) 
		VALUES (:id, :type, :nom,:id_adresse)');
	$add_autorite->execute($DonneesAutorite);

	$IdAutorite = $DonneesAutorite['id'];	
	$add_compte = $bdd->prepare("
		INSERT INTO compte (Id, TypeCompte_Type,Personne_NIR) 
		VALUES (:id, 'AUE', :nir)");
	$add_compte->execute(array(
		'id' => $IdAutorite.'AUE',
		'nir' => $IdAutorite
		));
	$add_compte = $bdd->prepare("
		INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR) 
		VALUES (:id, 'POL', :nir)");
	$add_compte->execute(array(
		'id' => $IdPersonne.'POL',
		'nir' => $IdPersonne
		));


}

//Ajoute une entrée Compte
function AjouterCompte(PDO $bdd, string $NIR, string $TypeCompte, string $IdAutRes = null){
	if (empty($IdAutRes)) {
		$add_compte = $bdd->prepare(' INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR) VALUES (:id, :type_compte, :nir)');
		$add_compte->execute(array(
		'id' => $NIR.$TypeCompte,
		'type_compte' => $TypeCompte,
		'nir' => $NIR
		));
	}
	else {
		$add_compte = $bdd->prepare(' INSERT INTO compte (Id, TypeCompte_Type, Personne_NIR, AutoriteResponsable_Id) VALUES (:id, :type_compte, :nir, :aut_res_id)');
		$add_compte->execute(array(
		'id' => $NIR.$TypeCompte,
		'type_compte' => $TypeCompte,
		'nir' => $NIR,
		'aut_res_id' => $IdAutRes
		));	
	}
}


function UpdateCompte(PDO $bdd, string $NIR, string $TypeCompte, string $IdAutRes = null){
	if (empty($IdAutRes)) {
		$update_compte = $bdd->prepare('UPDATE compte SET Id=?, TypeCompte_Type=? WHERE autorite_NIR=?');
		$update_compte->execute(array($NIR.$TypeCompte, $TypeCompte, $NIR));
	}
	else {
		$update_compte = $bdd->prepare('UPDATE compte SET Id=?, TypeCompte_Type=?, AutoriteResponsable_Id=? WHERE autorite_NIR=?');
		$update_compte->execute(array($NIR.$TypeCompte, $TypeCompte, $IdAutRes, $NIR));
	}
}

function CompteProExistant(PDO $bdd, string $NIR){
	$exist_compte = $bdd->prepare('SELECT * FROM compte WHERE autorite_NIR=? AND TypeCompte_Type!="CIT" AND TypeCompte_Type!="ADM"');
	$exist_compte->execute(array($NIR));
	$exist=$exist_compte->fetch();
	if($exist!=null){
		return true;
	}else{
		return false;
	}
}

function TailleRechercheAutorite(PDO $bdd, string $regex = '%%', string $conditionsfiltres="", string $conditionsfiltrenbtests="") : int {
	$requete = 'SELECT COUNT(Boitier.Id) AS NbBoitier FROM autoriteresponsable JOIN Adresse ON autoriteresponsable.Adresse_Id=Adresse.Id LEFT JOIN boitier ON boitier.AutoriteResponsable_Id = autoriteresponsable.Id WHERE (autoriteresponsable.Id LIKE :regex OR autoriteresponsable.Nom LIKE :regex) ' . $conditionsfiltres . 'GROUP BY Id '. $conditionsfiltrenbtests ;
	$search = $bdd->prepare($requete);
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->execute();
	$count = $search->rowCount();
	return $count;
}

function RechercherAutorite(PDO $bdd, int $page, string $regex = '%%', string $conditionsfiltres="", string $conditionsfiltrenbtests="") : array {
	/**
	La requête SQL permet d'aller récuperer dans la base de donnée
	les informations concernant des utilisateurs en fonction des différents
	choix fait dans le formulaire (et donc les filtres).
	**/
	$offset = $page * 10 - 10;
	/**
	La requête SQL permet d'aller récuperer dans la base de donnée
	les informations concernant des utilisateurs en fonction de la
	recherche demandée
	**/
	$requete = 'SELECT Id, Type, Nom, COUNT(Boitier.Id) AS NbBoitier FROM autoriteresponsable JOIN Adresse ON autoriteresponsable.Adresse_Id=Adresse.Id LEFT JOIN Boitier ON Boitier.AutoriteResponsable_Id = autoriteresponsable.Id WHERE (autoriteresponsable.Id LIKE :regex OR autoriteresponsable.Nom LIKE :regex) ' . $conditionsfiltres . 'GROUP BY Id ' . $conditionsfiltrenbtests . 'ORDER BY autoriteresponsable.Nom, autoriteresponsable.Id ASC LIMIT 10 OFFSET :offset' ;
	$search = $bdd->prepare($requete);
	//Le offset doit être interprété comme un int donc on précise les paramètres de cette manière
	$search->bindValue(':regex', $regex);
	$search->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
	$search->execute();
	return $search->fetchAll();
}

function MiseAJour_autorite($bdd, $nom,$type,$id){
	// La base de donnée est Mise à Jour (UPDATE) avec les informations du formulaire
	// Mise à Jour de la table "autorite"
	$update = $bdd->prepare("UPDATE autoriteresponsable SET Nom=?, Type=? WHERE Id=?");
	$update->execute(array($nom,$type,$id));
	$update->closeCursor();
}

function MiseAJour_adresse($bdd, $numeroRue, $rue, $code, $ville, $pays, $region, $id, $NIR){
	// Mise à Jour de la table "adresse"
	if($id!=0){
		if(!empty($region)){
			$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=?, Region=? WHERE Id=?');
			$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $region, $id));
		}else{
			$update = $bdd->prepare('UPDATE adresse SET NumeroRue=? , Rue=? , CodePostal=? , Ville=? , Pays=? WHERE Id=?');
			$update->execute(array($numeroRue, $rue, $code, $ville, $pays, $id));
		}
	}else{
		$InfosAdresse = array($numeroRue, $rue, $code, $ville, $region, $pays);
		$Id_Adresse=AjouterAdresse($bdd, $InfosAdresse);

		$update = $bdd->prepare('UPDATE autorite SET Adresse_Id=? WHERE NIR=?');
		$update->execute(array($Id_Adresse, $NIR));
	}
	$update->closeCursor();
}

/**function AdresseExistante($bdd, $id){
	$adresse=$bdd->prepare('SELECT * FROM adresse WHERE Id=?');
	$adresse->execute(array($id));
	$IsZero=$adresse->fetch();
	if($IsZero['Id']!=0){
		return true;
	}else{
		return false;
	}
}**/

function ModifierAutResCompte(PDO $bdd, string $NIR, string $TypeCompte, string $IdAutRes){
	if (empty($IdAutRes)) {
		$update = $bdd->prepare('
			UPDATE Compte 
			SET AutoriteResponsable_Id = null
			WHERE autorite_NIR = ? AND TypeCompte_Type = ?');
		$update->execute(array($NIR, $TypeCompte));
	}
	else {
		$update = $bdd->prepare('
			UPDATE Compte 
			SET AutoriteResponsable_Id = ?
			WHERE autorite_NIR = ? AND TypeCompte_Type = ?');
		$update->execute(array($IdAutRes, $NIR, $TypeCompte));
	}
}

//
function ListeAdresses1Autorite(PDO $bdd) {
	$select  = $bdd->prepare('
	SELECT Adresse.Id as Id, COUNT(autoriteresponsable.Id) as NombreAutorité
	FROM `Adresse` 
	JOIN autoriteresponsable on autoriteresponsable.Adresse_Id=Adresse.Id
	GROUP BY (Adresse.Id)
	HAVING NombreAutorité=1');
	$select->execute();
	$ListeAdresses =array();
	while ($adresse = $select->fetch()) {
		array_push($ListeAdresses, $adresse['Id']);
	}
	return $ListeAdresses;
}

function SupprimerUtilisateur($bdd, $NIR){
	/**
	Suppression de l'Autorité où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table autorite par une clé étagère.
	**/
	$supprimerautorite = $bdd->prepare('DELETE FROM autoriteresponsable WHERE Id=?');
	$supprimerautorite->execute(array($id));

	$requete = $bdd->prepare("SELECT Adresse_Id FROM autoriteresponsable WHERE Id = ? ");
	$requete->execute(array($id));
	$Adresseautorite = $requete->fetch()['Adresse_Id'];

	//Si ce n'est pas l'adresse 0 qu'on attribue à tout ceux qui ne remplisse pas les champs adresse
	if ($Adresseautorite != 0){
		$ListeAdresses1autorite = ListeAdresses1autorite($bdd);
		//Si l'adresse n'appartient qu'à cette autorite, on peut la supprimer
		if (in_array($Adresseautorite, $ListeAdresses1autorite)) {
			$supprimer = $bdd->prepare('DELETE FROM Adresse WHERE Id=?');
			$supprimer->execute(array($Adresseautorite));
		}
	}
}

function SupprimerCompte($bdd, $NIR){
	/**
	Suppression d'un compte où l'identifiant unique correspond avec la valeur
	du $_GET['NIR']
	Puis
	Suppression des données correspondantes dans la table adresse lié à 
	la table autorite par une clé étagère.
	**/
	$supprimer = $bdd->prepare('DELETE FROM compte WHERE AutoriteResponsable_Id=? AND TypeCompte_Type!="CIT" AND TypeCompte_Type!="ADM"');
	$supprimer->execute(array($NIR));
	$supprimer->closeCursor();
}

