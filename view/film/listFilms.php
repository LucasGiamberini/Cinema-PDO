<?php
ob_start(); //def : Enclenche la temporisation de sortie

?>

    <div>
        <h1>List of movie <span><?= $films->rowCount() // pour faire defiler le tableau ?></span></h1> 
           <div class=movie>
            <?php
                while ($film = $films->fetch()) { ?>
                   
                        <figure>
                            <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                                <img class=poster src="<?= $film["picture"]; ?>" alt="picture of film : <?= $film["title"]; ?>">
                            </a>
                            <figcaption>
                                <a  class=movieTitle  href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><strong><?= $film['title'] ?></strong></a>
                            </figcaption>
                        </figure>

                    
                <?php }
                ?>
        </div>
    </div>

<?php

$title = "List of Films";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
