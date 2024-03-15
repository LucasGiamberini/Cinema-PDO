<?php
ob_start(); //def : Enclenche la temporisation de sortie

?>
<div class="menuMovieChoiceUpDel">
<h1 class="title">  Choice the movie to delete </h1>
<form class="menuMovieChoiceUpDel" action="index.php?action=delete" method="post" > 
                <label for="choix">Select movie :</label>
                         <select id="choice" name="Deletechoice"> <!-- name pour les entré des filtres  pour les valeurs -->
                         <?php
                        while ($selectMovie = $selectMovieToDelete->fetch() ) { ?>       
                        <option  value="<?= $selectMovie['id_film']?>"><?=   $selectMovie['title']. "  ( " . $selectMovie['date_release'] ." ) "    ?></option>
                        
                        <?php 
                         }
                        ?>
      <!-- Ajoutez autant d'options que nécessaire -->
    </select><br><br>

    
      
    <input  class="button" type="submit" id="submit" value="Delete" name="delete" >
        </form>   
</div>
<?php
$title = "Delete Movie ";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";