<?php
ob_start(); //def : Enclenche la temporisation de sortie
$castings = $castings->fetchAll();
$film = $film->fetch();
// $director= $director->fetch();
?>

<div class="detail">
   <div>

        <h1 class="title"> 
            <?=$film ['title'] ?>
        </h1>
</div>
<div id="detail">
   <figure class=figurePoster>
                <img class=posterDetailMovie src="<?= $film ["picture"] ?>" alt="picture of film : <?= $film["title"]; ?>">
                 </figure>
                    <div id="info">
                        <p>
                            Year: <?=$film['year']?>
                        </p>
                        <div>
                        <p>
                            Genre: 
                       
                            <?php foreach($filmGenres as $genre){ ?>
                        
                                <a href="index.php?action=listFilmGenre&id=<?= $genre['id_genre'] ?>"><?= $genre['nameGenre'] ?></a>
                            
                            <?php
                            }
                            ?>
                               </p> 
                        </div>
                        <p>
                            Duration : <?= $film ['duration'] ?> Hours 
                        </p>
                        <p>
                        <div id="listActor">
                            Actor :
                                <?php
                                foreach ($castings as $casting) { ?>
                                    <div>
                                            <a href="index.php?action=detailPerson&id=<?=$casting['id_person']?>"> <?= $casting['firstname'] . ' ' . $casting['name']."     " ?>  </a>  ,
                                    </div>
                                    <br>
                                <?php }
                                ?>
                        </p>
                                </div>
                        <div>
                            <p>
                                Director : 
                                    <a href="index.php?action=detailPerson&id=<?=$film['id_person']?>"><?= $film['firstname'] . '  '. $film['name'] ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            <h3 id="review">
                Review :  <strong><?=$film['note']?></strong> / 10
            </h3>

             </div>

             <div class=bottomPoster>
        <article class="sinopsis">
        

            <h2 class="leftRed"> Synopsis:</h2><br>
            <p id="dataSinopsis">
                <?=$film['synopsis'] ?>
            </p>
         
        </article>
           
            </div>
</div>

<?php
       

$title = "Detail of Movie "  ;
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";// les deux petit point sont pour acceder au dossier parent
