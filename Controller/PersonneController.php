<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class PersonneController {

    
    // Affichage formulaire ajout personne

    public function ajoutPersonneAffichage(){
        require "view/ajouts/ajoutPersonne.php";
    }

    // Ajouter une personne
    public function ajoutPersonne(){

            if(isset($_POST['submit'])){

                // On crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
                $personnePrenom = filter_input(INPUT_POST, "personne_prenom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $personneNom = filter_input(INPUT_POST, "personne_nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $personneSexe = filter_input(INPUT_POST, "personne_sexe",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $personneDateNaissance = new \DateTime(filter_input(INPUT_POST, "personne_date_naissance",FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                $pdo = Connect::seConnecter();

                // Si la personne est un acteur et un réalisateur
                if ($_POST["professions"] == "both"){

                    $requeteAjoutPersonne = $pdo->prepare("
                        INSERT INTO personne (personne_prenom, personne_nom, personne_sexe, personne_date_naissance) 
                        VALUES (:personne_prenom, :personne_nom, :personne_sexe, :personne_date_naissance)
                    ");

                    $requeteAjoutPersonne->execute([
                        "personne_prenom"=> $personnePrenom,
                        "personne_nom"=> $personneNom,
                        "personne_sexe"=> $personneSexe,
                        "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d')
                    ]);

                    // Retourne l'id de la dernière ligne insérée 
                    $idPersonne = $pdo->lastInsertId();

                    // On lui attribue le métier acteur
                    $requeteAjoutActeur = $pdo->prepare("
                        INSERT INTO acteur (id_personne) VALUES (:id_personne) 
                    ");

                    $requeteAjoutActeur->execute([
                        "id_personne"=>$idPersonne
                    ]);

                    // On lui attribue le métier réalisateur
                    $requeteAjoutRéalisateur = $pdo->prepare("
                        INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
                    ");

                    $requeteAjoutRéalisateur->execute([
                        "id_personne"=>$idPersonne
                    ]);

                } elseif ($_POST["professions"] == "acteur"){

                    $requeteAjoutPersonne = $pdo->prepare("
                        INSERT INTO personne (personne_prenom, personne_nom, personne_sexe, personne_date_naissance) 
                        VALUES (:personne_prenom, :personne_nom, :personne_sexe, :personne_date_naissance)
                    ");

                    $requeteAjoutPersonne->execute([
                        "personne_prenom"=> $personnePrenom,
                        "personne_nom"=> $personneNom,
                        "personne_sexe"=> $personneSexe,
                        "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d')
                    ]);

                    // Retourne l'id de la dernière ligne insérée 
                    $idPersonne = $pdo->lastInsertId();

                    // On lui attribue le métier acteur
                    $requeteAjoutActeur = $pdo->prepare("
                        INSERT INTO acteur (id_personne) VALUES (:id_personne) 
                    ");

                    $requeteAjoutActeur->execute([
                        "id_personne"=>$idPersonne
                    ]);
        
                } else {

                    $requeteAjoutPersonne = $pdo->prepare("
                        INSERT INTO personne (personne_prenom, personne_nom, personne_sexe, personne_date_naissance) 
                        VALUES (:personne_prenom, :personne_nom, :personne_sexe, :personne_date_naissance)
                    ");

                    $requeteAjoutPersonne->execute([
                        "personne_prenom"=> $personnePrenom,
                        "personne_nom"=> $personneNom,
                        "personne_sexe"=> $personneSexe,
                        "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d')
                    ]);
        
                    // Retourne l'id de la dernière ligne insérée 
                    $idPersonne = $pdo->lastInsertId();

                    // On lui attribue le métier réalisateur
                    $requeteAjoutRéalisateur = $pdo->prepare("
                        INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
                    ");

                    $requeteAjoutRéalisateur->execute([
                        "id_personne"=>$idPersonne
                    ]);
                }
        }   

        require "view/ajouts/ajoutPersonne.php";
    }


    

}