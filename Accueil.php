<?php

//On démarre la session
session_start();

require 'controleurs/FonctionAffichageAccueil.php'; 
 
//Si on est déja connectés
if (isset($_SESSION['TypeCompte'])) {

	$TypeCompte=$_SESSION['TypeCompte'];
	AffichageAccueil($TypeCompte); 

	// Dans le cas ou on revient d'un lancement de test raté depuis l'Accueil Autorité
	if ( ($TypeCompte=='AUE' OR $TypeCompte=='POL') AND (isset($_SESSION['ErreurLancementTest'])) ) {
		unset($_SESSION['ErreurLancementTest']);
	}

} 


//Si on vient de soumettre le formulaire 
else if (isset($_POST['identifiant'],$_POST['mdp'])) { 

	if ( (strlen($_POST['identifiant'])>=13) AND (strlen($_POST['identifiant'])<=16) AND $_POST['mdp'] !== "") {

		require 'controleurs/FonctionsGenerales.php'; 
		//On récupère l'identifiant et le mdp donné
		$IDCompte = securisation_totale($_POST['identifiant']);
		$MDP = securisation_totale($_POST['mdp']);
		$NIR = substr($IDCompte, 0, -3); //On enlève les trois caractères à la fin indiquant le type de compte
		$TypeCompteDemande = substr($IDCompte, -3);
		
		require 'modele/connexionbdd.php';
		require 'modele/RequetesGenerales.php';
		require 'modele/RequetesAccueil.php';

		if (BonneCombinaison($bdd,$NIR,$MDP)) {	//L'utilisateur existe et a fourni le bon mot de passe

			$_SESSION['NIR'] = $NIR;	//On note le NIR en session
            $_SESSION['Infos'] = InfosPersonne($bdd,$NIR);	//On note les infos de l'utilisateur en session

			if (ACompte($bdd,$NIR,$TypeCompteDemande)){	//S'il a bien le compte qu'il demande

				$_SESSION['TypeCompte'] = $TypeCompteDemande;
				AffichageAccueil($TypeCompteDemande); 

			}

			else {	//S'il n'a pas précisé de type de compte ou qu'il demande l'accès à un compte qu'il n'a pas, on renvoie à l'accueil citoyen
				$_SESSION['TypeCompte'] = 'CIT';
				AffichageAccueil('CIT');  
			}

		}

		else if (BonneCombinaison($bdd,$IDCompte,$MDP)) { //Si l'utilisateur rentre l'identifiant sans CIT mais que les données coincident 
			$_SESSION['NIR'] = $IDCompte;
			$_SESSION['Infos'] = InfosPersonne($bdd,$IDCompte);
			$_SESSION['TypeCompte'] = 'CIT';
			AffichageAccueil('CIT');  
		}

		else {
			//Combinaison incorrecte
			$mdp_incorrect=true;
			require 'vues/Authentification.php';
		}	

	}

	else {
		//Combinaison impossible (identifiant trop petit et/ou mot de passe vide)
		$mdp_incorrect=true;
		require 'vues/Authentification.php';
	}

}


else {
	$mdp_incorrect=false;
	require 'vues/Authentification.php';
}