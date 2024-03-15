<?php
ob_start(); //def : Enclenche la temporisation de sortie

$genre = $genre->fetch();
?>

    <div>
        <h1>Movie list for genre <span><?= $genre["nameGenre"] ?></span></h1>
        <div class=movie>
       <?php
            while ($film = $films->fetch()) { // pour faire defiler les infos du tableau?>
                
                    <figure>  <!-- penser a modifier la requette sql avant et attention a l'id en dessous pour index.php -->
                        <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                            <img class=poster src="<?= $film["picture"]; ?>" alt="picture of film : <?= $film["title"]; ?>">
                        </a>
                        <figcaption>
                            <a class=movieTitle href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><strong><?= $film['title'] ?></strong></a>
                        </figcaption>
                    </figure>

                
            <?php }
            ?>

            </div>
    </div>

<?php

$title = "Movie list for genre    ".$genre["nameGenre"];
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";