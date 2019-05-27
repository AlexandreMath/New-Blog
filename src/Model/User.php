<?php
namespace App\Model;

class User
{
    /**
    * @var Int
    */
    private $id;
    /**
    * @var String
    */
    private $username;
    /**
    * @var String
    */
    private $password;
    /**
    * @var String
    */
    private $email;
    
    /**
     * @return  Int
     */ 
    public function getId(): Int
    {
        return $this->id;
    }

    /**
     * @param  Int  $id
     * @return  self
     */ 
    public function setId(Int $id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * @return  String
     */ 
    public function getUsername(): String
    {
        return $this->username;
    }

    /**
     * @param  String  $username
     * @return  self
     */ 
    public function setUsername(String $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return  String
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param  String  $password
     * @return  self
     */ 
    public function setPassword(String $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return  String
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  String  $email
     * @return  self
     */ 
    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }
}
