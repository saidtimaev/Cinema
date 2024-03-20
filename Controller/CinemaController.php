<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class CinemaController{
    

    public function pageAccueil() {

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        $pdo = Connect::seConnecter();
        // On appelle la méthode query() sur de l'objet de la classe PDO
        $requeteSortiesRecentes = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note, film_affiche, CONCAT(personne_prenom,' ', personne_nom) as realisateur
            FROM film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON personne.id_personne = realisateur.id_personne
            ORDER BY DATE(film_date_sortie) DESC
            LIMIT 5
        ");


        $requeteFilmsMieuxNotes = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note, film_affiche, CONCAT(personne_prenom,' ', personne_nom) as realisateur
            FROM film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON personne.id_personne = realisateur.id_personne
            ORDER BY film_note DESC
            LIMIT 5
        ");

        $requeteFilmsMieuxNotes2 = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note, film_affiche
            FROM film
            ORDER BY film_note 
            LIMIT 5
        ");

        $requeteGenres = $pdo->query("
            SELECT genre_libelle, genre.id_genre, genre_affiche, COUNT(id_film) as nombre_films
            FROM genre
            INNER JOIN genre_film ON genre.id_genre = genre_film.id_genre
            GROUP BY genre.id_genre
            LIMIT 5
        ");

        


        $requeteActeurs = $pdo->query("
            SELECT acteur.id_acteur,personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe, personne_photo, COUNT(acteur.id_acteur) as nombre_roles
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN casting_film ON casting_film.id_acteur = acteur.id_acteur
            GROUP BY acteur.id_acteur
            LIMIT 5
        ");

        $requeteRealisateurs = $pdo->query("
            SELECT realisateur.id_realisateur,personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe, personne_photo, COUNT(realisateur.id_realisateur) as nombre_films_realisateur
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            INNER JOIN film ON film.id_realisateur = realisateur.id_realisateur
            GROUP BY realisateur.id_realisateur
            LIMIT 5
        ");

        require "view/pageAccueil.php";    
        
    }   
    
    

    

    
}




