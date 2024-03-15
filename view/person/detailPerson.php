<?php
ob_start(); //def : Enclenche la temporisation de sortie
$person= $person->fetch(); 
?>

<div class=personBio>
    <h1 class="title"><?= $person['firstName'] . "    ".$person['name'] ?> </h1>
<div id="pictureDetail">   
    <figure>
        <img id=portrait src=<?= $person ['picture'] ?> >
</figure>
<div class=personBio>
<p> First name : <?= $person['firstName'] ?> <br> </p>
<p>  Name :<?= $person['name'] ?>  </p>
<p> Date of birth:<?= $person['date_formattee'] ?> </p>
<p> Job : 
    <?php
    // affichage si la personne est un realisateur
        if ($director->rowCount() === 0 ) {
            echo '';
        } else {
            echo 'director';
        }
    // affichage si acteur

    if ($actor->rowCount() === 0) {
        echo '';
    } else {
        echo 'actor';
    }
    
    ?>
    </p>
    Filmography :  </p>
        
        <?php //film pour realisateur
             while ($movie = $movieDirector->fetch()) { 
                ?>
                <figcaption>
                                <a href="index.php?action=detailFilm&id=<?=$movie['id_film']?>"><?= $movie['title'] ?></a> as Director 
                </figcaption> 
                
        <?php
            };
            ?>
        
        <?php // film pour acteur
        foreach( $movieActor as $movie) { 
            ?>
            <figcaption>
                            <a href="index.php?action=detailFilm&id=<?=$movie['id_film']?>"><?= $movie['title'] ?> </a>On the role of <?=$movie['roleName'] ?>
             </figcaption>

            
    
    <?php
        };
        ?>
        </div>



</div>   

</div>


<article id="biography" >
<h2 class="leftRed"> Biography : </h2><br>
    <p> <?= $person['biography'] ?> </p>
<br>
<div>
<p>
  
</article>


      
    </div>

    <?php
$title = "Detail of Person "  ;
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";// les deux petit point sont pour acceder au dossier parent
