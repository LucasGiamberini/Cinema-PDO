<?php
require_once 'app/DAO.php';


class GenreController
{
    // function qui permet de récupérer la liste de tout les films ajoutés en BDD
    public function listGenres()
    {
        $dao = new DAO();

        $sql = 'SELECT id_genre, nameGenre
                FROM genre
                ORDER BY nameGenre DESC';

        $genres = $dao->executeRequest($sql);
        require 'view/genre/listGenre.php';
    }

    public function listFilmGenre($idGenre){
        $dao = new DAO();

        // genre
        
        $sqlGenre = 'SELECT nameGenre
        FROM genre
        where id_genre = :genreId';

        $params = [
            "genreId" => $idGenre
        ];

        $genre = $dao->executeRequest($sqlGenre, $params);// execution de requette

        // films
        
        $sqlFilms = 'SELECT film.title,film.picture,film.id_film
        FROM film_genre
        INNER JOIN film ON film_genre.id_film = film.id_film
        where id_genre = :genreId';

        $films = $dao->executeRequest($sqlFilms, $params);

        // view

        require 'view/genre/listFilmGenre.php';
    }
}