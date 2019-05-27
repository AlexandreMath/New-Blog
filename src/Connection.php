<?php
namespace App;

use \PDO;
use App\Model\User;

class Connection 
{

    public static function getPDO(): PDO
    {
        return new PDO('mysql:host=localhost; dbname=php-blog', 'root','root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function UserInDB(string $username, string $password)
    {
        $prepare = self::getPDO()->prepare('SELECT * FROM user WHERE username=:username');
        $prepare->execute(':username', $username);
        $prepare->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $prepare->fetchAll();
    }
}
?>