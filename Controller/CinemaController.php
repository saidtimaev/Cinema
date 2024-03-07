<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class CinemaController{

    // Lister les films 
    public function listeFilms(){

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        $pdo = Connect::seConnecter();
        // On appelle la méthode query() sur de l'objet de la classe PDO
        $requete = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note
            FROM film
        ");

        //  inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
        require "view/listes/listeFilms.php";

        // include ""; inclut le contenu d'un autre fichier appelé, mais ne provoque pas d'erreur bloquante s'il est indisponible
        
    }  
    
    // Lister les acteurs 
    public function listeActeurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
        ");

        require "view/listes/listeActeurs.php";
    }

    // Lister les réalisateurs 
    public function listeRealisateurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_realisateur, personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ");

        require "view/listes/listeRealisateurs.php";
    }

    // Lister les genres 
    public function listeGenres(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT genre_libelle, id_genre
            FROM genre
        ");

        require "view/listes/listeGenres.php";
    }

    // Lister les genres 
    public function listeRoles(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT role_nom, id_role
            FROM role
        ");

        require "view/listes/listeRoles.php";
    }

    // Afficher infos d'un film 
    public function infosFilm($id){

        $pdo = Connect::seConnecter();

        $requeteInfosFilm = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, film_duree, film_note, film_synopsis, personne_nom, personne_prenom
            FROM film 
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON personne.id_personne = realisateur.id_personne
            WHERE id_film = :id
        ");

        $requeteInfosFilm->execute(["id"=>$id]);

        
        $requeteActeursRoles = $pdo->prepare("
            SELECT personne_prenom, personne_nom, role_nom
            FROM casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE casting_film.id_film = :id
        ");

        $requeteActeursRoles->execute(["id"=>$id]);

        require "view/infos/infosFilm.php";
    }

    // Afficher infos d'un acteur
    public function infosActeur($id){

        $pdo = Connect::seConnecter();

        $requeteInfosActeur = $pdo->prepare("
        SELECT personne_prenom, personne_nom, personne_sexe, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance
        FROM personne
        INNER JOIN acteur ON acteur.id_personne = personne.id_personne
        WHERE acteur.id_acteur = :id
        ");

        $requeteInfosActeur->execute(["id"=>$id]);

        
        $requeteActeurCastings = $pdo->prepare("
            SELECT personne_prenom, personne_nom, role_nom, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE casting_film.id_acteur = :id
            ORDER BY film_date_sortie DESC
        ");

        $requeteActeurCastings->execute(["id"=>$id]);

        require "view/infos/infosActeur.php";
    }

    // Afficher infos d'un réalisateur
    public function infosRealisateur($id){

        $pdo = Connect::seConnecter();

        $requeteInfosRealisateur = $pdo->prepare("
        SELECT personne_prenom, personne_nom, personne_sexe, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance
        FROM personne
        INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne
        WHERE realisateur.id_realisateur = :id
        ");

        $requeteInfosRealisateur->execute(["id"=>$id]);

        
        $requeteRealisateurFilms = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM film
            WHERE film.id_realisateur = :id
            ORDER BY film_date_sortie DESC
        ");

        $requeteRealisateurFilms->execute(["id"=>$id]);

        require "view/infos/infosRealisateur.php";
    }

    // Afficher infos d'un genre
    public function infosGenre($id){

        $pdo = Connect::seConnecter();

        $requeteInfosGenre = $pdo->prepare("
        SELECT genre_libelle
        from genre
        WHERE id_genre = :id
        ");

        $requeteInfosGenre->execute(["id"=>$id]);

        
        $requeteFilmsGenre = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM genre_film
            INNER JOIN film on film.id_film = genre_film.id_film
            WHERE genre_film.id_genre = :id
            ORDER BY film_date_sortie DESC
        ");

        $requeteFilmsGenre->execute(["id"=>$id]);

        require "view/infos/infosGenre.php";
    }

    // Afficher infos d'un rôle
    public function infosRole($id){

        $pdo = Connect::seConnecter();

        $requeteInfosRole = $pdo->prepare("
        SELECT role_nom
        from role
        WHERE id_role = :id
        ");

        $requeteInfosRole->execute(["id"=>$id]);

        
        $requeteActeursRole = $pdo->prepare("
        SELECT personne_prenom, personne_nom, personne_sexe, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
        FROM casting_film
        INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN film ON film.id_film = casting_film.id_film
        WHERE id_role = :id
        ORDER BY film_date_sortie DESC
        ");

        $requeteActeursRole->execute(["id"=>$id]);

        require "view/infos/infosRole.php";
    }

    // Ajouter genre affichage

    public function ajoutGenreAffichage(){
        require "view/ajouts/ajoutGenre.php";
    }

    // Ajouter un genre
    public function ajoutGenre(){

        if(isset($_POST['submit'])){

            // on crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
            $genreLibelle = filter_input(INPUT_POST, "genre_libelle",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
    
            // Si tous les champs on bien été remplis
            if($genreLibelle){
                
                // on crée un tableau avec nos caractéristiques
                $genre = [
                    "genre_libelle" => $_POST["genre_libelle"]
                ];
            }
        }   

        var_dump($_POST);
        $pdo = Connect::seConnecter();

        $requeteAjoutGenre = $pdo->prepare("
            INSERT INTO genre (genre_libelle) VALUE (:genre_libelle)
        ");

        $requeteAjoutGenre->execute(["genre_libelle"=>$_POST["genre_libelle"]]);

        require "view/ajouts/ajoutGenre.php";
    }
}