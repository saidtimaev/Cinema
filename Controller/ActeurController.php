<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class ActeurController {

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

    // Afficher infos d'un acteur
    public function infosActeur($id){

        $pdo = Connect::seConnecter();

        $requeteRecherchePersonne = $pdo->prepare("
            SELECT id_personne 
            FROM acteur 
            WHERE id_acteur = :id_acteur
        ");

        $requeteRecherchePersonne->execute([
            "id_acteur"=>$id
        ]);

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

    public function modificationActeurAffichage($id){

        $pdo = Connect::seConnecter();

        $requetePersonne = $pdo->prepare("
                       SELECT personne_prenom, personne_nom, personne_sexe, personne_date_naissance
                       FROM personne
                        WHERE id_personne = :id_personne
                    ");

                    $requetePersonne->execute([
                        "id_personne"=>$id
                    ]);

        $requeteListeCastingsActeur = $pdo->prepare("
            SELECT film_titre, role_nom, personne_prenom, personne_nom
            from casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE personne.id_personne = :id_personne
        ");

        $requeteListeCastingsActeur->execute([
            "id_personne"=>$id
        ]);

       
        require "view/modifications/modificationActeur.php";
    }

    public function suppressionActeur($id){

        $pdo = Connect::seConnecter();

        $requeteSupprimerPersonne = $pdo->prepare("
            DELETE 
            FROM acteur
            WHERE id_acteur = :id_acteur
        ");

        $requeteSupprimerPersonne->execute([
            "id_acteur"=>$id
        ]);


        header("Location:index.php?action=listeActeurs");die;
    }
}