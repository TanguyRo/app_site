<?php
    if ($Vide == false) { 

        $PremiereQuestion = array_shift($faq);
?>
        <div class="question 1">
            <button class="bandeau_question" onclick=" BasculerAffichage('drop1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
                <h3><?=$PremiereQuestion['Question']?></h3>
                <img id="fleche1" class="fleche_expand_down" src="vues/img/expand.png" alt="fleche_expand">
            </button>
            <div id="drop1" class="dropdown-content" style="display: block;">
                <div id="rep1">
                    <p id="p1"><?=$PremiereQuestion['Reponse']?></p>
                </div>
                <?php if($Modifications == true) {?>
                <div class="bloc_boutons">
                    <button id="bouton1" onClick="TransformerChamp('1')">Modifier</button>
                    <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cet élément ?');" action="controleurs/SuppressionFAQ.php">
                        <input name="idsupp" value='1' type="hidden"/>
                        <button id="boutonsupp" type="submit">Supprimer</button>
                    </form>
                </div>
                <?php };?>
            </div>
        </div>
<?php
        foreach ($faq as $key) {

            $id = $key['Id'];
            $drop = "drop".$id;
            $fleche = "fleche".$id;
            $rep = "rep".$id;
            $p = "p".$id;
            $bouton = "bouton".$id;
            $classequestion = "class=\""."question ".$id."\"";
?>
            
            <div <?=$classequestion?> >
                <button class="bandeau_question" onClick=" BasculerAffichage('<?=$drop?>'); BasculerClasse('<?=$fleche?>','fleche_expand','fleche_expand_down') ">
                    <h3><?=$key['Question']?></h3>
                    <img id=<?=$fleche?> class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
                </button>
                <div id='<?=$drop?>' class="dropdown-content" style="display: none;">
                    <div id='<?=$rep?>'>
                        <p id='<?=$p?>'><?=$key['Reponse']?></p>
                    </div>
                    <?php if($Modifications == true) {?>
                    <div class="bloc_boutons">
                        <button id=<?=$bouton?> onClick="TransformerChamp('<?=$id?>')">Modifier</button>
                        <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cet élément ?');" action="controleurs/SuppressionFAQ.php">
                            <input name="idsupp" value='<?=$id?>' type="hidden"/>
                            <button id="boutonsupp" type="submit">Supprimer</button>
                        </form>
                    </div>
                    <?php };?>
                </div>
            </div>
                       
<?php 
        }
    }
    else {
        echo('<p style="text-align:center;color:white;">La F.A.Q. est vide.</p>');
    }

?>