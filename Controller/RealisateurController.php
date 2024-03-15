<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class RealisateurController {

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

    // Afficher infos d'un réalisateur
    public function infosRealisateur($id){

        $pdo = Connect::seConnecter();

        $requeteInfosRealisateur = $pdo->prepare("
        SELECT realisateur.id_realisateur, personne_prenom, personne_nom, personne_sexe, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance
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

    public function modificationRealisateurAffichage($id){

        $pdo = Connect::seConnecter();

        $requetePersonne = $pdo->prepare("
                       SELECT personne_prenom, personne_nom, personne_sexe, personne_date_naissance, personne.id_personne
                       FROM personne
                       INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne
                        WHERE id_realisateur = :id_realisateur
                    ");

                    $requetePersonne->execute([
                        "id_realisateur"=>$id
                    ]);


        $requeteListeFilmsRealisateur = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM film
            INNER JOIN realisateur ON realisateur.id_realisateur = film.id_realisateur
            WHERE id_personne = :id_personne
            ORDER BY film_date_sortie DESC
        ");

        $requeteListeFilmsRealisateur->execute([
            "id_personne"=>$id
        ]);
        

        require "view/modifications/modificationRealisateur.php";
    }

    public function supprimerRealisateur($id){

        $pdo = Connect::seConnecter();

        $requeteSupprimerPersonne = $pdo->prepare("
            DELETE 
            FROM realisateur
            WHERE id_realisateur = :id_realisateur
        ");

        $requeteSupprimerPersonne->execute([
            "id_realisateur"=>$id
        ]);


        header("Location:index.php?action=listeRealisateurs");die;
    }

    public function modificationRealisateur($id){
        

        if(isset($_POST['submit'])){

        // On crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
        $personnePrenom = filter_input(INPUT_POST, "personne_prenom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $personneNom = filter_input(INPUT_POST, "personne_nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $personneSexe = filter_input(INPUT_POST, "personne_sexe",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $personneDateNaissance = new \DateTime(filter_input(INPUT_POST, "personne_date_naissance",FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        $pdo = Connect::seConnecter();

        // var_dump($_POST);

        
            
            $requeteModificationPersonne = $pdo->prepare("
                UPDATE personne 
                SET personne_prenom = :personne_prenom, personne_nom = :personne_nom, personne_sexe =:personne_sexe, personne_date_naissance = :personne_date_naissance 
                WHERE id_personne = :id_personne
            ");

            $requeteModificationPersonne->execute([
                "personne_prenom"=> $personnePrenom,
                "personne_nom"=> $personneNom,
                "personne_sexe"=> $personneSexe,
                "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d'),
                "id_personne"=>$id
            ]);

            
        

        // Si la personne est un acteur et un réalisateur
        if ($_POST["professions"] == "both"){

            $requeteSuppressionRoleActeur = $pdo->prepare("
                DELETE FROM acteur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleActeur->execute([
                "id_personne"=>$id
            ]);

            $requeteSuppressionRoleRealisateur = $pdo->prepare("
                DELETE FROM realisateur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleRealisateur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier acteur
            $requeteAjoutActeur = $pdo->prepare("
                INSERT INTO acteur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutActeur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier réalisateur
            $requeteAjoutRéalisateur = $pdo->prepare("
                INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutRéalisateur->execute([
                "id_personne"=>$id
            ]);

        } 
        
        if ($_POST["professions"] == "acteur"){

            $requeteSuppressionRoleActeur = $pdo->prepare("
                DELETE FROM acteur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleActeur->execute([
                "id_personne"=>$id
            ]);

            $requeteSuppressionRoleRealisateur = $pdo->prepare("
                DELETE FROM realisateur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleRealisateur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier acteur
            $requeteAjoutActeur = $pdo->prepare("
                INSERT INTO acteur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutActeur->execute([
                "id_personne"=>$id
            ]);

        } 
        
        if ($_POST["professions"] == "realisateur") {

            $requeteSuppressionRoleActeur = $pdo->prepare("
                DELETE FROM acteur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleActeur->execute([
                "id_personne"=>$id
            ]);

            $requeteSuppressionRoleRealisateur = $pdo->prepare("
                DELETE FROM realisateur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleRealisateur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier réalisateur
            $requeteAjoutRéalisateur = $pdo->prepare("
                INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutRéalisateur->execute([
                "id_personne"=>$id
            ]);
        }

        header("Location:index.php?action=listeRealisateurs");die;
        // require "view/modifications/modificationPersonne.php";
        }     
    }
}