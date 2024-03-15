<?php
ob_start(); //def : Enclenche la temporisation de sortie

?>
<div class="menuMovieChoiceUpDel">
<p class="title">  Choice the movie to update </p>
<form  class="menuMovieChoiceUpDel" action="index.php?action=updateForm" method="post" > 
                <label for="choix">Select movie :</label>
                         <select id="choice" name="MovieChoice"> <!-- name pour les entré des filtres  pour les valeurs -->
                         <?php
                        while ($selectMovie = $selectMovieToUpdate->fetch() ) { ?>       
                        <option  value="<?= $selectMovie['id_film']?>"><?=   $selectMovie['title']. "  ( " . $selectMovie['dateRealease'] ." ) "    ?></option>
                        
                        <?php 
                         }
                        ?>
      <!-- Ajoutez autant d'options que nécessaire -->
    </select><br><br>

      
   


    <input  class="button" type="submit" id="submit" value="Select" name="select" >
        </form>   
</div>
<?php
$title = "Update Movie ";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";