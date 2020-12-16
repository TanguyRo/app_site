<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.div_page header {
    margin: 2rem;
    text-align: center;
}

.div_page header h2 {
    color: white;
    font-size: 1.2rem;
}

section{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.container{
    width: 50%;
    padding: 2rem;
    box-shadow: 0 0 1.5rem #00000010;
    background-color: white;
    border-radius: 0.5rem;
    margin-bottom: 2rem;
}
.form-group{
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}
.form-group input, .form-group textarea {
    box-sizing:border-box;
    padding:0.5rem;
    border:none;
    border-radius:0.25rem;
    background-color:#DDD;
    margin-top: 0.25rem;
    margin-bottom: 0.25rem;
    width: 100%;
}

.form-group textarea{
    resize: vertical;
}
button[type="submit"]{
    font-family: 'Nunito Sans', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    border: none;
    outline: none;
    border-radius: 0.25rem;
    background-color: #B8B8B8;
    box-sizing: border-box;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    padding: 0.5rem 1.75rem;
    width: 100%;
    cursor: pointer;
    transition: .3s ease background-color;
}
button[type="submit"]:hover{
    background-color: #00A3B8;
}
#status{
    width: 90%;
    max-width: 500px;
    text-align: center;
    padding: 10px;
    margin: 0 auto;
    border-radius: 8px;
}
#status.réussir{
    background-color: rgb(211, 250, 153);
}
#status.erreur{
    background-color: rgb(250, 129, 92);
    color: white;
    animation: status 4s ease forwards;
}
@keyframes status{
  0%{
      opacity: 1;
      pointer-events: all;
  }
  90%{
    opacity: 1;
    pointer-events: all;
} 
100%{
    opacity: 0;
    pointer-events: none;
}     
