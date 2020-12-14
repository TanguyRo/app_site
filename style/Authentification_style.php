<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>

.div_page{
    width: 60%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.div_page img{
    width: 20rem;
    margin: 4rem;
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
}
button:hover,button:focus {
    background: none;
    outline: none
}
button:active {
    transform: scale(0.99);
}
/* On enlève tout le style par défaut des boutons */


.div_page button {
    background-color: white;
    border-radius: 5rem;
    font-weight: 400;
    text-transform: uppercase;
    padding: 0.75rem 1.25rem;
}

#formulaire {
    margin-top: 10rem;
    margin-bottom: 15rem;
    width: 20rem;
    background:white;
    padding: 1rem;
    padding-top: 2rem; 
    border-radius:1rem;
}

#formulaire label {
    font-weight: 600;
}

#formulaire input {
    border: none;
    border-radius: 0.25rem;
    background-color: #DDD;
    box-sizing: border-box;
    padding: 0.25rem;
    width: 100%;
    margin-bottom: 1rem;
}

#formulaire button {
    margin-top: 1rem;    
    background-color: #B8B8B8;
    border-radius: 0.5rem;
    font-size: 0.8rem;
    display: block;
    margin-left: auto;
    margin-right: auto;
    font-weight: 700;
    text-transform: uppercase;
    padding: 0.5rem 1rem;
}