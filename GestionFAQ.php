<?php 
require 'controleurs/FonctionsGenerales.php';

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
	header('Location: Accueil');
}
//S'il est connecté mais qu'il charge des pages non autorisées pour son type de compte on le renvoie à l'accueil
else if ( $_SESSION['TypeCompte']!='ADM' ) {	
	header('Location: Accueil');
}

//Partie traitement de l'ajout de question :
if (isset($_POST['question']) && isset($_POST['reponse'])){
		
	require 'modele/connexionbdd.php';
	require 'modele/RequetesFAQ.php';
	AjouterQuestion($bdd, securisation_totale($_POST['question']), securisation_totale($_POST['reponse']));

	$_SESSION['MessageModifFAQ'] = "Le nouvel élément a bien été ajouté." ;
	header('Location: GestionFAQ');
}

//Partie traitement de la modification de question
else if (isset($_POST['id_question'])){
		
	require 'modele/connexionbdd.php';
	require 'modele/RequetesFAQ.php';
	ModifQuestion($bdd, securisation_totale($_POST['id_question']),  securisation_totale($_POST['modifquestion']), securisation_totale($_POST['modifreponse']));

	$_SESSION['MessageModifFAQ'] = "L'élément a bien été modifié." ;
	header('Location: GestionFAQ');
}

else {
	if (isset($_SESSION['MessageModifFAQ'])) {
		$MessageModif = $_SESSION['MessageModifFAQ'];
		unset($_SESSION['MessageModifFAQ']);
	}
	else {
		$MessageModif = false;
	}

	//On prépare la FAQ
	require 'modele/connexionbdd.php';
	require 'modele/RequetesFAQ.php';
	require 'controleurs/FonctionsPagination.php';

	$PageMaximum = PageMaximum($bdd,'ElementFAQ');
	if ($PageMaximum==0){
		$Vide=true;
	}
	else{
		$Vide=false;
	}

	if (isset($_GET['page'])) {
		$PageDemandee = securisation_totale($_GET['page']);
		$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
	}
	else {
		$PageAffichage = 1;
	}

	$faq = RecupFAQ($bdd,$PageAffichage);

	//On affiche la page
	require 'vues/GestionFAQ.php';
}






