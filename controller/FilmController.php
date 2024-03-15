<?php
require_once 'app/DAO.php';


class FilmController
{
    // function qui permet de récupérer la liste de tout les films ajoutés en BDD
    public function listFilms()
    {
        $dao = new DAO();// il faut relancer une nouvelle requette a chaque fonction

        $sql = 'SELECT id_film, title, date_format(date_release, "%Y") year, duration, synopsis, note, picture 
                FROM film
                ORDER BY date_release DESC';

        $films = $dao->executeRequest($sql);
        require 'view/film/listFilms.php';
    }

   public function detailFilm($idFilm)
   {
    $dao = new DAO();

    //detail film + director
  
    $sqlDetailFilm = 
    'SELECT id_film, title, date_format(date_release, "%Y") year, TIME_FORMAT(SEC_TO_TIME(duration*60),"%H:%i") duration, synopsis, note, film.picture,
        person.name , person.firstname, person.id_person
    FROM film
        inner join director on film.id_director=director.id_director
        inner join person on director.id_person=person.id_person
    where id_film=:filmId ';

 
    $params = ["filmId" => $idFilm ];

    $film = $dao->executeRequest($sqlDetailFilm,$params);
 
    //Liste genre
 
    $sqlFilms = 'SELECT nameGenre ,genre.id_genre
    FROM film_genre
    INNER JOIN film ON film_genre.id_film = film.id_film
    INNer JOIN genre ON film_genre.id_genre = genre.id_genre
    where film_genre.id_film = :filmId';

    $filmGenres = $dao->executeRequest($sqlFilms, $params); 
   

    // Casting

    $sqlActeurRole= 
    'SELECT  person.name, person.firstname , person.id_person 
    FROM casting
    INNER JOIN actor ON casting.id_actor = actor.id_actor
    INNER JOIN person ON actor.id_person = person.id_person
    /* INNER JOIN role ... */
    where id_film=:filmId ';
    
    $castings = $dao->executeRequest($sqlActeurRole,$params);


    
    require 'view/film/detailFilm.php';
   }
}
