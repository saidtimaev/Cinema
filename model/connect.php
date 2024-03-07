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
    // L'encapsulation, l'abstraction, l'héritage, le polymorphisme
    public static function seConnecter(){
        try {
                return new \PDO(
                    "mysql:host=".self::HOST.";dbname=".self::NAME.";charset=utf8", self::USER, self::PASSWORD);
                } catch (\PDOException $ex){
                    return $ex->getMessage();
            }
                                }
}

