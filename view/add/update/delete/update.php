<?php
ob_start(); //def : Enclenche la temporisation de sortie
$movie=$MovieChoice->fetch(); 

?>
<div class='form'>

    <h1 class="title ">  Updating <?= $movie['title'] ?> </h1><br>
  
        <form action="index.php?action=update" method="post" enctype="multipart/form-data">     
                <label for="photo">Movie picture :</label>
                        <input  type="file" id="photo" name="picture"  accept="image/*"><br><br>

                <label for="texte">Movie Title :</label>
                <input class="inputAdd" type="text" id="texte" name="title" ><br><br>

                
                <label for="texte">Sinopsis :(max 500 character)</label><br>
                <textarea class="inputAdd" type="text" id="sinopsis" name="sinopsis" rows="4" cols="50" maxlength="500" >
                </textarea><br><br>
        
               
                <label for="texte">Review :</label>
                <input class="inputAdd" type="number" step="any" name="review" min="0" max="10"  value= 0 placeholder="review"><br><br>

                
                <label for="texte"> Release Date :</label>
                <input class="inputAdd" type="date" step="any" name="date" min="1895-01-01" placeholder="review" value="1895-01-01"><br><br>

               
                <label for="texte"> Duration(in minute) :</label>
                <input class="inputAdd" type="number" pattern="[0-9]+" step="any" name="duration" min="0"  max="43200" value="0" placeholder="Duration"><br><br>

               
                <label for="choix">Select director :</label>
                         <select id="choice" name="choice">
                                <option  value="0 "> Not Changes</option>
                                <?php
                                        while ($selectDirector = $selectDirectors->fetch() ) { ?>       
                                        <option  value="<?=$selectDirector['id_director']?> "><?=$selectDirector['firstname']. "   " . $selectDirector['name'] ?></option>
                                        
                                <?php 
                                }
                                ?>
            
            <input type='hidden' name='MovieChoice' value="<?= $movie['id_film'] ?>">       
      <!-- Ajoutez autant d'options que nécessaire -->
    </select><br>
    <div class="buttonUpdate">
                <input  class="button" type="submit" id="submit" value="Submit" name="upload" >
        </div>  
        </form>   
</div>
<?php
$title = "Add & ";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";