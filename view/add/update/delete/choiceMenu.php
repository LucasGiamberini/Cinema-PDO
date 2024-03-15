<?php
ob_start(); //def : Enclenche la temporisation de sortie

?>
<h1 class="movieList"> 
    What do you want to do?
</h1>

<div class="menuUpdate">
    

    
        <a class="button" href="index.php?action=addChoice">Add</a>
    


    
        <a class="button" href="index.php?action=updateChoice">Update</a>
    
    
        <a class="button" href="index.php?action=deleteChoice">Delete</a>
    

</div>

<?php
$title = "Modify Menu";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";