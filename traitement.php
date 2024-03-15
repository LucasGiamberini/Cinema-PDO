<?php
// <form action="index.php?action=update" method="post" enctype="multipart/form-data">  
error_reporting(E_ALL);
ini_set('display_errors', 1);

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


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
echo $idMovie;
var_dump($idMovie);
var_dump($title);





if($title !== NULL ){
            
    $sql="UPDATE film
    SET title= :title
    where id_film= :id_film";

 $params= ["id_film"=>$id, "title"=>$title];

 $dao->executeRequest($sql,$params);


}
else if ($idDirector !== NULL){
   
   $sql="UPDATE film
    SET id_director= :id_director
    where id_film= :id_film";

$params= ["id_film"=>$id,"id_director" => $idDirector  ];    

$dao->executeRequest($sql,$params);
}

