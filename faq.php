<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
    header('Location: Accueil');
}

//On prépare la FAQ
require 'modele/connexionbdd.php';
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour voir les erreurs SQL
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
	$PageDemandee = $_GET['page'];
	$PageAffichage = DeterminerPageAfffichage ($PageDemandee, $PageMaximum);
}
else {
	$PageAffichage = 1;
}

$faq = RecupFAQ($bdd,$PageAffichage);

//On affiche la page
require 'vues/FAQ.php';



