<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<div class="movieList">
        <h2>
    Most Recent Movie
    </h2>
    <div class="movie">
    <?php
    while ($film = $films->fetch()) { ?>
                    
                        <figure>
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

<div class="movieList">
    <h2>
Best Reviewed Movie
</h2>
    <div class="movie">
    <?php
        while ($film = $notes->fetch()) { ?>
                
                    <figure>
                        <a href="index.php?action=detailFilm&id=<?=$film['id_film']?>">
                            <img class=poster src="<?= $film["picture"]; ?>" alt="picture of film : <?= $film["title"]; ?>">
                         </a>
                        <figcaption>
                            <a class=movieTitle href="index.php?action=detailFilm&id=<?=$film['id_film']?>"><strong><?= $film['title'] ?></strong></a>
                        </figcaption>
                        <p class=movieTitle>
                         <?= $film['note']?> /10
                        </p>
                    </figure>

               
            <?php }
            ?>
     </div>
</div>
<?php
$title = "Home Page";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
