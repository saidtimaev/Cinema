<?php

namespace Model;

abstract class Connect {

    const HOST = 'localhost';
    const NAME = 'cinemasaidtimaev';
    const USER = 'root';
    const PASSWORD = '';

    public static function seConnecter(){
        try {
                return new \PDO(
                    "mysql:host=".self::HOST.";dbname=".self::NAME.";charset=utf8", self::USER, self::PASSWORD);
                } catch (\PDOException $ex){
                    return $ex->getMessage();
            }
                                }
}

