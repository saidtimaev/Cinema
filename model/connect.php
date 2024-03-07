<?php

namespace Model;

// Une classe abstaite ne peut pas être instanciée
abstract class Connect {

    const HOST = 'localhost';
    const NAME = 'cinemasaidtimaev';
    const USER = 'root';
    const PASSWORD = '';


    // Différence entre PDO et MYSQLi, PDO permet l'accès à 11 BDD's


    // 4 principes fondamentaux de la programmation orienté objet
    // L'encapsulation, regroupement de données et les différents moyens qui autorisent leur lecture ou manipulation
    // l'abstraction, 
    // l'héritage, permet d'inclure dans une classe les caractéristiques d'une autre classe 
    // le polymorphisme, permet à des classes d'implémenter la même méthode mais avec un comportement différent 
    public static function seConnecter(){
        try {
                return new \PDO(
                    "mysql:host=".self::HOST.";dbname=".self::NAME.";charset=utf8", self::USER, self::PASSWORD);
                } catch (\PDOException $ex){
                    return $ex->getMessage();
            }
                                }
}

