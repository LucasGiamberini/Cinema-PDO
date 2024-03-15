<?php
ob_start(); //def : Enclenche la temporisation de sortie

?>
    <div>
        <h1>Lists of genre <span><?= $genres->rowCount() ?></span></h1>
        <div class="listGenre ">
            <?php
                while ($genre = $genres->fetch()) { ?>
                    <div>            
                        <a class="Decoration " href="index.php?action=listFilmGenre&id=<?= $genre['id_genre'] ?> "><strong><?= $genre['nameGenre'] ?></strong></a>
                    </div>
                <?php }
                ?>
        </div>
    </div>
<?php

$title = "List of Genre";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";