<!DOCTYPE html>
<html>
<head>
	<title>TESTARISQ - Gestion des boitiers</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/GestionBoitiers.css" />
</head>

<body>

	<!-- Header -->
    <?php include("vues/Header.php"); ?>

	<div class="div_page">

		<?php 
			if (isset($_SESSION['MessageModifBoitiers'])) {
				echo ("<h4>".$_SESSION['MessageModifBoitiers']."</h4>");
			}
		?>

		<div id="ajout" class="bloc">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
				<h3>Ajouter un boîtier</h3>
				<?php 
					if ($Recherche==true) {
						echo("<img id=\"fleche1\" class=\"fleche_expand\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
					else {
						echo("<img id=\"fleche1\" class=\"fleche_expand_down\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
				?>
			</button>

			<?php 
				if ($Recherche==true) {
					echo("<div id=\"dropdown1\" class=\"dropdown-content\" style=\"display: none;\">");
				}
				else {
					echo("<div id=\"dropdown1\" class=\"dropdown-content\" style=\"display: block;\">");
				}
				
				require 'vues/BlocAjoutBoitier.php'; 
			?>
			</div>
		</div>

		<div id="recherche" class="bloc">
			<button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
				<h3>Rechercher un boîtier</h3>
				<?php 
					if ($Recherche==true) {
						echo("<img id=\"fleche2\" class=\"fleche_expand_down\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
					else {
						echo("<img id=\"fleche2\" class=\"fleche_expand\" src=\"vues/img/expand.png\" alt=\"fleche_expand\"/>");
					}
				?>
			</button>
			<?php 
				if ($Recherche==true) {
					echo("<div id=\"dropdown2\" class=\"dropdown-content\" style=\"display: block;\">");
				}
				else {
					echo("<div id=\"dropdown2\" class=\"dropdown-content\" style=\"display: none;\">");
				}
				
				require 'vues/BlocRechercheBoitiers.php'; 
			?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/fonctions_generiques.js"></script>
	<script type="text/javascript" src="js/AjoutBoitier.js"></script>
	<script type="text/javascript" src="js/RechercheBoitier.js"></script>

</body>
</html>