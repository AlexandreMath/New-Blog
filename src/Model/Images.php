<?php
namespace App\Model;

class Images
{
    /**
    * @var Int
    */
    private $id;
    /**
    * @var String
    */
    private $name;
    /**
    * @var String
    */
    private $src;
    /**
    * @var Int
    */
    private $postId;


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
    public function getName(): ?String
    {
        return $this->name;
    }

    /**
     * @param  String  $name
     * @return  self
     */ 
    public function setName(String $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return  String
     */ 
    public function getSrc(): String
    {
        return $this->src;
    }

    /**
     * @param  String  $src
     * @return  self
     */ 
    public function setSrc(String $src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return  Int
     */ 
    public function getPostId(): Int
    {
        return $this->postId;
    }

    /**
     * @param  Int  $postId
     * @return  self
     */ 
    public function setPostId(Int $postId)
    {
        $this->postId = $postId;

        return $this;
    }
}
?>