<?php

require_once "controller/FilmController.php";
require_once "controller/HomeController.php";
require_once "controller/GenreControler.php";
require_once "controller/PersonControler.php";
require_once "controller/UpdateControler.php";
?>
<script src ="public\script.js" ></script>
<?php



// Appel de la function autoload pour charger automatiquement le bon controleur
spl_autoload_register(function ($class_name) {
    require_once 'controller/' . $class_name . '.php';
});

// variable declaration

$ctrFilm = new FilmController();
$ctrHome = new HomeController();
$ctrGenre= new GenreController();
$ctrPerson= new PersonControler();
$ctrAdd= new UpdateControler();






// verification bon format et taille image

if (isset($_POST["upload"]) or isset($_POST["update"])) {
    // Verification condition for image
    $target_directory = 'C:\\laragon\\www\\CINEMA-PDO\\public\\picture\\';
    $target_file = $target_directory . basename($_FILES["picture"]["name"]); // Complete file path

    $maxFileSize = 250 * 1024; // Maximum allowed size in bytes (250 KB)
    $imageTailleInfo = filesize($_FILES["picture"]["tmp_name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions = ['jpg', 'png',  'gif',"",'JPG'];

}




if (isset($_GET['action'])) {
    
    
   // id des films
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    // par défaut, pour les string et les types qui n'ont pas un filter sanitize spécifique : FILTER_SANITIZE_FULL_SPECIAL_CHARS

///////////////////////////////variable add/delete ////////////////////////////////////////


$title = filter_input(INPUT_POST,"title", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$sinopsis =  filter_input(INPUT_POST,"sinopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$review = filter_input(INPUT_POST,"review", FILTER_VALIDATE_FLOAT);
$release = filter_input(INPUT_POST,"date",FILTER_SANITIZE_NUMBER_INT  );
$duration = filter_input(INPUT_POST,"duration",FILTER_SANITIZE_NUMBER_INT ) ;

$idDirector = filter_input(INPUT_POST,"choice",FILTER_SANITIZE_NUMBER_INT ) ;

// pour choisir le film a modifier
$idMovie = filter_input(INPUT_POST,"MovieChoice",FILTER_SANITIZE_NUMBER_INT ) ;

//pour choisir le film a supprimer
$idMovieDelete = filter_input(INPUT_POST,"Deletechoice",FILTER_SANITIZE_NUMBER_INT ) ;



//////////////////////////////////////////////////////////////////////////////////////////////
    switch ($_GET['action']) {
        //insert here all the request to generate new page
        case "listFilms":
            $ctrFilm->listFilms();
            break;

        case "listFilmGenre":
            $ctrGenre->listFilmGenre($id);
            break;
        
        case "detailPerson":
            $ctrPerson->detailPerson($id);
            break;
        
        case "genreFilms":
            $ctrGenre->listGenres();
            break;

        case "detailFilm":
            $ctrFilm->detailFilm($id);
            break;

        case "updateMenu":
            $ctrAdd->addmenu();
            break;

        case "addChoice":
            $ctrAdd->add();
            break;

        case "upload":// pour ajouter un nouveau film au site
            if ($maxFileSize < $imageTailleInfo  ){
                ?><script> wrongPictureSize();</script><?php
                $ctrAdd->add();
                exit();
            }

    
            else {
                $ctrAdd->upload($title,$release,$duration,$review,$sinopsis,$idDirector);
             ?><script>uploadSuccess()</script><?php

             }           
                break;  
      
      
       
        
            case "deleteChoice"://menu du film a supprimer
         $ctrAdd->deleteMenu();
            break; 
         
         case "delete":// bouton supprimer
          $ctrAdd->delete($idMovieDelete);
          ?><script> deleteSuccess();</script><?php
            break;  
            
        case "updateChoice":// menu du choix de film a modifier
            $ctrAdd->updateMenu();
            break;

        case "updateForm":// validation du film a modifier
     
            $ctrAdd->updateForm($idMovie);
            break;    
            
        case "update":
            
                if ($maxFileSize < $imageTailleInfo  ){
                    ?><script> wrongPictureSize();</script><?php
                    $ctrAdd->updateMenu();
                    break;
                }
                  if ( !in_array($imageFileType, $extensions)){
                    ?><script> wrongPictureFormat();</script><?php
                    $ctrAdd->updateMenu();
                    break;
                }
                else {
                    $ctrAdd->update($title,$release,$duration,$review,$sinopsis,$idDirector,$idMovie);
                    ?><script> UpdateSuccess();</script><?php
               
                 }           
                    break;    
            
        default:// pour afficher quand un ?action est mal implementé
            echo "<h2>Le case \"" . $_GET['action'] . "\" n'est pas implémenté/reconnu</h2>";
            break;

    }
} else {
    //Si l'url de contient pas d'action enregistrer, ont fait appel au constructeur homepage, pour afficher la page d'acceuil par défaut
    $ctrHome->homePage();
}
