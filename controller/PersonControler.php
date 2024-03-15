<?php
require_once 'app/DAO.php';


class PersonControler
{
    

   public function detailPerson($idPerson)
   {
    $dao = new DAO();

    // detail personne
  
    $sqlDetailPerson = 
    'SELECT person.name, person.firstName , person.gender , DATE_FORMAT(person.dateBirth , "%d/%m/%Y") AS date_formattee,person.biography,person.picture
    FROM person
    where id_person=:personId ';

 
    $params = ["personId" => $idPerson ];

    $person = $dao->executeRequest($sqlDetailPerson,$params);
    
         //Liste Film acteur

    $sqlFilmActor= 'SELECT film.title ,film.id_film, role.roleName
    FROM casting
    INNER JOIN film ON casting.id_film = film.id_film
    INNER JOIN actor ON casting.id_actor = actor.id_actor
		INNER JOIN person ON actor.id_person=person.id_person
   INNER JOIN role ON Casting.id_role= role.id_role
    WHERE actor.id_person = :personId';
 
    $movieActor= $dao->executeRequest($sqlFilmActor,$params);

     //Liste Film realisateur

     $sqlFilmDirector= 'SELECT film.title ,film.id_film
     FROM film
     INNER JOIN director ON film.id_director = director.id_director
     WHERE director.id_person = :personId';
  
     $movieDirector= $dao->executeRequest($sqlFilmDirector,$params);
 
    // verification si acteur

    $sqlActor =
    'SELECT id_person
    from actor
    where id_person =:personId';

    $params = ["personId" => $idPerson ];

    $actor = $dao->executeRequest($sqlActor,$params);



 // verification si realisateur

    
    $sqlDirector =
    'SELECT id_person
    from director
    where id_person =:personId';

    $params = ["personId" => $idPerson ];

    $director = $dao->executeRequest($sqlDirector,$params);

  
        


    require 'view/person/detailPerson.php';
   }
}