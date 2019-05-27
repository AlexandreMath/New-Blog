<?php
namespace App;

class URL
{
    public static function getInt(string $name, ?int $default = NULL): ?int
    {
        if (!isset($_GET[$name])) {return $default;}
        
        if(!isset($_GET[$name])){return 0;}

        if (!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
            throw new \Exception("Le paramètre $name dans l'url n'est pas un entier");
        }
        return (int)$_GET[$name];
    }

    public static function getPositiveInt(string $name, ?int $default = NULL): ?int
    {
        //après je verifie que le resultat est sup à 0
        $param = self::getInt($name, $default);
        
        if($param !== NULL && $param <= 0){
            throw new \Exception("Le paramètre $name dans l'url n'est pas un entier positif");
        }
        return $param;
        
    }
}

