<?php
namespace App\Controller;

use App\Connection;

class ImagesController
{
    /**
    * @var Int
    */
    private $postId;
    
    private $pdo;

    public function __construct(Int $postId) {
        $this->postId = $postId;
        $this->pdo = New Connection();
    }

    public function getImages()
    {
        return $this->pdo->loadImages($this->postId);
    }

    public function addImages()
    {
        //
    }
    public function deleteImages()
    {
        # code...
    }
}