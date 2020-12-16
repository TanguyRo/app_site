<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>

.div_page{
    width: 80%;
    margin: auto;
}

.div_page header {
    margin: 2rem;
    text-align: center;
}

.div_page header h2 {
    color: white;
    font-size: 1.2rem;
}

/* On enlève tout le style par défaut des boutons */
button {
    display: inline-block;
    border: none;
    text-decoration: none;
    background: none;
    font: inherit;
    cursor: pointer;
    text-align: center;
    margin: 0;
    padding: 0;
}
button:hover,button:focus {
    background: white;
    outline: none
}
button:active {
    color: black;
}
/* On enlève tout le style par défaut des boutons */


.bandeau_question {
    padding: 0.5rem 1rem ;
    padding-right: 0.4rem;
    background-color: white;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bandeau_question h3 {
    font-size: 1.1rem;
    margin:0;
}

.bandeau_question h3:hover {
    color: #00A3B8;
}

.fleche_expand {
    height: 0.6rem;
}

.fleche_expand_down {
    height: 0.6rem;
    transform: rotate(180deg);
}

.question {
    margin-bottom: 1rem;
}

.dropdown-content {
    /**display: none;    paramètre passé dans le html pour fonctionner avec la fonction js**/
    background-color: #DEDEDE;
    margin:0;
    border-radius: 0 0 0.5rem 0.5rem;
    padding: 1rem;
    text-align: justify;
}

.div_page footer {
    margin: 2rem 0;
    text-align: center;
    color: white;
}

.div_page footer a {
    text-decoration: none;
    color: #00A3B8;
}

