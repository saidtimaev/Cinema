<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class CastingController {

    // Lister les castings
    public function listeCastings(){
        $pdo = Connect::seConnecter();
        $requeteListeCastings = $pdo->query("
            SELECT film_titre, role_nom, personne_prenom, personne_nom
            from casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            
        ");

        require "view/listes/listeCastings.php";
    }

    public function ajoutCastingAffichage(){

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        $pdo = Connect::seConnecter();

        // Pour récupèrer la liste des films
        $requeteListeFilms = $pdo->query("
            SELECT id_film, film_titre
            FROM film
            ORDER BY film_titre
        ");

        // Pour récupèrer la liste des rôles
        $requeteListeRoles = $pdo->query("
            SELECT role_nom, id_role
            FROM role
            ORDER BY role_nom
        ");

        $requeteListeActeurs = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY personne_nom
        ");

        require "view/ajouts/ajoutCasting.php";

    }

    public function ajoutCasting(){
        // var_dump($_POST);die;
        if(isset($_POST['submit'])){

            $idFilm = filter_input(INPUT_POST, "film",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idRole = filter_input(INPUT_POST, "role",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idActeur = filter_input(INPUT_POST, "acteur",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::seConnecter();

            // Pour récupèrer la liste des films
        $requeteListeFilms = $pdo->query("
        SELECT id_film, film_titre
        FROM film
        ORDER BY film_titre
        ");

        // Pour récupèrer la liste des rôles
        $requeteListeRoles = $pdo->query("
            SELECT role_nom, id_role
            FROM role
            ORDER BY role_nom
        ");

        $requeteListeActeurs = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY personne_nom
        ");


            $requeteAjoutCasting = $pdo->prepare("
                INSERT INTO casting_film (id_film, id_role, id_acteur) VALUES (:id_film, :id_role, :id_acteur)
            ");

            $requeteAjoutCasting->execute([
                "id_film"=>$idFilm,
                "id_role"=>$idRole,
                "id_acteur"=>$idActeur
            ]);
        }

        require "view/ajouts/ajoutCasting.php";
    }

    public function supprimerCasting($idFilm, $idRole, $idActeur){
        // var_dump($_GET);die;
        $pdo = Connect::seConnecter();

        $requeteSupprimerCasting = $pdo->prepare("
            DELETE 
            FROM casting_film 
            WHERE id_film = :id_film AND id_role =:id_role AND id_acteur =:id_acteur
        ");

        $requeteSupprimerCasting->execute([
            "id_film"=>$idFilm,
            "id_role"=>$idRole,
            "id_acteur"=>$idActeur
        ]);

    
        header("Location:index.php?action=modificationFilmAffichage&id=$idFilm");die;
    }
}