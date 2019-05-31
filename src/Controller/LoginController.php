<?php
namespace App\Controller;

use App\Connection;

class LoginController 
{
    private $username;
    private $password;
    private $pdo;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->pdo = New Connection();
    }
    
	/**
     * Recover a user in DB.
     * The return value of loadUser() is an instance of the User model | Or false 
     * @return void
     */
    public function loadAdmin()
    {
        $result = $this->pdo->loadUser($this->username, $this->password);
        if(!$result){
            throw new \Exception('Aucun utilisateur trouvé');
            // TODO : Send the Exception to the class Message
        }
        if(password_verify($this->password, $result->getPassword())){
            return $result;
        }
        else{
            throw new \Exception('Le mot de passe ne correspond pas');
        }
    }
}
?>