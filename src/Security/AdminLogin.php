<?php
namespace App\Security;

use App\Connection;

class AdminLogin 
{
    private $username;
    private $password;
    private $pdo;

    public function __construct(string $username, string $password, ?\PDO $pdo = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $pdo ?: Connection::getPDO();
    }
    
    public function loadAdmin(): array
    {
        $result = $this->pdo->UserInDB($this->username, $this->password);
        if($result === NULL){
            throw new \Exception('Aucun utilisateur trouvé');
        }
        return $result;
    }
}
?>