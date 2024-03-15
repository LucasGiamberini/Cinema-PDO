<?php
require_once 'app/DAO.php';

class UpdateControler
{
    Public function addMenu(){
      
        require 'view/add/update/delete/choiceMenu.php';
    }
   

    ////////////////////Update///////////////////////////

    Public function updateMenu(){

        $dao= new DAO();

        $sqlSelectMovieUpdate= "SELECT film.title , DATE_FORMAT(date_release, '%Y' ) dateRealease , film.id_film 
        FROM film";

        $selectMovieToUpdate=$dao->executeRequest($sqlSelectMovieUpdate);

        require_once "view\add\updateMenu.php";
    }

    
    Public function updateForm($idMovie){

        $dao= new DAO();

        $params= ["id_film" => $idMovie];

        $sqlMovieChoice= 'SELECT title , id_film 
        From film
        WHERE id_film= :id_film  ';

         $sqlDirector='SELECT person.name ,person.firstname,director.id_director
        FROM director
        inner join person on director.id_person=person.id_person';

        $MovieChoice=$dao->executeRequest($sqlMovieChoice,$params );
        $selectDirectors=$dao->executeRequest($sqlDirector);

        require_once "view/add/update/delete/update.php";

    }

   
    Public function update($title,$release,$duration,$review,$sinopsis,$idDirector,$idMovie){
       
       
        $dao= new DAO();
        
        $params = ["id_film" => $idMovie];


        $sqlMovieOldInfo='SELECT id_director , date_release ,duration,picture
         from film
         where id_film= :id_film';

         $oldMovieInfo=$dao->executeRequest( $sqlMovieOldInfo,$params);

         $oldMovieInfos= $oldMovieInfo->fetch();
        // $params= ["id_film"=>$id, "title"=>$title, "date_release" => $release , "duration" => $duration,"note" => $review , "synopsis" => $sinopsis ,"picture" => $imageSrc,"id_director" => $idDirector ];

 // titre

if ($title  ) {
    $dao= new DAO();
    // Mise à jour du titre du film
    $sql = "UPDATE film SET title = :title WHERE id_film = :id_film";
    $params = ["id_film" => $idMovie, "title" => $title];
    $dao->executeRequest($sql, $params);
}

// director

if ($idDirector !== $oldMovieInfo &&  $idDirector !== '0') {
    // Mise à jour du réalisateur du film
    $sql = "UPDATE film SET id_director = :id_director WHERE id_film = :id_film";
    $params = ["id_film" => $idMovie, "id_director" => $idDirector];
    $dao->executeRequest($sql, $params);
}

//director

if ($review > 0   ) {
    $dao= new DAO();
    // Mise à jour de la note du film
    $sql = "UPDATE film SET note = :note WHERE id_film = :id_film";
    $params = ["id_film" => $idMovie, "note" => $review];
    $dao->executeRequest($sql, $params);
}

if ($release  !== $oldMovieInfo && $release !== "1895-01-01" ){
$dao= new DAO();
// Mise à jour de la date de sortie
$sql = "UPDATE film SET date_release = :date_release WHERE id_film = :id_film";
$params = ["id_film" => $idMovie, "date_release" => $release];
$dao->executeRequest($sql, $params);
} 

if( $duration !== '0'  ){
    $dao= new DAO();
// Mise à jour de la durée
$sql = "UPDATE film SET duration = :duration WHERE id_film = :id_film";
$params = ["id_film" => $idMovie, "duration" => $duration];
$dao->executeRequest($sql, $params);

}

if (trim($sinopsis) !== ''){
    $dao= new DAO();
    // Mise à jour du sinopsis
    $sql = "UPDATE film SET synopsis = :synopsis WHERE id_film = :id_film";
    $params = ["id_film" => $idMovie, "synopsis" => $sinopsis];
    $dao->executeRequest($sql, $params);
}


//upload image 

$target_directory = 'C:\\laragon\\www\\CINEMA-PDO\\public\\picture\\';
$target_file = $target_directory . basename($_FILES["picture"]["name"]); // Chemin complet du fichier
$maxFileSize = 250 *  1024; // Taille maximale autorisée en octets (ici, 250 ko),*1024 pour convertir les octet en kilo octet
$imageTailleInfo = filesize($_FILES["picture"]["tmp_name"]);

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));//stokage du type d'extension de l'image uploader
$extensions = ['jpg', 'png', 'jpeg', 'gif'];

if (in_array($imageFileType, $extensions) && $imageTailleInfo <$maxFileSize) {// verifie si l'extension de l'image est accepter et si la taille du fichier ne depasse pas 1 mo
    $uniqueFileName = uniqid() . '.' . $imageFileType; //uniqid() Générer un nom de fichier unique
        $target_file = $target_directory . $uniqueFileName; // Chemin complet avec nom de fichier unique
    move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);// et la sauvegarde si la condition est bonne
    $imageSrc = "public/picture/" . $uniqueFileName;// chemin source vers l'image
}


// mise a jour de l'image

if (isset($imageSrc)){

   /////////supprime l ancienne image du repertoire
   $imgToRemove = $oldMovieInfos['picture']; // Chemin de la suppression de l'image
   unlink($imgToRemove);

   
   
    $dao= new DAO();
    // Mise à jour du chemin de  l'image
    $sql = "UPDATE film SET picture = :picture WHERE id_film = :id_film";
    $params = ["id_film" => $idMovie, "picture" => $imageSrc];
    $dao->executeRequest($sql, $params);
}



        require_once 'view/add/update/delete/choiceMenu.php';
    }


  
    // pour recuperer les noms de realisateur
    Public function add(){
        $dao = new DAO();
        
        $sqlDirector='SELECT person.name ,person.firstname,director.id_director
        FROM director
        inner join person on director.id_person=person.id_person';

        $selectDirectors=$dao->executeRequest($sqlDirector);

        require_once 'view/add/update/delete/add.php';
    }
    //////////////////////supprimer /////////////////////////
// pour recuperer les films
    Public function deleteMenu(){
        $dao= new DAO();

        $sqlSelectMovie= 'SELECT film.title , film.date_release  , film.id_film, picture
        FROM film ';

        $selectMovieToDelete=$dao->executeRequest($sqlSelectMovie);

        require_once 'view\add\update\delete\delete.php';
    }


    
Public function delete($idMovieDelete){
    $dao= new DAO();

    $sqlDeletePicture='SELECT picture
    FROM film
    WHERE id_film= :id_film';
    
    $params= ['id_film' => $idMovieDelete  ];

    $pictureToDelete=$dao->executeRequest($sqlDeletePicture,$params);
    
    $picture=$pictureToDelete->fetch();
    if(isset($pictureToDelete)){
    /////////supprime l'image du repertoire
   $imgToRemove = $picture['picture']; // Chemin de la suppression de l'image
   unlink($imgToRemove);
    }
    
   

    $sqlDelete = 'DELETE FROM film
    WHERE  id_film=:id_film'; 

 
    $delete=$dao->executeRequest($sqlDelete,$params);

    require 'view/add/update/delete/choiceMenu.php';

}
    
    
    
    ///////////////////////ajout d'un nouveau film/////////////////////
    
    
    Public function upload($title,$release,$duration,$review,$sinopsis,$idDirector)
    {
        $dao = new DAO();


          // pour incrementer un  id
    $sqlFinalID='SELECT MAX(id_film) AS derniereID
    FROM film';
    $finalId=$dao->executeRequest($sqlFinalID);
    $result=$finalId->fetch();
    $dernierID=$result['derniereID'];
    $filmId= $dernierID +1;

//upload image 

$target_directory = 'C:\\laragon\\www\\CINEMA-PDO\\public\\picture\\';
$target_file = $target_directory . basename($_FILES["picture"]["name"]); // Chemin complet du fichier
$maxFileSize = 250 *  1024; // Taille maximale autorisée en octets (ici, 250 ko),*1024 pour convertir les octet en kilo octet
$imageTailleInfo = filesize($_FILES["picture"]["tmp_name"]);

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));//stokage du type d'extension de l'image uploader
$extensions = ['jpg', 'png', 'jpeg', 'gif'];

if (in_array($imageFileType, $extensions) && $imageTailleInfo <$maxFileSize) {// verifie si l'extension de l'image est accepter et si la taille du fichier ne depasse pas 1 mo
    $uniqueFileName = uniqid() . '.' . $imageFileType; //uniqid() Générer un nom de fichier unique
        $target_file = $target_directory . $uniqueFileName; // Chemin complet avec nom de fichier unique
    move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);// et la sauvegarde si la condition est bonne
    $imageSrc = "public/picture/" . $uniqueFileName;// chemin source vers l'image
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $params = ["id_film"=>$filmId, "title"=>$title, "date_release" => $release , "duration" => $duration,"note" => $review , "synopsis" => $sinopsis ,"picture" => $imageSrc,"id_director" => $idDirector ];



    $sqlUpload=' INSERT INTO film ( id_film ,title,date_release,duration, note , synopsis , picture , id_director)
    VALUE  (:id_film, :title , :date_release , :duration , :note , :synopsis , :picture , :id_director )';

    $upload= $dao->executeRequest($sqlUpload,$params);

  
    ?><script>uploadSuccess()</script><?php ;
    require_once "view\add\update\delete\choiceMenu.php";
  
    exit();
    }
}
