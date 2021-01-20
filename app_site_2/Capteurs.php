<?php 

session_start(); 
// Si l'utilisateur n'est pas connecté on le renvoie à l'accueil
if (!(isset($_SESSION['NIR']))) {
  header('Location: Accueil.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <link rel="stylesheet" href="style/style_commun.css" />
    <link rel="stylesheet" href="style/header.css" />
    <link rel="stylesheet" href="style/capteurs.css" />
  <title>TESTARISQ - Capteurs</title>
</head>
<body>

	<!-- Header -->
	<?php include("vues/Header.php"); ?>

  <div class='conteneur'>
    <section id='boitier_1'>
    <h2>Boîtier 1</h2>
    
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 1 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
    <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 2 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  <form method="post" action="traitement.php">
     <p>?>

         <label for="capteur">Capteur 3 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 4 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 5 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  </section>

  <section id='boitier_2'>
    <h2>Boîtier 2</h2>
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 1 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
    <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 2 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 3 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 4 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  <form method="post" action="traitement.php">
     <p>
         <label for="capteur">Capteur 5 :</label>
         <select name="capteur" id="capteur">
           <option value="temperature">Température</option>
             <option value="son">Son</option>
             <option value="lumiere">Lumière</option>
             <option value="frequence_cardiaque">Fréquence cardiaque</option>
             <option value="frequence_sonore">Fréquence sonore</option>
           <option value="rien">---</option>
         </select>
     </p>
  </form></p>
  </div>

</body>