<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style_commun.css" />
        <link rel="stylesheet" href="style/header.css" />
        <link rel="stylesheet" href="style/AccueilCitoyen.css" />
        <title>TESTARISQ - Accueil</title>
    </head>

<body>

    <!--Header-->
    <?php include("vues/Header.php");?>

    <div class="div_page">
        <h2 class="bienvenue">
            <?php echo 'Bienvenue ' . $Prenom1 . ' !'; ?>
        </h2>

        <section>
            <header>
                <h3 class='DerniersResultats'>Vos derniers résultats :</h3>
             </header>
                    
            <div class="graph">
                <h4>Temps de réaction aux sons et lumières des derniers tests (en secondes)</h4>
                <?php

                echo "<img src='modele/graph.php?Id=".$_SESSION['NIR']."'>";
                ?> 
            </div>

            <div class="tests">

                <?php // TestVide($bdd,$_SESSION['NIR']) ?>


                <?php 
                while ($resultat = $requete->fetch())
                {
                    echo '<a class="bouton" href="resultat_test_1.php?NIR='.$resultat["NIR"].'&Id_Resultat='.$resultat['Id'].'">Test du '.$resultat["DateDebut"].'</a>';
                }
                ?>
            </div>
        </section>
    </div>

</body>
</html>